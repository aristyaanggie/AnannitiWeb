<?php

declare(strict_types=1);

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTattooSupplyRequest;
use App\Http\Requests\UpdateTattooSupplyRequest;
use App\Models\TattooSupply;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class AdminTattooSupplyController extends Controller
{
    public function index(): RedirectResponse
    {
        // Halaman index supply sudah digantikan tab "Tattoo Supply" di admin.products.index
        return redirect()->route('admin.products.index', ['tab' => 'supplies']);
    }

    public function create(): View
    {
        return view('admin.tattoo-supplies.form', [
            'pageTitle' => 'Add Tattoo Supply',
            'supply' => null,
        ]);
    }

    public function store(StoreTattooSupplyRequest $request): RedirectResponse
    {
        $data = $request->validated();

        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $data['image'] = $data['image']->store('tattoo-supplies', 'public');
        }

        TattooSupply::create($data);

        return redirect()->route('admin.products.index', ['tab' => 'supplies'])
            ->with('success', 'Tattoo supply created successfully.');
    }

    public function edit(TattooSupply $tattooSupply): View
    {
        return view('admin.tattoo-supplies.form', [
            'pageTitle' => 'Edit Tattoo Supply',
            'supply' => $tattooSupply,
        ]);
    }

    public function update(UpdateTattooSupplyRequest $request, TattooSupply $tattooSupply): RedirectResponse
    {
        $data = $request->validated();

        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            if ($tattooSupply->image && Storage::disk('public')->exists($tattooSupply->image)) {
                Storage::disk('public')->delete($tattooSupply->image);
            }
            $data['image'] = $data['image']->store('tattoo-supplies', 'public');
        } else {
            unset($data['image']);
        }

        $tattooSupply->update($data);

        return redirect()->route('admin.products.index', ['tab' => 'supplies'])
            ->with('success', 'Tattoo supply updated successfully.');
    }

    public function destroy(TattooSupply $tattooSupply): RedirectResponse
    {
        if ($tattooSupply->image && Storage::disk('public')->exists($tattooSupply->image)) {
            Storage::disk('public')->delete($tattooSupply->image);
        }

        $tattooSupply->delete();

        return redirect()->route('admin.products.index', ['tab' => 'supplies'])
            ->with('success', 'Tattoo supply deleted successfully.');
    }
}
