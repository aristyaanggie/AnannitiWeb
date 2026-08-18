<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminBookingController extends Controller
{
    public function index(): View
    {
        $filter = request('filter', 'all');

        $query = Booking::query();

        if ($filter === 'week') {
            $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
        } elseif ($filter === 'month') {
            $query->whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year);
        } elseif ($filter === 'year') {
            $query->whereYear('created_at', Carbon::now()->year);
        } elseif ($filter === 'trash') {
            $query->onlyTrashed();
        }

        $bookings = $query->orderByDesc('created_at')->paginate(20);

        $stats = [
            'total' => Booking::count(),
            'week' => Booking::whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])->count(),
            'month' => Booking::whereMonth('created_at', Carbon::now()->month)->whereYear('created_at', Carbon::now()->year)->count(),
            'year' => Booking::whereYear('created_at', Carbon::now()->year)->count(),
            'trash' => Booking::onlyTrashed()->count(),
        ];

        return view('admin.bookings.index', compact('bookings', 'filter', 'stats'));
    }

    public function destroy(Booking $booking): RedirectResponse
    {
        $booking->delete();
        return redirect()->route('admin.bookings.index')->with('success', 'Booking moved to trash.');
    }

    public function restore(int $id): RedirectResponse
    {
        Booking::withTrashed()->findOrFail($id)->restore();
        return redirect()->route('admin.bookings.index', ['filter' => 'trash'])->with('success', 'Booking restored.');
    }

    public function forceDelete(int $id): RedirectResponse
    {
        Booking::withTrashed()->findOrFail($id)->forceDelete();
        return redirect()->route('admin.bookings.index', ['filter' => 'trash'])->with('success', 'Booking permanently deleted.');
    }
}
