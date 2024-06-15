<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Transaction;
use Spatie\Analytics\Facades\Analytics;
use Spatie\Analytics\Period;

class ReportService
{
    public function revenue($year)
    {
        $monthName = [
            1 => 'January',
            2 => 'February',
            3 => 'March',
            4 => 'April',
            5 => 'May',
            6 => 'June',
            7 => 'July',
            8 => 'August',
            9 => 'September',
            10 => 'October',
            11 => 'November',
            12 => 'December',
        ];

        // Initialize data array for each month
        $dataRevenues = [];
        foreach ($monthName as $key => $month) {
            $dataRevenues[$key] = [
                'month' => $month,
                'quantity' => 0,
                'expenses' => 0,
                'net_income' => 0,
                'gross_income' => 0,
                'net_profit' => 0,
                'net_loss' => 0,
                'total' => 0,
            ];
        }

        // Fetch transactions for the specified year with status 'settlement'
        $transactions = Transaction::whereYear('created_at', $year)
            ->where('status', 'settlement')
            ->get();

        // Process each transaction
        foreach ($transactions as $transaction) {
            $month = $transaction->created_at->month;

            foreach ($transaction->order->products as $product) {
                $quantity = $product->pivot->quantity ?? 0;
                $dataRevenues[$month]['quantity'] += $quantity;
                $dataRevenues[$month]['expenses'] += $product->goods_price * $quantity;
                $dataRevenues[$month]['net_income'] += $product->pivot->total_price ?? 0;
            }

            // Update gross income per month
            $dataRevenues[$month]['gross_income'] += $transaction->total_price;
            $dataRevenues[$month]['net_profit'] = ($dataRevenues[$month]['net_income'] - $dataRevenues[$month]['expenses']) > 0 ? $dataRevenues[$month]['net_income'] - $dataRevenues[$month]['expenses'] : 0;
            $dataRevenues[$month]['net_loss'] = ($dataRevenues[$month]['net_income'] - $dataRevenues[$month]['expenses']) < 0 ? $dataRevenues[$month]['net_income'] - $dataRevenues[$month]['expenses'] : 0;
            $dataRevenues[$month]['total'] = $dataRevenues[$month]['net_profit'] + $dataRevenues[$month]['net_loss'];
        }

        return $dataRevenues;
    }

    public function analytics($request)
    {

        $period = (int) $request->period ? $request->period : 7;

        $analyticsData = Analytics::fetchVisitorsAndPageViewsByDate(Period::days($period));

        $datas = collect();

        // Aggregate data by date
        foreach ($analyticsData as $item) {
            $date = $item['date']->format('Y-m-d');

            if (! $datas->has($date)) {
                $data = [];
                $data['pageTitle'] = 'MatahariSongketBali';
                $data['screenPageViews'] = $analyticsData->where('date', $item['date'])->sum('screenPageViews');
                $data['activeUsers'] = $analyticsData->where('date', $item['date'])->sum('activeUsers');
                $data['date'] = $item['date'];
                $datas[$date] = $data;
            }
        }

        // Ensure all dates in the period are covered
        $startDate = now()->subDays($period - 1);
        $endDate = now();

        $allDates = collect();
        for ($date = $startDate; $date->lte($endDate); $date->addDay()) {
            $formattedDate = $date->format('Y-m-d');
            if (! $datas->has($formattedDate)) {
                $datas[$formattedDate] = [
                    'pageTitle' => 'MatahariSongketBali',
                    'screenPageViews' => 0,
                    'activeUsers' => 0,
                    'date' => $date->copy(),
                ];
            }
            $allDates->push($datas[$formattedDate]);
        }

        // Sort data by date
        $allDates = $allDates->sortBy('date')->values();

        // Calculate total screen page views and active users
        $totalViews = $allDates->sum('screenPageViews');
        $totalActiveUsers = $allDates->sum('activeUsers');

        // Format dates if period is not 60 or 90 days
        if ($period != 60) {
            $allDates = $allDates->map(function ($item) {
                $item['date'] = $item['date']->format('d/m/Y');

                return $item;
            });

            return [
                'totalScreenPageViews' => $totalViews,
                'totalActiveUsers' => $totalActiveUsers,
                'analyticsData' => $allDates,
            ];
        }

        // Group data into weeks for periods of 60 or 90 days
        $weeks = [];
        $week = [];
        $startDate = $allDates->first()['date'];
        $endDate = $startDate->copy()->subDays(7);

        foreach ($allDates as $key => $data) {
            if ($data['date']->gt($endDate)) {
                $week[] = $data;
            } else {
                $weeks[] = [
                    'date' => $week[0]['date']->format('d/m/Y').' - '.end($week)['date']->format('d/m/Y'),
                    'screenPageViews' => collect($week)->sum('screenPageViews'),
                    'activeUsers' => collect($week)->sum('activeUsers'),
                ];
                $week = [$data];
                $startDate = $data['date'];
                $endDate = $startDate->copy()->subDays(7);
            }

            if ($key === $allDates->count() - 1 && ! empty($week)) {
                $weeks[] = [
                    'date' => $week[0]['date']->format('d/m/Y').' - '.end($week)['date']->format('d/m/Y'),
                    'screenPageViews' => collect($week)->sum('screenPageViews'),
                    'activeUsers' => collect($week)->sum('activeUsers'),
                ];
            }
        }

        return [
            'totalScreenPageViews' => $totalViews,
            'totalActiveUsers' => $totalActiveUsers,
            'analyticsData' => $weeks,
        ];
    }

    public function products($year)
    {
        $products = Product::whereYear('created_at', $year)->with('productCategory')
            ->get();

        return $products;
    }
}
