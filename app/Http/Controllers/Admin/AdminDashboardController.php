<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\DashboardService;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function __construct(
        protected DashboardService $dashboardService,
    ) {}

    public function index(): View
    {
        $stats = $this->dashboardService->getStats();

        return view('admin.dashboard', [
            'pageTitle' => 'Dashboard',
            'stats' => $stats,
        ]);
    }
}
