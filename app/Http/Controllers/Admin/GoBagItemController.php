<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGoBagItemRequest;
use App\Http\Requests\UpdateGoBagItemRequest;
use App\Models\GoBagItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class GoBagItemController extends Controller
{
    public function index(): View
    {
        $items = GoBagItem::latest()->get();
        return view('admin.go-bag-items', compact('items'));
    }

    public function store(StoreGoBagItemRequest $request): RedirectResponse
    {
        GoBagItem::create($request->validated());
        return back()->with('success', 'Go-Bag item created successfully.');
    }

    public function update(UpdateGoBagItemRequest $request, GoBagItem $goBagItem): RedirectResponse
    {
        $goBagItem->update($request->validated());
        return back()->with('success', 'Go-Bag item updated successfully.');
    }

    public function destroy(GoBagItem $goBagItem): RedirectResponse
    {
        $goBagItem->delete();
        return back()->with('success', 'Go-Bag item deleted successfully.');
    }
}
