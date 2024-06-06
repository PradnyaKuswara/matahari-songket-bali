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
        $period = Period::days($request->get('period') ?? 7);

        $analyticsData = Analytics::fetchVisitorsAndPageViewsByDate($period);

        $datas = collect();

        collect($analyticsData)->map(function (array $item) use ($analyticsData, $datas) {

            if ($datas->where('date', $item['date'])->count() === 0) {
                $data = [];

                $data['pageTitle'] = 'MatahariSongketBali';
                $data['screenPageViews'] = $analyticsData->where('date', $item['date'])->sum('screenPageViews');
                $data['activeUsers'] = $analyticsData->where('date', $item['date'])->sum('activeUsers');
                $data['date'] = $item['date'];

                $datas->push($data);
            }
        });

        $analyticsData = $datas;

        if ($analyticsData->count() === 0) {
            return ['totalScreenPageViews' => 0, 'totalActiveUsers' => 0, 'analyticsData' => []];
        }

        $totalViews = $analyticsData->sum('screenPageViews');

        $totalActiveUsers = $analyticsData->sum('activeUsers');

        $temp = [];

        $currentDate = clone $analyticsData->last()['date'];

        for ($i = 1; $i <= $request->get('period') - $analyticsData->count(); $i++) {
            $temp[] = ['pageTitle' => 'MatahariSongketBali', 'date' => clone $currentDate->subDay(), 'screenPageViews' => 0, 'activeUsers' => 0];
        }

        foreach ($temp as $data) {
            $analyticsData->push($data);
        }

        if ($request->get('period') != '90' && $request->get('period') != '60') {

            $analyticsData = $analyticsData->map(function (array $item) {
                $item['date'] = $item['date']->format('d/m/Y');

                return $item;
            });

            $data = ['totalScreenPageViews' => $totalViews, 'totalActiveUsers' => $totalActiveUsers, 'analyticsData' => $analyticsData];

            return $data;
        }

        $weeks = [];

        $startDate = $analyticsData[0]['date'];

        $endDate = (clone $analyticsData[0]['date'])->subDays(7);

        $week = [];

        foreach ($analyticsData as $key => $data) {
            if ($data['date'] <= $startDate && $data['date'] > $endDate) {
                $week[] = $data;

                if ($key === $analyticsData->count() - 1) {
                    $start = collect($week)->first()['date']->format('d/m/Y');

                    $end = collect($week)->last()['date']->format('d/m/Y');

                    $weeks[] = ['date' => "$start - $end", 'screenPageViews' => collect($week)->sum('screenPageViews'), 'activeUsers' => collect($week)->sum('activeUsers')];
                }

                continue;
            }

            $start = collect($week)->first()['date']->format('d/m/Y');

            $end = collect($week)->last()['date']->format('d/m/Y');

            $weeks[] = ['date' => "$start - $end", 'screenPageViews' => collect($week)->sum('screenPageViews'), 'activeUsers' => collect($week)->sum('activeUsers')];

            $week = [];

            $startDate = $data['date'];

            $endDate = (clone $data['date'])->subDays(7);

            $week[] = $data;
        }

        $data = ['totalScreenPageViews' => $totalViews, 'totalActiveUsers' => $totalActiveUsers, 'analyticsData' => $weeks];

        return $data;
    }

    public function products($year)
    {
        $products = Product::whereYear('created_at', $year)->with('productCategory')
            ->get();

        return $products;
    }
}
