<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateChecklistRequest;
use App\Models\SurveySubmission;
use App\Services\ChecklistRuleEngine;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ChecklistController extends Controller
{
    public function index(): View
    {
        return view('checklist');
    }

    public function generate(GenerateChecklistRequest $request, ChecklistRuleEngine $engine): View
    {
        $data = $request->validated();

        SurveySubmission::create($data);

        $results = $engine->filter($data);

        return view('checklist', [
            'results' => $results,
            'selections' => $data,
        ]);
    }
}