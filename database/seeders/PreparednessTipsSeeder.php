<?php

namespace Database\Seeders;

use App\Models\PreparednessTip;
use Illuminate\Database\Seeder;

class PreparednessTipsSeeder extends Seeder
{
    public function run(): void
    {
        $tips = [
            ['logic_id' => 'TIP-101', 'title' => 'Build a 3-day water supply', 'content' => 'Stock at least 3 liters of safe drinking water per person per day for a minimum of 3 days.', 'tag' => 'before'],
            ['logic_id' => 'TIP-102', 'title' => 'Secure heavy furniture', 'content' => 'Anchor heavy furniture and clear walkways before the storm arrives.', 'tag' => 'before'],
            ['logic_id' => 'TIP-103', 'title' => 'Charge all devices', 'content' => 'Fully charge phones and power banks before the typhoon arrives.', 'tag' => 'before'],
            ['logic_id' => 'TIP-104', 'title' => 'Identify evacuation route', 'content' => 'Know the nearest evacuation center and the safest route to reach it.', 'tag' => 'before'],
            ['logic_id' => 'TIP-105', 'title' => 'Pack important documents', 'content' => 'Keep IDs, birth certificates, and insurance papers in waterproof bags.', 'tag' => 'before'],
            ['logic_id' => 'TIP-201', 'title' => 'Stay away from windows', 'content' => 'Move to interior rooms during the storm to reduce injury risk from broken glass.', 'tag' => 'during'],
            ['logic_id' => 'TIP-202', 'title' => 'Use flashlights only', 'content' => 'Avoid candles or open flames during the storm — they are a fire hazard.', 'tag' => 'during'],
            ['logic_id' => 'TIP-203', 'title' => 'Switch off the main breaker', 'content' => 'If floodwater enters your home, turn off the main electrical breaker immediately.', 'tag' => 'during'],
            ['logic_id' => 'TIP-204', 'title' => 'Conserve phone battery', 'content' => 'Send text messages instead of voice calls to save battery and ease network congestion.', 'tag' => 'during'],
            ['logic_id' => 'TIP-205', 'title' => 'Beware the eye', 'content' => 'The calm during the typhoon eye is temporary — do not go outside.', 'tag' => 'during'],
            ['logic_id' => 'TIP-301', 'title' => 'Boil tap water', 'content' => 'Do not drink tap water after the typhoon until authorities declare it safe.', 'tag' => 'after'],
            ['logic_id' => 'TIP-302', 'title' => 'Document property damage', 'content' => 'Photograph or video all damage for insurance and government assistance claims.', 'tag' => 'after'],
            ['logic_id' => 'TIP-303', 'title' => 'Avoid downed wires', 'content' => 'Treat all downed electrical wires as live — report them to your electric cooperative.', 'tag' => 'after'],
            ['logic_id' => 'TIP-304', 'title' => 'Discard contaminated food', 'content' => 'Throw away any food that touched floodwater — it can cause illness.', 'tag' => 'after'],
            ['logic_id' => 'TIP-305', 'title' => 'Replenish your Go-Bag', 'content' => 'Restock water, food, batteries, and medicines used during the typhoon.', 'tag' => 'after'],
        ];

        foreach ($tips as $tip) {
            PreparednessTip::create($tip);
        }
    }
}