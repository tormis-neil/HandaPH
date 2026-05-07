<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SurveySubmission;
use Illuminate\Http\JsonResponse;

class AnalyticsController extends Controller
{
    public function summary(): JsonResponse
    {
        return response()->json([
            'location' => $this->locationDistribution(),
            'household_size' => $this->householdSizeDistribution(),
            'special_needs' => $this->specialNeedsDistribution(),
            'house_type' => $this->houseTypeDistribution(),
        ]);
    }

    private function locationDistribution(): array
    {
        $rows = SurveySubmission::selectRaw('location, COUNT(*) as count')
            ->groupBy('location')
            ->pluck('count', 'location')
            ->toArray();

        return [
            'coastal'     => $rows['coastal']     ?? 0,
            'mountainous' => $rows['mountainous'] ?? 0,
            'inland'      => $rows['inland']      ?? 0,
            'flood-prone' => $rows['flood-prone'] ?? 0,
        ];
    }

    private function householdSizeDistribution(): array
    {
        $rows = SurveySubmission::selectRaw('household_size, COUNT(*) as count')
            ->groupBy('household_size')
            ->pluck('count', 'household_size')
            ->toArray();

        return [
            '1'      => $rows['1']      ?? 0,
            '2-4'    => $rows['2-4']    ?? 0,
            '5-7'    => $rows['5-7']    ?? 0,
            '8-plus' => $rows['8-plus'] ?? 0,
        ];
    }

    private function specialNeedsDistribution(): array
    {
        $counts = ['children' => 0, 'seniors' => 0, 'pwd' => 0, 'pets' => 0];

        SurveySubmission::pluck('special_needs')->each(function ($needs) use (&$counts) {
            foreach ((array) $needs as $need) {
                if (isset($counts[$need])) {
                    $counts[$need]++;
                }
            }
        });

        return $counts;
    }

    private function houseTypeDistribution(): array
    {
        $rows = SurveySubmission::selectRaw('house_type, COUNT(*) as count')
            ->groupBy('house_type')
            ->pluck('count', 'house_type')
            ->toArray();

        return [
            'light'         => $rows['light']         ?? 0,
            'semi-concrete' => $rows['semi-concrete'] ?? 0,
            'concrete'      => $rows['concrete']      ?? 0,
        ];
    }
}