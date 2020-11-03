<?php

namespace App\Repositories\Transaction;

use App\Models\TransactionReview;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

/**
 * Class ReviewRepository
 *
 * @package App\Repositories\Transaction
 */
class ReviewRepository implements ReviewRepositoryInterface
{
    /**
     * @var TransactionReview
     */
    private $review;

    public function __construct(TransactionReview $review) {
        $this->review = $review;
    }

    /**
     * 評価先ユーザーIDに紐づく評価をpaginateで取得する
     *
     * @param int $userId
     * @param int $paginationCount
     * @return LengthAwarePaginator
     */
    public function getPaginateByToUserId(int $userId, int $paginationCount = 20): LengthAwarePaginator
    {
        return $this->review
            ->query()
            ->where('to_user_id', $userId)
            ->paginate($paginationCount);
    }

    /**
     * 評価を登録する
     *
     * @param array $data
     * @throws \Exception
     */
    public function store(array $data)
    {
        DB::beginTransaction();
        try {
            $this->review->create($data);

            DB::commit();

        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e->getMessage());
            throw new \Exception($e);
        }
    }
}
