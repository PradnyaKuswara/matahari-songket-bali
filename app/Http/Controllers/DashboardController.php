<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $role = auth()->user()->role->name ?? null;
        $linkSubtitle = null;
        $linkTitle = null;

        if ($role === 'admin') {
            $linkSubtitle = 'admin.dashboard.index';
            $linkTitle = 'admin.dashboard.index';
        }

        if ($role === 'customer') {
            $linkSubtitle = 'customer.dashboard.index';
            $linkTitle = 'customer.dashboard.index';
        }

        return view('pages.main-dashboard', [
            'linkSubtitle' => $linkSubtitle,
            'linkTitle' => $linkTitle,
        ]);
    }
}
