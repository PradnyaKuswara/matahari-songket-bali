<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }

    public function index(Request $request)
    {
        $transactions = $this->transactionService->all($request->user())->where('status', '!=', 'pending')->latest()->paginate(8);
        $transactionPendings = $this->transactionService->all($request->user())->where('status', 'pending')->latest()->paginate(8);

        return view('pages.customer.transactions.index', [
            'transactions' => $transactions,
            'transactionPendings' => $transactionPendings,
        ]);
    }

    public function show(Transaction $transaction)
    {
        return view('pages.customer.transactions.show', [
            'transaction' => $transaction,
        ]);
    }
}
