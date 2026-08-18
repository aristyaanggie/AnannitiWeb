<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminOrderController extends Controller
{
    public function index(): View
    {
        $filter = request('filter', 'all');

        $query = Order::query();

        if ($filter === 'week') {
            $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($filter === 'month') {
            $query->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year);
        } elseif ($filter === 'year') {
            $query->whereYear('created_at', Carbon::now()->year);
        } elseif ($filter === 'trash') {
            $query->onlyTrashed();
        }

        $orders = $query->orderByDesc('created_at')->paginate(20);

        $stats = [
            'total' => Order::count(),
            'week' => Order::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count(),
            'month' => Order::whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->count(),
            'year' => Order::whereYear('created_at', Carbon::now()->year)->count(),
            'trash' => Order::onlyTrashed()->count(),
        ];

        return view('admin.orders.index', compact('orders', 'filter', 'stats'));
    }

    public function destroy(Order $order): RedirectResponse
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('success', 'Order moved to trash.');
    }

    public function restore(int $id): RedirectResponse
    {
        Order::withTrashed()->findOrFail($id)->restore();
        return redirect()->route('admin.orders.index', ['filter' => 'trash'])->with('success', 'Order restored.');
    }

    public function forceDelete(int $id): RedirectResponse
    {
        Order::withTrashed()->findOrFail($id)->forceDelete();
        return redirect()->route('admin.orders.index', ['filter' => 'trash'])->with('success', 'Order permanently deleted.');
    }
}
