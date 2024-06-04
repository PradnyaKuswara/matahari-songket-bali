<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\OrderService;
use App\Services\ReportService;
use App\Services\ShippingService;
use App\Services\TransactionService;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    protected $orderService;

    protected $transactionService;

    protected $shippingService;

    protected $reportService;

    public function __construct(OrderService $orderService, TransactionService $transactionService, ShippingService $shippingService, ReportService $reportService)
    {
        $this->orderService = $orderService;
        $this->transactionService = $transactionService;
        $this->shippingService = $shippingService;
        $this->reportService = $reportService;
    }

    public function index()
    {
        if (auth()->user()->role->name != 'customer') {
            return $this->adminSellerDashboard();
        } else {
            return $this->customerDashboard();
        }
    }

    public function adminSellerDashboard(): View
    {
        $recentOrders = $this->orderService->getAll()->latest()->take(5)->get();
        $popularProducts = Product::leftJoin(
            'visitor_metas',
            'products.id',
            '=',
            'visitor_metas.identity'
        )
            ->leftJoin('visitors', 'visitors.id', '=', 'visitor_metas.visitor_id')
            ->select('products.*')
            ->selectRaw('COUNT(CASE WHEN visitors.type = "product" THEN visitor_metas.identity ELSE NULL END) AS total')
            ->where('products.is_active', true)
            ->groupBy('products.id')
            ->orderByRaw('IF(products.stock > 0, 1, 2)') // Order by stock availability
            ->orderByDesc('total') // Then order by total visitors
            ->take(5)
            ->get();

        $transactions = $this->transactionService->getAll()->where('status', 'settlement')->latest()->take(6)->get();

        $year = now()->year;

        $dataRevenues = $this->reportService->revenue($year);

        $collectDataRevenues = collect($dataRevenues);

        $dataChartExpenses = $collectDataRevenues->pluck('expenses')->values();
        $dataChartNetIncome = $collectDataRevenues->pluck('net_income')->values();
        $dataTotalNetProfit = $collectDataRevenues->sum('net_profit');

        return view('pages.main-dashboard', [
            'user' => auth()->user(),
            'recentOrders' => $recentOrders,
            'popularProducts' => $popularProducts,
            'transactions' => $transactions,
            'year' => $year,
            'dataChartExpenses' => $dataChartExpenses,
            'dataChartNetIncome' => $dataChartNetIncome,
            'dataTotalNetProfit' => $dataTotalNetProfit,
        ]);
    }

    public function customerDashboard(): View
    {
        $totalOrder = $this->orderService->getAll()->where('user_id', auth()->user()->id)->count();
        $totalShipping = $this->shippingService->getAll()->where('user_id', auth()->user()->id)->where('status', '!=', 'pending')->count();

        $orders = $this->orderService->getAll()->where('user_id', auth()->user()->id)->where('status', true)->get();
        $totalQuantityProduct = $orders->sum(function ($order) {
            return $order->products->sum('pivot.quantity');
        });

        $transactions = $this->transactionService->getAll()->where('user_id', auth()->user()->id)->where('status', 'settlement')->get();
        $totalPrice = $transactions->sum('total_price');

        return view('pages.main-dashboard', [
            'user' => auth()->user(),
            'totalOrder' => $totalOrder,
            'totalShipping' => $totalShipping,
            'totalQuantityProduct' => $totalQuantityProduct,
            'totalPrice' => $totalPrice,
            'dataChartExpenses' => [],
            'dataChartNetIncome' => [],
            'dataTotalNetProfit' => [],
        ]);
    }
}
