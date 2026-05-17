<?php

namespace Database\Seeders;

use App\Models\ChecklistRule;
use Illuminate\Database\Seeder;

class ChecklistRulesSeeder extends Seeder
{
    public function run(): void
    {
        $u = []; // universal (match all)
        $rules = [];

        // ── BEFORE: Universal (everyone gets these) ─────────────────────────
        $before_universal = [
            ['Store 3 liters of drinking water per person per day for at least 3 days.', 'Water', 'tag-water'],
            ['Prepare a 3-day supply of non-perishable food (canned goods, biscuits, instant noodles).', 'Food', 'tag-food'],
            ['Assemble a basic first aid kit: bandages, antiseptic, pain relievers, gauze.', 'Medical', 'tag-medical'],
            ['Make waterproof copies of IDs, birth certificates, land titles, and insurance papers.', 'Documents', 'tag-documents'],
            ['Prepare a working flashlight with extra batteries.', 'Tools', 'tag-tools'],
            ['Keep a battery-powered or hand-crank radio for PAGASA and NDRRMC updates.', 'Tools', 'tag-tools'],
            ['Fully charge all mobile phones and power banks before the typhoon arrives.', 'Tools', 'tag-tools'],
            ['Set aside emergency cash in small denominations in a waterproof container.', 'Documents', 'tag-documents'],
            ['Know your nearest evacuation center and plan your route in advance.', 'Safety', 'tag-safety'],
            ['Assign a family meeting point and designate an out-of-area contact person.', 'Safety', 'tag-safety'],
            ['Secure or bring indoors all loose outdoor items (furniture, signs, pots).', 'Safety', 'tag-safety'],
            ['Pack at least 3 days of clothing including rain gear and sturdy closed footwear.', 'Shelter', 'tag-shelter'],
        ];
        foreach ($before_universal as [$text, $tag, $cls]) {
            $rules[] = ['item_text'=>$text,'phase'=>'before','tag'=>$tag,'tag_class'=>$cls,'locations'=>[],'sizes'=>[],'special_needs'=>[],'house_types'=>[],'is_active'=>true];
        }

        // BEFORE: Location-specific
        $before_location = [
            ['coastal'    , 'Prepare sandbags to block doorways and low openings against rising seawater.', 'Safety', 'tag-safety'],
            ['coastal'    , 'Know your storm surge risk zone (Zone 1–4) and be ready to evacuate immediately.', 'Safety', 'tag-safety'],
            ['coastal'    , 'Store valuables and documents on the highest floor to protect from storm surge.', 'Documents', 'tag-documents'],
            ['coastal'    , 'Identify a vertical evacuation point (multi-story building) in case roads are flooded.', 'Safety', 'tag-safety'],
            ['flood-prone', 'Prepare sandbags to block doorways and low-lying openings against rising floodwater.', 'Safety', 'tag-safety'],
            ['flood-prone', 'Monitor river and creek water levels and identify elevated ground nearby.', 'Safety', 'tag-safety'],
            ['flood-prone', 'Elevate appliances, furniture, and valuables off the floor before the typhoon.', 'Shelter', 'tag-shelter'],
            ['flood-prone', 'Know your barangay\'s flood alarm system and the signal levels that trigger evacuation.', 'Safety', 'tag-safety'],
            ['mountainous', 'Watch for early landslide signs: ground cracks, tilting trees, unusual sounds.', 'Safety', 'tag-safety'],
            ['mountainous', 'Identify evacuation routes that avoid slope areas and river channels.', 'Safety', 'tag-safety'],
            ['mountainous', 'Report ground movement or cracks to your barangay DRRM officer immediately.', 'Safety', 'tag-safety'],
            ['mountainous', 'Prepare a rapid-evacuation bag you can grab in under 2 minutes.', 'Safety', 'tag-safety'],
            ['inland'     , 'Clear drainage canals and gutters around your property to reduce urban flooding.', 'Safety', 'tag-safety'],
            ['inland'     , 'Know the locations of low-lying streets in your area that flood first.', 'Safety', 'tag-safety'],
            ['inland'     , 'Check nearby infrastructure (bridges, drainage) condition before the typhoon.', 'Safety', 'tag-safety'],
        ];
        foreach ($before_location as [$loc, $text, $tag, $cls]) {
            $rules[] = ['item_text'=>$text,'phase'=>'before','tag'=>$tag,'tag_class'=>$cls,'locations'=>[$loc],'sizes'=>[],'special_needs'=>[],'house_types'=>[],'is_active'=>true];
        }

        // BEFORE: House-type-specific
        $before_house = [
            ['light'        , 'Reinforce walls and roof with extra tie-down wires or rope before the typhoon.', 'Shelter', 'tag-shelter'],
            ['light'        , 'Plan early evacuation — light-material homes have high structural failure risk in strong typhoons.', 'Safety', 'tag-safety'],
            ['light'        , 'Identify the strongest interior room (away from windows) as your shelter spot.', 'Shelter', 'tag-shelter'],
            ['light'        , 'Inform your barangay captain you live in a light-material house so priority evacuation can be arranged.', 'Safety', 'tag-safety'],
            ['semi-concrete', 'Reinforce windows and glass doors with masking tape or wooden boards to reduce shattering.', 'Shelter', 'tag-shelter'],
            ['semi-concrete', 'Identify the strongest interior room away from windows as your safe spot during the storm.', 'Shelter', 'tag-shelter'],
            ['semi-concrete', 'Check and reinforce any wood-framed sections (roof trusses, door frames) that may weaken.', 'Shelter', 'tag-shelter'],
            ['concrete'     , 'Reinforce windows and glass doors with masking tape or plywood boards.', 'Shelter', 'tag-shelter'],
            ['concrete'     , 'Inspect your roof for loose sheets or weakened bolts and secure them before the typhoon.', 'Shelter', 'tag-shelter'],
            ['concrete'     , 'Even in a concrete home, stay in an interior room away from windows during the storm.', 'Shelter', 'tag-shelter'],
        ];
        foreach ($before_house as [$house, $text, $tag, $cls]) {
            $rules[] = ['item_text'=>$text,'phase'=>'before','tag'=>$tag,'tag_class'=>$cls,'locations'=>[],'sizes'=>[],'special_needs'=>[],'house_types'=>[$house],'is_active'=>true];
        }

        // BEFORE: Size-specific
        $before_size = [
            ['5-7'   , 'Calculate total water needs: 3 liters × number of people × 3 days minimum.', 'Water', 'tag-water'],
            ['5-7'   , 'Assign specific roles to each household member (water carrier, document keeper, first-aid person).', 'Safety', 'tag-safety'],
            ['8-plus', 'Calculate total water needs: 3 liters × number of people × 3 days minimum.', 'Water', 'tag-water'],
            ['8-plus', 'Contact your barangay for vehicle assistance for large-household evacuation if needed.', 'Safety', 'tag-safety'],
            ['8-plus', 'Create a written household evacuation plan with assigned roles for every adult member.', 'Safety', 'tag-safety'],
        ];
        foreach ($before_size as [$size, $text, $tag, $cls]) {
            $rules[] = ['item_text'=>$text,'phase'=>'before','tag'=>$tag,'tag_class'=>$cls,'locations'=>[],'sizes'=>[$size],'special_needs'=>[],'house_types'=>[],'is_active'=>true];
        }

        // BEFORE: Special-needs-specific
        $before_needs = [
            ['children', 'Prepare infant formula, diapers, baby wipes, and children\'s medicines for at least 3 days.', 'Special', 'tag-special'],
            ['children', 'Pack small toys, coloring books, or comfort items to reduce children\'s stress during the typhoon.', 'Special', 'tag-special'],
            ['children', 'Teach children the family meeting point, the contact person\'s number, and what to do if separated.', 'Safety', 'tag-safety'],
            ['seniors' , 'Prepare a written medication list with dosages and pack at least 7 days of supply.', 'Medical', 'tag-medical'],
            ['seniors' , 'Set up a buddy system: assign a household member to assist the senior during evacuation.', 'Special', 'tag-special'],
            ['seniors' , 'Pre-register your senior family member with the barangay health center for priority assistance.', 'Safety', 'tag-safety'],
            ['pwd'     , 'Ensure mobility aids (wheelchair, walker, crutches) are accessible and packed in the Go-Bag area.', 'Special', 'tag-special'],
            ['pwd'     , 'Inform your barangay DRRM office about PWD household members for priority evacuation.', 'Safety', 'tag-safety'],
            ['pwd'     , 'Prepare written communication cards if the PWD member has a speech or hearing impairment.', 'Special', 'tag-special'],
            ['pets'    , 'Prepare a pet carrier or crate, leash, pet food, water bowl, and vaccination records.', 'Special', 'tag-special'],
            ['pets'    , 'Locate pet-friendly evacuation centers in your area — most public centers do not allow animals.', 'Safety', 'tag-safety'],
            ['pets'    , 'Microchip or tag your pet with your contact number in case you are separated during evacuation.', 'Special', 'tag-special'],
        ];
        foreach ($before_needs as [$need, $text, $tag, $cls]) {
            $rules[] = ['item_text'=>$text,'phase'=>'before','tag'=>$tag,'tag_class'=>$cls,'locations'=>[],'sizes'=>[],'special_needs'=>[$need],'house_types'=>[],'is_active'=>true];
        }

        // ── DURING: Universal ────────────────────────────────────────────────
        $during_universal = [
            ['Stay indoors and move away from all windows, glass doors, and exterior walls.', 'Safety', 'tag-safety'],
            ['Monitor PAGASA bulletins continuously on your battery-powered radio.', 'Tools', 'tag-tools'],
            ['Do NOT go outside during the eye of the typhoon — the eyewall returns shortly after.', 'Safety', 'tag-safety'],
            ['Use flashlights instead of candles or open flames to eliminate fire risk.', 'Tools', 'tag-tools'],
            ['Unplug all appliances and turn off the main circuit breaker if floodwater begins to enter.', 'Safety', 'tag-safety'],
            ['Keep all windows and doors tightly shut and sealed throughout the entire storm.', 'Shelter', 'tag-shelter'],
            ['Send text messages instead of calls to conserve battery and reduce network congestion.', 'Tools', 'tag-tools'],
        ];
        foreach ($during_universal as [$text, $tag, $cls]) {
            $rules[] = ['item_text'=>$text,'phase'=>'during','tag'=>$tag,'tag_class'=>$cls,'locations'=>[],'sizes'=>[],'special_needs'=>[],'house_types'=>[],'is_active'=>true];
        }

        // DURING: Location-specific
        $during_location = [
            ['coastal'    , 'If storm surge warnings are active, evacuate to a multi-story building immediately — do not wait.', 'Safety', 'tag-safety'],
            ['coastal'    , 'Never return to the coast during or after the storm until authorities confirm the surge has receded.', 'Safety', 'tag-safety'],
            ['flood-prone', 'Move to the highest floor or rooftop immediately if floodwater rises rapidly — do not wait.', 'Safety', 'tag-safety'],
            ['flood-prone', 'Never attempt to cross flooded roads or rivers — fast-moving water can sweep away an adult.', 'Safety', 'tag-safety'],
            ['mountainous', 'Evacuate immediately upon hearing rumbling sounds, cracking, or unusual noises near slopes.', 'Safety', 'tag-safety'],
            ['mountainous', 'Stay away from rivers, streams, and drainage channels that can flash-flood without warning.', 'Safety', 'tag-safety'],
            ['inland'     , 'Never attempt to cross flooded streets even if the water looks shallow.', 'Safety', 'tag-safety'],
            ['inland'     , 'Watch for sudden rises in water level in drainage canals near your home.', 'Safety', 'tag-safety'],
        ];
        foreach ($during_location as [$loc, $text, $tag, $cls]) {
            $rules[] = ['item_text'=>$text,'phase'=>'during','tag'=>$tag,'tag_class'=>$cls,'locations'=>[$loc],'sizes'=>[],'special_needs'=>[],'house_types'=>[],'is_active'=>true];
        }

        // DURING: House-type-specific
        $during_house = [
            ['light'        , 'Evacuate immediately if your home shows structural stress — do not shelter in a light-material house during a strong typhoon.', 'Safety', 'tag-safety'],
            ['light'        , 'If evacuation is not possible, shelter under a heavy table away from walls and windows.', 'Shelter', 'tag-shelter'],
            ['semi-concrete', 'Shelter in the most interior room of your home away from windows and wood-framed sections.', 'Shelter', 'tag-shelter'],
            ['concrete'     , 'Stay in an interior room; even concrete homes can have windows shattered by debris.', 'Shelter', 'tag-shelter'],
        ];
        foreach ($during_house as [$house, $text, $tag, $cls]) {
            $rules[] = ['item_text'=>$text,'phase'=>'during','tag'=>$tag,'tag_class'=>$cls,'locations'=>[],'sizes'=>[],'special_needs'=>[],'house_types'=>[$house],'is_active'=>true];
        }

        // DURING: Special-needs-specific
        $during_needs = [
            ['children', 'Keep children calm with simple, honest explanations of what is happening around them.', 'Special', 'tag-special'],
            ['children', 'Ensure children are kept away from windows and exterior walls throughout the storm.', 'Safety', 'tag-safety'],
            ['seniors' , 'Ensure senior family members take medications on schedule and monitor their condition.', 'Medical', 'tag-medical'],
            ['seniors' , 'Keep seniors warm, hydrated, and seated safely away from windows and doors.', 'Special', 'tag-special'],
            ['pwd'     , 'Keep PWD family members close and ensure immediate access to mobility aids at all times.', 'Special', 'tag-special'],
            ['pwd'     , 'If power is lost, have a manual backup for any electrically-powered medical equipment.', 'Medical', 'tag-medical'],
            ['pets'    , 'Keep pets confined in their carrier or a secure interior room — frightened animals can become aggressive.', 'Special', 'tag-special'],
            ['pets'    , 'Ensure pets have enough water and food inside their carrier for the duration of the storm.', 'Special', 'tag-special'],
        ];
        foreach ($during_needs as [$need, $text, $tag, $cls]) {
            $rules[] = ['item_text'=>$text,'phase'=>'during','tag'=>$tag,'tag_class'=>$cls,'locations'=>[],'sizes'=>[],'special_needs'=>[$need],'house_types'=>[],'is_active'=>true];
        }

        // ── AFTER: Universal ─────────────────────────────────────────────────
        $after_universal = [
            ['Wait for the official all-clear from PAGASA and your LGU before going outside.', 'Safety', 'tag-safety'],
            ['Do not drink tap water until authorities declare it safe — use stored or bottled water.', 'Water', 'tag-water'],
            ['Inspect your home for structural damage before re-entering.', 'Shelter', 'tag-shelter'],
            ['Document all property damage with photos and video for insurance and assistance claims.', 'Documents', 'tag-documents'],
            ['Discard any food that came in contact with floodwater — it is unsafe to consume.', 'Food', 'tag-food'],
            ['Assume all downed electrical wires are live — stay away and report to your electric cooperative.', 'Safety', 'tag-safety'],
            ['Report injuries, missing persons, and road blockages to your barangay or NDRRMC hotline 911.', 'Safety', 'tag-safety'],
            ['Sanitize all surfaces, containers, and utensils that may have been exposed to floodwater.', 'Medical', 'tag-medical'],
            ['Replenish all Go-Bag supplies used: water, food, batteries, and medicines.', 'Tools', 'tag-tools'],
        ];
        foreach ($after_universal as [$text, $tag, $cls]) {
            $rules[] = ['item_text'=>$text,'phase'=>'after','tag'=>$tag,'tag_class'=>$cls,'locations'=>[],'sizes'=>[],'special_needs'=>[],'house_types'=>[],'is_active'=>true];
        }

        // AFTER: Location-specific
        $after_location = [
            ['coastal'    , 'Do not return to coastal areas until water has fully receded and LGU declares it safe.', 'Safety', 'tag-safety'],
            ['coastal'    , 'Check your boat, fishing equipment, and waterfront property only after the all-clear.', 'Safety', 'tag-safety'],
            ['flood-prone', 'Do not return to flood-prone areas until water has fully receded and LGU declares it safe.', 'Safety', 'tag-safety'],
            ['flood-prone', 'Pump out floodwater from your home and disinfect all affected surfaces with bleach solution.', 'Medical', 'tag-medical'],
            ['mountainous', 'Watch for post-typhoon landslide warnings — rain during cleanup can trigger secondary slides.', 'Safety', 'tag-safety'],
            ['mountainous', 'Do not use damaged roads near slopes until engineers or authorities have inspected them.', 'Safety', 'tag-safety'],
            ['inland'     , 'Check drainage canals near your property for debris blockages that could cause future flooding.', 'Safety', 'tag-safety'],
            ['inland'     , 'Report damaged road infrastructure and clogged drainage to your local engineering office.', 'Safety', 'tag-safety'],
        ];
        foreach ($after_location as [$loc, $text, $tag, $cls]) {
            $rules[] = ['item_text'=>$text,'phase'=>'after','tag'=>$tag,'tag_class'=>$cls,'locations'=>[$loc],'sizes'=>[],'special_needs'=>[],'house_types'=>[],'is_active'=>true];
        }

        // AFTER: House-type-specific
        $after_house = [
            ['light'        , 'Do not re-enter a light-material home until a neighbor or barangay official confirms it is structurally safe.', 'Shelter', 'tag-shelter'],
            ['light'        , 'Begin temporary repairs (patching roof, replacing damaged walls) only after the storm fully passes.', 'Shelter', 'tag-shelter'],
            ['semi-concrete', 'Inspect all wood-framed sections, roof trusses, and door frames for damage before re-entering.', 'Shelter', 'tag-shelter'],
            ['concrete'     , 'Inspect roof for displaced sheets and check for cracks in walls or foundation before re-entering.', 'Shelter', 'tag-shelter'],
        ];
        foreach ($after_house as [$house, $text, $tag, $cls]) {
            $rules[] = ['item_text'=>$text,'phase'=>'after','tag'=>$tag,'tag_class'=>$cls,'locations'=>[],'sizes'=>[],'special_needs'=>[],'house_types'=>[$house],'is_active'=>true];
        }

        // AFTER: Special-needs-specific
        $after_needs = [
            ['children', 'Watch for signs of typhoon trauma in children: nightmares, withdrawal, or unusual fear.', 'Special', 'tag-special'],
            ['children', 'Seek psychosocial support from barangay health workers if children show distress signs.', 'Medical', 'tag-medical'],
            ['seniors' , 'Monitor seniors for post-typhoon illness, dehydration, or emotional distress.', 'Medical', 'tag-medical'],
            ['seniors' , 'Schedule a follow-up with a doctor if a senior missed medications during the typhoon.', 'Medical', 'tag-medical'],
            ['pwd'     , 'Coordinate with barangay social workers for PWD recovery assistance and rehabilitation support.', 'Special', 'tag-special'],
            ['pwd'     , 'Replace or repair any damaged mobility aids or medical equipment as a priority.', 'Medical', 'tag-medical'],
            ['pets'    , 'Check pets for injuries, dehydration, or stress after the typhoon — visit a vet if needed.', 'Special', 'tag-special'],
            ['pets'    , 'Reunite lost pets using your barangay or local Facebook community group.', 'Special', 'tag-special'],
        ];
        foreach ($after_needs as [$need, $text, $tag, $cls]) {
            $rules[] = ['item_text'=>$text,'phase'=>'after','tag'=>$tag,'tag_class'=>$cls,'locations'=>[],'sizes'=>[],'special_needs'=>[$need],'house_types'=>[],'is_active'=>true];
        }

        foreach ($rules as $rule) {
            ChecklistRule::firstOrCreate($rule);
        }
    }
}