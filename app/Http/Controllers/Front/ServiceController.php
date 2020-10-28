<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Service;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Message\MessageRepositoryInterface;
use App\Repositories\Service\ServiceRepositoryInterface;
use App\Repositories\Transaction\TransactionRepositoryInterface;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * @var ServiceRepositoryInterface
     */
    private $serviceRepository;
    /**
     * @var CategoryRepositoryInterface
     */
    private $categoryRepository;
    /**
     * @var TransactionRepositoryInterface
     */
    private $transactionRepository;
    /**
     * @var MessageRepositoryInterface
     */
    private $messageRepository;

    /**
     * ServiceController constructor.
     * @param ServiceRepositoryInterface $serviceRepository
     * @param CategoryRepositoryInterface $categoryRepository
     * @param TransactionRepositoryInterface $transactionRepository
     * @param MessageRepositoryInterface $messageRepository
     */
    public function __construct(
        ServiceRepositoryInterface $serviceRepository,
        CategoryRepositoryInterface $categoryRepository,
        TransactionRepositoryInterface $transactionRepository,
        MessageRepositoryInterface $messageRepository
    )
    {
        $this->serviceRepository = $serviceRepository;
        $this->categoryRepository = $categoryRepository;
        $this->transactionRepository = $transactionRepository;
        $this->messageRepository = $messageRepository;
    }

    /**
     * サービス一覧
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $params = $request->all();
        $category = $this->categoryRepository->getOne($params['c'] ?? 0);
        // 対象のカテゴリ自体存在しない場合は404
        if (!empty($params['c']) && empty($category)) {
            abort(404);
        }
        $categoryName = !empty($category) ? $category->name : '全カテゴリ';
        $services = $this->serviceRepository->getByCondition($params);

        return view('front.services.index', compact('services', 'params', 'categoryName'));
    }

    /**
     * サービス詳細
     *
     * @param Service $service
     * @return \Illuminate\View\View
     */
    public function show(Service $service)
    {
        return view('front.services.show', compact('service'));
    }


    public function buy(Service $service)
    {
        // TODO: 決済 (一番だいじ)

        // 登録処理
        $transaction = $this->transactionRepository->store([
            'service_id' => $service->id,
            'seller_user_id' => $service->user_id,
            'buyer_user_id' => auth()->user()->id,
            'status' => 0,
        ]);
        $message = $this->messageRepository->store($transaction->id);
        // 自動送信メッセージ
        $this->messageRepository->storeItem($message->id,
            [
                'from_user_id' => auth()->user()->id,
                'to_user_id' => $service->user_id,
                'content' => '【※自動送信メッセージです】サービスを購入いたしました。'
            ]
        );

        return redirect(route('front.messages.show', ['message' => $message->id]));
    }
}
