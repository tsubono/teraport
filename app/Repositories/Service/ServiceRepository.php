<?php

namespace App\Repositories\Service;

use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class ServiceRepository
 *
 * @package App\Repositories\Service
 */
class ServiceRepository implements ServiceRepositoryInterface
{
    /**
     * @var Service
     */
    private $service;

    public function __construct(Service $service) {
        $this->service = $service;
    }

    /**
     * 条件から検索取得する
     *
     * @param array $condition
     * @param int $paginationCount
     * @return LengthAwarePaginator
     */
    public function getByCondition(array $condition, int $paginationCount = 20): LengthAwarePaginator
    {
        $query = $this->service->query();
        // カテゴリ
        if (!empty($condition['c'])) {
            $query->where('category_id', $condition['c']);
        }
        // フリーワード
        if (!empty($condition['keyword'])) {
            $query->where(function($query) use ($condition) {
                $query->where('title', 'LIKE',  "%{$condition['keyword']}%");
                $query->orWhere('content', 'LIKE', "%{$condition['keyword']}%");
            });
        }

        return $query->orderBy('created_at', 'desc')->paginate($paginationCount);
    }

    /**
     * 最新のものを取得する
     *
     * @param int $count
     * @return Collection
     */
    public function getCurrent(int $count = 6): Collection
    {
        $query = $this->service->query();
        return $query->orderBy('created_at', 'desc')->get()->take($count);
    }

    /**
     * 1件取得する
     *
     * @param int $id
     * @retusn Service
     */
    public function getOne(int $id): Service
    {
        return $this->service->find($id);
    }

    /**
     * ユーザーIDに紐づくものを取得する
     *
     * @param int $userId
     * @return Collection
     */
    public function getByUserId(int $userId): Collection
    {
        return $this->service
            ->query()
            ->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
     * 登録する
     *
     * @param array $data
     * @retusn Service
     * @throws \Exception
     */
    public function store(array $data): Service
    {
        DB::beginTransaction();
        try {
            // サービス登録
            $service = $this->service->create($data);
            // 画像登録
            foreach ($data['images'] as $index => $image) {
                if (!empty($image)) {
                    $service->images()->create([
                        'image_path' => $image,
                        'sort' => $index
                    ]);
                }
            }

            DB::commit();

            return $service;

        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw new \Exception($e);
        }
    }

    /**
     * 更新する
     *
     * @param int $id
     * @param array $data
     * @retusn Service
     * @throws \Exception
     */
    public function update(int $id, array $data): Service
    {
        DB::beginTransaction();
        try {
            $service = $this->service->findOrFail($id);
            // サービス更新
            $service->update($data);
            // 画像削除されているものがあれば削除
            $savedImagePaths = [];
            foreach ($service->images as $image) {
                $savedImagePaths[] = $image->image_path;
                if (!in_array($image->image_path, $data['images'])) {
                    $image->delete();
                }
            }
            // 画像更新
            foreach ($data['images'] as $index => $image) {
                if (!empty($image)) {
                    if (!in_array($image, $savedImagePaths)) {
                        $service->images()->create([
                            'image_path' => $image,
                            'sort' => $index
                        ]);
                    } else {
                        $service->images()->where('image_path', $image)->update([
                            'image_path' => $image,
                            'sort' => $index
                        ]);
                    }
                }
            }

            DB::commit();

            return $service;

        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw new \Exception($e);
        }
    }

    /**
     * 削除する (未使用)
     *
     * @param int $id
     * @throws \Exception
     */
//    public function destroy(int $id)
//    {
//        DB::beginTransaction();
//        try {
//            $service = $this->service->findOrFail($id);
//            $service->delete();
//
//            DB::commit();
//
//        } catch (\Exception $e) {
//            DB::rollback();
//            Log::error($e->getMessage());
//            throw new \Exception($e);
//        }
//    }
}
