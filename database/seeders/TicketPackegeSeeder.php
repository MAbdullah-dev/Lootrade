<?php

namespace Database\Seeders;

use App\Models\TicketPackege;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketPackegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TicketPackege::create(['type' => 'Basic', 'tickets' => 5, 'price' => 10.00]);
        TicketPackege::create(['type' => 'Standard', 'tickets' => 10, 'price' => 18.00]);
        TicketPackege::create(['type' => 'Premium', 'tickets' => 20, 'price' => 35.00]);
        TicketPackege::create(['type' => 'Elite', 'tickets' => 50, 'price' => 80.00]);
    }
}
