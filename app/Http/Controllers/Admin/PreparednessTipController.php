<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePreparednessTipRequest;
use App\Http\Requests\UpdatePreparednessTipRequest;
use App\Models\PreparednessTip;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class PreparednessTipController extends Controller
{
    public function index(): View
    {
        $tips = PreparednessTip::latest()->get();
        return view('admin.preparedness-tips', compact('tips'));
    }

    public function store(StorePreparednessTipRequest $request): RedirectResponse
    {
        PreparednessTip::create($request->validated());
        return back()->with('success', 'Tip created successfully.');
    }

    public function update(UpdatePreparednessTipRequest $request, PreparednessTip $preparednessTip): RedirectResponse
    {
        $preparednessTip->update($request->validated());
        return back()->with('success', 'Tip updated successfully.');
    }

    public function destroy(PreparednessTip $preparednessTip): RedirectResponse
    {
        $preparednessTip->delete();
        return back()->with('success', 'Tip deleted successfully.');
    }
}
