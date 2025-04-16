<?php

namespace Database\Seeders;

use App\Models\TicketPackage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketPackageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TicketPackage::create(['type' => 'Basic', 'tickets' => 5, 'price' => 10.00]);
        TicketPackage::create(['type' => 'Standard', 'tickets' => 10, 'price' => 18.00]);
        TicketPackage::create(['type' => 'Premium', 'tickets' => 20, 'price' => 35.00]);
        TicketPackage::create(['type' => 'Elite', 'tickets' => 50, 'price' => 80.00]);
    }
}
