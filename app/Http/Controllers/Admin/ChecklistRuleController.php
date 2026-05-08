<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChecklistRuleRequest;
use App\Http\Requests\UpdateChecklistRuleRequest;
use App\Models\ChecklistRule;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ChecklistRuleController extends Controller
{
    public function index(): View
    {
        // We fetch all rules (no pagination needed since there are ~60 items)
        $rules = ChecklistRule::latest()->get();
        return view('admin.checklist-rules', compact('rules'));
    }

    public function store(StoreChecklistRuleRequest $request): RedirectResponse
    {
        ChecklistRule::create($request->validated());
        return back()->with('success', 'Checklist rule created successfully.');
    }

    public function update(UpdateChecklistRuleRequest $request, ChecklistRule $checklistRule): RedirectResponse
    {
        $checklistRule->update($request->validated());
        return back()->with('success', 'Checklist rule updated successfully.');
    }

    public function destroy(ChecklistRule $checklistRule): RedirectResponse
    {
        $checklistRule->delete();
        return back()->with('success', 'Checklist rule deleted successfully.');
    }
}
