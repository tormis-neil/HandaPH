<?php

namespace Database\Seeders;

use App\Models\TyphoonMyth;
use Illuminate\Database\Seeder;

class TyphoonMythsSeeder extends Seeder
{
    public function run(): void
    {
        $myths = [
            [
                'myth'   => '"The eye of the typhoon means the storm is over — it is safe to go outside."',
                'fact'   => 'The eye is a temporary calm. The most dangerous eyewall (with the strongest winds) returns immediately after the eye passes. Going outside during the eye has killed many Filipinos.',
                'action' => 'Stay indoors and away from windows until PAGASA officially declares the typhoon has passed.',
                'is_active' => true,
            ],
            [
                'myth'   => '"If it is not raining hard, the typhoon signal is low, so I do not need to prepare."',
                'fact'   => 'Typhoon signals describe wind speed, not just rainfall. A Signal No. 1 area can still experience dangerous flooding, storm surge, and landslides even with moderate rain.',
                'action' => 'Monitor PAGASA bulletins and your LGU announcements regardless of current weather conditions.',
                'is_active' => true,
            ],
            [
                'myth'   => '"Storm surge is just a big wave — I can stay home and wait it out."',
                'fact'   => 'Storm surge is a wall of seawater pushed by typhoon winds that can reach 2–7 meters high. It moves faster than a person can run and is responsible for the majority of typhoon deaths in the Philippines.',
                'action' => 'If you are in a coastal storm surge zone, evacuate immediately when ordered — do not wait.',
                'is_active' => true,
            ],
            [
                'myth'   => '"Opening windows during a typhoon equalizes air pressure and prevents roof damage."',
                'fact'   => 'This is a dangerous myth. Open windows let destructive winds and rain inside, which can cause roofs to collapse from the inside out due to increased internal pressure.',
                'action' => 'Keep all windows and doors tightly closed and sealed throughout the entire storm.',
                'is_active' => true,
            ],
            [
                'myth'   => '"Floodwater only reaches ankle height — it is not dangerous to wade through."',
                'fact'   => 'Fast-moving floodwater just 15 cm (6 inches) deep can knock a person down. Floodwater also carries disease, hidden debris, open manholes, and live electrical currents.',
                'action' => 'Never attempt to cross flooded roads or rivers on foot or by vehicle.',
                'is_active' => true,
            ],
            [
                'myth'   => '"My house is concrete so I am completely safe during any typhoon."',
                'fact'   => 'Concrete homes reduce wind risk but do not protect against storm surge, flooding, or landslides. Poorly built concrete structures can also fail under Super Typhoon-level winds.',
                'action' => 'Know your specific risks (flooding, storm surge, landslide) and evacuate when ordered regardless of house material.',
                'is_active' => true,
            ],
            [
                'myth'   => '"Typhoons weaken before reaching land — the forecasts always exaggerate."',
                'fact'   => 'Typhoons can rapidly intensify even hours before landfall due to warm Philippine seas. Underestimating a typhoon based on past experience is one of the leading causes of preventable deaths.',
                'action' => 'Always take the most severe forecasted scenario seriously and prepare accordingly.',
                'is_active' => true,
            ],
            [
                'myth'   => '"Landslides only happen during the typhoon itself, not after."',
                'fact'   => 'Post-typhoon landslides are extremely common. Soil remains saturated for days after heavy rainfall, making slopes unstable long after the storm has passed.',
                'action' => 'Avoid mountainous and hillside areas for several days after a typhoon until authorities declare it safe.',
                'is_active' => true,
            ],
            [
                'myth'   => '"I can drink tap water right after the typhoon — it looks clear."',
                'fact'   => 'Floodwater contaminates water supply systems with bacteria, chemicals, and sewage. Clear-looking water can still carry cholera, typhoid, leptospirosis, and other pathogens.',
                'action' => 'Do not drink tap water after a typhoon until your local water authority officially declares it safe.',
                'is_active' => true,
            ],
            [
                'myth'   => '"A Go-Bag is only for wealthy families — poor families cannot afford one."',
                'fact'   => 'A functional Go-Bag can be assembled from everyday household items. Recycled bottles for water, canned goods, a whistle, and a flashlight are enough to save lives and cost very little.',
                'action' => 'Start with what you have — even a basic Go-Bag with water, food, and documents dramatically improves survival chances.',
                'is_active' => true,
            ],
        ];

        foreach ($myths as $myth) {
            TyphoonMyth::create($myth);
        }
    }
}
