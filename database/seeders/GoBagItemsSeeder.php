<?php

namespace Database\Seeders;

use App\Models\GoBagItem;
use Illuminate\Database\Seeder;

class GoBagItemsSeeder extends Seeder
{
    public function run(): void
    {
        $items = [
            // Essentials
            ['category' => 'essentials', 'name' => 'Drinking Water', 'description' => '1 liter per person, per day for 3 days minimum.', 'budget_alternative' => 'Reuse cleaned plastic bottles to store boiled water.'],
            ['category' => 'essentials', 'name' => 'Non-Perishable Food', 'description' => 'Easy-to-open canned goods, biscuits, or MREs that can last 3 days.', 'budget_alternative' => 'Stock instant noodles, sardines, or biscuits.'],
            ['category' => 'essentials', 'name' => 'First Aid Kit & Meds', 'description' => 'Bandages, alcohol, and prescription medicines for 3+ days.', 'budget_alternative' => 'Buy individual items in small quantities from local pharmacies.'],
            ['category' => 'essentials', 'name' => 'Important Documents', 'description' => 'Photocopies of IDs, birth certificates, land titles, and insurance.', 'budget_alternative' => 'Use sealed Ziploc bags as a waterproof container.'],
            ['category' => 'essentials', 'name' => 'Flashlight and Batteries', 'description' => 'A working flashlight plus spare batteries for at least 3 days.', 'budget_alternative' => 'Use a phone flashlight with a fully-charged power bank.'],
            ['category' => 'essentials', 'name' => 'Whistle', 'description' => 'For signaling rescuers if you are trapped or need help.', 'budget_alternative' => 'Any loud whistle will do.'],

            // Recommended
            ['category' => 'recommended', 'name' => 'Power Bank', 'description' => 'For charging your phone when electricity is out.', 'budget_alternative' => 'Charge an old phone to use as a backup with stored numbers.'],
            ['category' => 'recommended', 'name' => 'Change of Clothes', 'description' => 'At least one full change including rain gear and closed shoes.', 'budget_alternative' => 'Pack lightweight, quick-drying clothing.'],
            ['category' => 'recommended', 'name' => 'Extra Cash', 'description' => 'Small denominations in case ATMs and banks are unavailable.', 'budget_alternative' => 'Set aside ₱500–₱1000 specifically for emergencies.'],
            ['category' => 'recommended', 'name' => 'Battery-Powered Radio', 'description' => 'For receiving PAGASA and NDRRMC updates when networks are down.', 'budget_alternative' => 'Hand-crank radios are cheap and need no batteries.'],

            // Optional
            ['category' => 'optional', 'name' => 'DIY Waterproof Pouch', 'description' => 'Improvised waterproof storage for documents and electronics.', 'budget_alternative' => 'Use clean Ziploc bags or sealed plastic containers.'],
            ['category' => 'optional', 'name' => 'Recycled Water Containers', 'description' => 'Clean, food-grade containers for storing additional water.', 'budget_alternative' => 'Reuse 1.5-liter PET bottles after thorough cleaning.'],
            ['category' => 'optional', 'name' => 'Extra Comfort Items', 'description' => 'Toys for children, books, or small comfort items to reduce stress.', 'budget_alternative' => 'Pack lightweight, familiar items.'],
        ];

        foreach ($items as $item) {
            GoBagItem::create($item);
        }
    }
}