<?php

namespace App\Services;

use App\Models\ChecklistRule;
use Illuminate\Support\Collection;

class ChecklistRuleEngine
{
    /**
     * Filter active rules by user selections, group by phase.
     *
     * @param array $selections [
     *   'location' => string,
     *   'household_size' => string,
     *   'special_needs' => array,
     *   'house_type' => string,
     * ]
     * @return array{before: Collection, during: Collection, after: Collection}
     */
    public function filter(array $selections): array
    {
        $rules = ChecklistRule::where('is_active', true)->get();

        $matched = $rules->filter(function ($rule) use ($selections) {
            return $this->matches($rule, $selections);
        });

        return [
            'before' => $matched->where('phase', 'before')->values(),
            'during' => $matched->where('phase', 'during')->values(),
            'after'  => $matched->where('phase', 'after')->values(),
        ];
    }

    private function matches(ChecklistRule $rule, array $selections): bool
    {
        $locMatch  = empty($rule->locations)
            || in_array($selections['location'], $rule->locations, true);

        $sizeMatch = empty($rule->sizes)
            || in_array($selections['household_size'], $rule->sizes, true);

        $needsMatch = empty($rule->special_needs)
            || count(array_intersect($rule->special_needs, $selections['special_needs'])) > 0;

        $houseMatch = empty($rule->house_types)
            || in_array($selections['house_type'], $rule->house_types, true);

        return $locMatch && $sizeMatch && $needsMatch && $houseMatch;
    }
}