<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Services\ProductService;
use App\Services\TransactionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    protected $transactionService;

    protected $productService;

    public function __construct(TransactionService $transactionService, ProductService $productService)
    {
        $this->transactionService = $transactionService;
        $this->productService = $productService;
    }

    public function index(Request $request): View
    {
        $transactions = $this->transactionService->all($request->user())->where('status', '!=', 'pending')->latest()->paginate(8);
        $transactionPendings = $this->transactionService->all($request->user())->where('status', 'pending')->latest()->paginate(8);

        return view('pages.customer.transactions.index', [
            'transactions' => $transactions,
            'transactionPendings' => $transactionPendings,
        ]);
    }

    public function show(Transaction $transaction): View
    {
        return view('pages.customer.transactions.show', [
            'transaction' => $transaction,
        ]);
    }

    public function showAdminSeller(Request $request): View
    {
        return view('pages.admin-seller.transactions.show', [
            'transactions' => $this->transactionService->search($request, new Transaction, ['generate_id']),
        ]);
    }

    public function detailTransactionAdminSeller(Transaction $transaction): View
    {
        return view('pages.admin-seller.transactions.detail-transaction', [
            'transaction' => $transaction,
        ]);
    }

    public function search(Request $request): View
    {
        return view('pages.admin-seller.transactions.data', [
            'transactions' => $this->transactionService->search($request, new Transaction, ['generate_id']),
        ]);
    }

    public function indexDirectTransaction(): View
    {
        $products = $this->productService->all()->where('stock', '>', 0)->with('productCategory')->get();

        return view('pages.seller.transactions.index', [
            'products' => $products,
        ]);
    }
}
