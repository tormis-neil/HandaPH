<?php

namespace Database\Seeders;

use App\Models\ChecklistRule;
use Illuminate\Database\Seeder;

class ChecklistRulesSeeder extends Seeder
{
    public function run(): void
    {
        $rules = [
            // BEFORE — Universal
            ['item_text' => 'Store at least 3 liters of water per person per day for a minimum of 3 days', 'phase' => 'before', 'tag' => 'Water', 'tag_class' => 'tag-water', 'locations' => [], 'sizes' => [], 'special_needs' => [], 'house_types' => []],
            ['item_text' => 'Prepare a 3-day supply of non-perishable food (canned goods, instant noodles, biscuits)', 'phase' => 'before', 'tag' => 'Food', 'tag_class' => 'tag-food', 'locations' => [], 'sizes' => [], 'special_needs' => [], 'house_types' => []],
            ['item_text' => 'Assemble a basic first aid kit (bandages, antiseptic, pain relievers, gauze)', 'phase' => 'before', 'tag' => 'Medical', 'tag_class' => 'tag-medical', 'locations' => [], 'sizes' => [], 'special_needs' => [], 'house_types' => []],
            ['item_text' => 'Make waterproof copies of important documents (IDs, birth certificates, land titles, insurance)', 'phase' => 'before', 'tag' => 'Documents', 'tag_class' => 'tag-documents', 'locations' => [], 'sizes' => [], 'special_needs' => [], 'house_types' => []],
            ['item_text' => 'Prepare a working flashlight and extra batteries', 'phase' => 'before', 'tag' => 'Tools', 'tag_class' => 'tag-tools', 'locations' => [], 'sizes' => [], 'special_needs' => [], 'house_types' => []],
            ['item_text' => 'Keep a battery-powered or hand-crank radio to receive PAGASA and NDRRMC updates', 'phase' => 'before', 'tag' => 'Tools', 'tag_class' => 'tag-tools', 'locations' => [], 'sizes' => [], 'special_needs' => [], 'house_types' => []],
            ['item_text' => 'Pack at least 3 days of clothing, including rain gear and sturdy closed footwear', 'phase' => 'before', 'tag' => 'Shelter', 'tag_class' => 'tag-shelter', 'locations' => [], 'sizes' => [], 'special_needs' => [], 'house_types' => []],
            ['item_text' => 'Fully charge all mobile phones and power banks before the typhoon arrives', 'phase' => 'before', 'tag' => 'Tools', 'tag_class' => 'tag-tools', 'locations' => [], 'sizes' => [], 'special_needs' => [], 'house_types' => []],
            ['item_text' => 'Set aside emergency cash in small denominations inside a waterproof container', 'phase' => 'before', 'tag' => 'Documents', 'tag_class' => 'tag-documents', 'locations' => [], 'sizes' => [], 'special_needs' => [], 'house_types' => []],
            ['item_text' => 'Identify your nearest evacuation center and plan your evacuation route in advance', 'phase' => 'before', 'tag' => 'Safety', 'tag_class' => 'tag-safety', 'locations' => [], 'sizes' => [], 'special_needs' => [], 'house_types' => []],
            ['item_text' => 'Secure or bring inside loose outdoor items (furniture, flowerpots, signs) that can become flying debris', 'phase' => 'before', 'tag' => 'Safety', 'tag_class' => 'tag-safety', 'locations' => [], 'sizes' => [], 'special_needs' => [], 'house_types' => []],
            ['item_text' => 'Assign a family meeting point and designate an out-of-area contact person', 'phase' => 'before', 'tag' => 'Safety', 'tag_class' => 'tag-safety', 'locations' => [], 'sizes' => [], 'special_needs' => [], 'house_types' => []],

            // BEFORE — Location-specific
            ['item_text' => 'Prepare sandbags to block doorways and low-lying openings against rising floodwater', 'phase' => 'before', 'tag' => 'Safety', 'tag_class' => 'tag-safety', 'locations' => ['flood-prone', 'coastal'], 'sizes' => [], 'special_needs' => [], 'house_types' => []],
            ['item_text' => 'Know your storm surge risk zone — if in Zone 1 to 4, be ready to evacuate immediately when ordered', 'phase' => 'before', 'tag' => 'Safety', 'tag_class' => 'tag-safety', 'locations' => ['coastal'], 'sizes' => [], 'special_needs' => [], 'house_types' => []],
            ['item_text' => 'Monitor river water levels and identify elevated ground or vertical evacuation points near your home', 'phase' => 'before', 'tag' => 'Safety', 'tag_class' => 'tag-safety', 'locations' => ['flood-prone'], 'sizes' => [], 'special_needs' => [], 'house_types' => []],
            ['item_text' => 'Watch for landslide warning signs: ground cracks, unusual sounds, and tilting trees near slopes', 'phase' => 'before', 'tag' => 'Safety', 'tag_class' => 'tag-safety', 'locations' => ['mountainous'], 'sizes' => [], 'special_needs' => [], 'house_types' => []],
            ['item_text' => 'Check and clear drainage canals and gutters around your property to reduce urban flooding risk', 'phase' => 'before', 'tag' => 'Safety', 'tag_class' => 'tag-safety', 'locations' => ['inland'], 'sizes' => [], 'special_needs' => [], 'house_types' => []],

            // BEFORE — House type-specific
            ['item_text' => 'Reinforce walls and roof with extra tie-down wires or rope before the typhoon arrives', 'phase' => 'before', 'tag' => 'Shelter', 'tag_class' => 'tag-shelter', 'locations' => [], 'sizes' => [], 'special_needs' => [], 'house_types' => ['light']],
            ['item_text' => 'Identify the strongest interior room in your house (away from windows) as your shelter spot', 'phase' => 'before', 'tag' => 'Shelter', 'tag_class' => 'tag-shelter', 'locations' => [], 'sizes' => [], 'special_needs' => [], 'house_types' => ['light', 'semi-concrete']],
            ['item_text' => 'Plan to evacuate early — light-material homes face high risk of structural failure in strong typhoons', 'phase' => 'before', 'tag' => 'Safety', 'tag_class' => 'tag-safety', 'locations' => [], 'sizes' => [], 'special_needs' => [], 'house_types' => ['light']],
            ['item_text' => 'Reinforce windows and glass doors with masking tape or wooden boards to reduce shattering risk', 'phase' => 'before', 'tag' => 'Shelter', 'tag_class' => 'tag-shelter', 'locations' => [], 'sizes' => [], 'special_needs' => [], 'house_types' => ['semi-concrete', 'concrete']],

            // BEFORE — Household size-specific
            ['item_text' => 'Calculate your total water and food needs: 3 liters per person per day, multiplied by 3 days minimum', 'phase' => 'before', 'tag' => 'Water', 'tag_class' => 'tag-water', 'locations' => [], 'sizes' => ['5-7', '8-plus'], 'special_needs' => [], 'house_types' => []],
            ['item_text' => 'Coordinate evacuation transport for your large household — contact your barangay for vehicle assistance if needed', 'phase' => 'before', 'tag' => 'Safety', 'tag_class' => 'tag-safety', 'locations' => [], 'sizes' => ['8-plus'], 'special_needs' => [], 'house_types' => []],

            // BEFORE — Special needs
            ['item_text' => 'Prepare infant formula, diapers, baby wipes, and baby medicines for at least 3 days', 'phase' => 'before', 'tag' => 'Special', 'tag_class' => 'tag-special', 'locations' => [], 'sizes' => [], 'special_needs' => ['children'], 'house_types' => []],
            ['item_text' => 'Pack small entertainment items for children (toys, coloring books) to reduce stress during shelter-in-place', 'phase' => 'before', 'tag' => 'Special', 'tag_class' => 'tag-special', 'locations' => [], 'sizes' => [], 'special_needs' => ['children'], 'house_types' => []],
            ['item_text' => 'Prepare a written list of medications and dosages for senior family members with at least 7 days of supply', 'phase' => 'before', 'tag' => 'Medical', 'tag_class' => 'tag-medical', 'locations' => [], 'sizes' => [], 'special_needs' => ['seniors'], 'house_types' => []],
            ['item_text' => 'Set up a buddy system — assign a household member to assist the senior during evacuation', 'phase' => 'before', 'tag' => 'Special', 'tag_class' => 'tag-special', 'locations' => [], 'sizes' => [], 'special_needs' => ['seniors'], 'house_types' => []],
            ['item_text' => 'Ensure mobility aids (wheelchair, walker, crutches) are accessible and included in the Go-Bag area', 'phase' => 'before', 'tag' => 'Special', 'tag_class' => 'tag-special', 'locations' => [], 'sizes' => [], 'special_needs' => ['pwd'], 'house_types' => []],
            ['item_text' => 'Inform your barangay DRRM office about PWD household members to receive priority evacuation assistance', 'phase' => 'before', 'tag' => 'Safety', 'tag_class' => 'tag-safety', 'locations' => [], 'sizes' => [], 'special_needs' => ['pwd'], 'house_types' => []],
            ['item_text' => 'Prepare a pet carrier or crate, leash, pet food, water bowl, and vaccination records', 'phase' => 'before', 'tag' => 'Special', 'tag_class' => 'tag-special', 'locations' => [], 'sizes' => [], 'special_needs' => ['pets'], 'house_types' => []],
            ['item_text' => 'Locate pet-friendly evacuation centers in your area — most public centers do not allow animals', 'phase' => 'before', 'tag' => 'Safety', 'tag_class' => 'tag-safety', 'locations' => [], 'sizes' => [], 'special_needs' => ['pets'], 'house_types' => []],

            // DURING — Universal
            ['item_text' => 'Stay indoors and move away from windows, glass doors, and exterior walls', 'phase' => 'during', 'tag' => 'Safety', 'tag_class' => 'tag-safety', 'locations' => [], 'sizes' => [], 'special_needs' => [], 'house_types' => []],
            ['item_text' => 'Monitor PAGASA bulletins and LGU announcements continuously on your battery-powered radio', 'phase' => 'during', 'tag' => 'Tools', 'tag_class' => 'tag-tools', 'locations' => [], 'sizes' => [], 'special_needs' => [], 'house_types' => []],
            ['item_text' => 'Do NOT go outside during the eye of the typhoon — the most dangerous eyewall returns shortly after', 'phase' => 'during', 'tag' => 'Safety', 'tag_class' => 'tag-safety', 'locations' => [], 'sizes' => [], 'special_needs' => [], 'house_types' => []],
            ['item_text' => 'Use your flashlight instead of candles or open flames to eliminate fire risk', 'phase' => 'during', 'tag' => 'Tools', 'tag_class' => 'tag-tools', 'locations' => [], 'sizes' => [], 'special_needs' => [], 'house_types' => []],
            ['item_text' => 'Unplug all appliances and turn off the main circuit breaker if floodwater begins to enter', 'phase' => 'during', 'tag' => 'Safety', 'tag_class' => 'tag-safety', 'locations' => [], 'sizes' => [], 'special_needs' => [], 'house_types' => []],
            ['item_text' => 'Keep all windows and doors tightly shut and sealed throughout the entire storm', 'phase' => 'during', 'tag' => 'Shelter', 'tag_class' => 'tag-shelter', 'locations' => [], 'sizes' => [], 'special_needs' => [], 'house_types' => []],
            ['item_text' => 'Send text messages instead of calls to conserve battery power and reduce network congestion', 'phase' => 'during', 'tag' => 'Tools', 'tag_class' => 'tag-tools', 'locations' => [], 'sizes' => [], 'special_needs' => [], 'house_types' => []],

            // DURING — Location/house/needs-specific
            ['item_text' => 'Move to the highest floor or rooftop immediately if floodwater rises rapidly — do not wait', 'phase' => 'during', 'tag' => 'Safety', 'tag_class' => 'tag-safety', 'locations' => ['flood-prone', 'coastal'], 'sizes' => [], 'special_needs' => [], 'house_types' => []],
            ['item_text' => 'Never attempt to cross flooded roads or rivers — fast-moving water can sweep away an adult', 'phase' => 'during', 'tag' => 'Safety', 'tag_class' => 'tag-safety', 'locations' => ['flood-prone', 'coastal', 'inland'], 'sizes' => [], 'special_needs' => [], 'house_types' => []],
            ['item_text' => 'Evacuate immediately upon hearing rumbling sounds, cracking, or unusual noises near slopes', 'phase' => 'during', 'tag' => 'Safety', 'tag_class' => 'tag-safety', 'locations' => ['mountainous'], 'sizes' => [], 'special_needs' => [], 'house_types' => []],
            ['item_text' => 'Evacuate immediately if your home shows structural stress — do not shelter in a light-material house during a strong typhoon', 'phase' => 'during', 'tag' => 'Safety', 'tag_class' => 'tag-safety', 'locations' => [], 'sizes' => [], 'special_needs' => [], 'house_types' => ['light']],
            ['item_text' => 'Keep children calm with simple, reassuring explanations of what is happening around them', 'phase' => 'during', 'tag' => 'Special', 'tag_class' => 'tag-special', 'locations' => [], 'sizes' => [], 'special_needs' => ['children'], 'house_types' => []],
            ['item_text' => 'Ensure senior family members take medications on schedule and monitor their condition throughout', 'phase' => 'during', 'tag' => 'Medical', 'tag_class' => 'tag-medical', 'locations' => [], 'sizes' => [], 'special_needs' => ['seniors'], 'house_types' => []],
            ['item_text' => 'Keep PWD family members close and ensure immediate access to mobility aids at all times', 'phase' => 'during', 'tag' => 'Special', 'tag_class' => 'tag-special', 'locations' => [], 'sizes' => [], 'special_needs' => ['pwd'], 'house_types' => []],
            ['item_text' => 'Keep pets confined in their carrier or a secure interior room — frightened animals can become aggressive', 'phase' => 'during', 'tag' => 'Special', 'tag_class' => 'tag-special', 'locations' => [], 'sizes' => [], 'special_needs' => ['pets'], 'house_types' => []],

            // AFTER — Universal
            ['item_text' => 'Wait for the official all-clear from PAGASA and your LGU before going outside', 'phase' => 'after', 'tag' => 'Safety', 'tag_class' => 'tag-safety', 'locations' => [], 'sizes' => [], 'special_needs' => [], 'house_types' => []],
            ['item_text' => 'Do not drink tap water until authorities declare it safe — use your stored or bottled water', 'phase' => 'after', 'tag' => 'Water', 'tag_class' => 'tag-water', 'locations' => [], 'sizes' => [], 'special_needs' => [], 'house_types' => []],
            ['item_text' => 'Inspect your home for structural damage before re-entering — check walls, roof, and foundation', 'phase' => 'after', 'tag' => 'Shelter', 'tag_class' => 'tag-shelter', 'locations' => [], 'sizes' => [], 'special_needs' => [], 'house_types' => []],
            ['item_text' => 'Document all property damage with photos and video for insurance claims or government assistance', 'phase' => 'after', 'tag' => 'Documents', 'tag_class' => 'tag-documents', 'locations' => [], 'sizes' => [], 'special_needs' => [], 'house_types' => []],
            ['item_text' => 'Discard any food that came in contact with floodwater — it is unsafe to consume', 'phase' => 'after', 'tag' => 'Food', 'tag_class' => 'tag-food', 'locations' => [], 'sizes' => [], 'special_needs' => [], 'house_types' => []],
            ['item_text' => 'Assume all downed electrical wires are live — stay away and report to your electric cooperative', 'phase' => 'after', 'tag' => 'Safety', 'tag_class' => 'tag-safety', 'locations' => [], 'sizes' => [], 'special_needs' => [], 'house_types' => []],
            ['item_text' => 'Report injuries, missing persons, and road blockages to your barangay or NDRRMC hotline 911', 'phase' => 'after', 'tag' => 'Safety', 'tag_class' => 'tag-safety', 'locations' => [], 'sizes' => [], 'special_needs' => [], 'house_types' => []],
            ['item_text' => 'Sanitize all surfaces, containers, and utensils that may have been exposed to floodwater', 'phase' => 'after', 'tag' => 'Medical', 'tag_class' => 'tag-medical', 'locations' => [], 'sizes' => [], 'special_needs' => [], 'house_types' => []],
            ['item_text' => 'Replenish all Go-Bag supplies used during the typhoon: water, food, batteries, and medicines', 'phase' => 'after', 'tag' => 'Tools', 'tag_class' => 'tag-tools', 'locations' => [], 'sizes' => [], 'special_needs' => [], 'house_types' => []],

            // AFTER — Location/needs-specific
            ['item_text' => 'Do not return to flood-prone or coastal areas until water has fully receded and LGU declares it safe', 'phase' => 'after', 'tag' => 'Safety', 'tag_class' => 'tag-safety', 'locations' => ['flood-prone', 'coastal'], 'sizes' => [], 'special_needs' => [], 'house_types' => []],
            ['item_text' => 'Watch for post-typhoon landslide warnings — rainfall during cleanup can trigger secondary landslides', 'phase' => 'after', 'tag' => 'Safety', 'tag_class' => 'tag-safety', 'locations' => ['mountainous'], 'sizes' => [], 'special_needs' => [], 'house_types' => []],
            ['item_text' => 'Watch for signs of typhoon trauma or emotional distress in children — seek psychosocial support if needed', 'phase' => 'after', 'tag' => 'Special', 'tag_class' => 'tag-special', 'locations' => [], 'sizes' => [], 'special_needs' => ['children'], 'house_types' => []],
            ['item_text' => 'Monitor senior family members for post-typhoon illness, dehydration, or emotional stress', 'phase' => 'after', 'tag' => 'Medical', 'tag_class' => 'tag-medical', 'locations' => [], 'sizes' => [], 'special_needs' => ['seniors'], 'house_types' => []],
            ['item_text' => 'Coordinate with barangay health workers or social workers for PWD recovery and rehabilitation support', 'phase' => 'after', 'tag' => 'Special', 'tag_class' => 'tag-special', 'locations' => [], 'sizes' => [], 'special_needs' => ['pwd'], 'house_types' => []],
            ['item_text' => 'Check pets for injuries, dehydration, or stress after the typhoon — visit a vet if needed', 'phase' => 'after', 'tag' => 'Special', 'tag_class' => 'tag-special', 'locations' => [], 'sizes' => [], 'special_needs' => ['pets'], 'house_types' => []],
        ];

        foreach ($rules as $rule) {
            ChecklistRule::create($rule);
        }
    }
}