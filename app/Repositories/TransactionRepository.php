<?php

namespace App\Repositories;

use App\Interfaces\TransactionInterface;
use App\Models\Transaction;
use App\Services\SearchService;

class TransactionRepository implements TransactionInterface
{
    protected $searchService;

    public function __construct(SearchService $searchService)
    {
        $this->searchService = $searchService;
    }

    public function all($user)
    {
        return $user->transactions();
    }

    public function getAll()
    {
        return Transaction::query();
    }

    public function create(array $data, $order)
    {
        return $order->transaction()->create($data);
    }

    public function updateStatus($transaction, $status)
    {
        return $transaction->update(['status' => $status]);
    }

    public function search($request, $model, $conditions)
    {
        return $this->searchService->handle($request, $model, $conditions)->latest()->paginate(8)->withQueryString()->withPath('show');
    }
}
