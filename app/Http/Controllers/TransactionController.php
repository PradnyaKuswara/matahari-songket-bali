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

    public function showAdminSeller(Request $request)
    {
        return view('pages.admin-seller.transactions.show', [
            'transactions' => $this->transactionService->search($request, new Transaction, ['generate_id']),
        ]);
    }

    public function detailTransactionAdminSeller(Transaction $transaction)
    {
        return view('pages.admin-seller.transactions.detail-transaction', [
            'transaction' => $transaction,
        ]);
    }

    public function search(Request $request)
    {
        return view('pages.admin-seller.transactions.data', [
            'transactions' => $this->transactionService->search($request, new Transaction, ['generate_id']),
        ]);
    }
}
