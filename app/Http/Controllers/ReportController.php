<?php

namespace App\Http\Controllers;

use App\Services\ReportService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    protected $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    public function indexRevenue(): View
    {
        return view('pages.admin.reports.revenue', [
            'dataRevenues' => [],
            'year' => '',
        ]);
    }

    public function revenue(Request $request): JsonResponse
    {
        $year = $request->year ?? now()->year;

        $dataRevenues = $this->reportService->revenue($year);

        $collectDataRevenues = collect($dataRevenues);

        $dataChartExpenses = $collectDataRevenues->pluck('expenses')->values();
        $dataChartNetIncome = $collectDataRevenues->pluck('net_income')->values();

        $view = view('pages.admin.reports.results-revenue', [
            'dataRevenues' => $dataRevenues,
            'year' => $year,
        ]);

        return response()->json([
            'html' => $view->render(),
            'dataChartExpenses' => $dataChartExpenses,
            'dataChartNetIncome' => $dataChartNetIncome,
        ], 200);
    }

    public function indexAnalytics(Request $request): View
    {
        return view('pages.admin.reports.analytics', [
            'data' => $this->reportService->analytics($request),
        ]);
    }

    public function analytics(Request $request): JsonResponse
    {
        $data = $this->reportService->analytics($request);

        return response()->json($data, 200);
    }
}