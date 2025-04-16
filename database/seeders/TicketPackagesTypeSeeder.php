<?php

namespace Database\Seeders;

use App\Models\PackageType;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TicketPackagesTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            'Basic Package',
            'Premium Packag',
            'Elite Package',
        ];

        foreach ($types as $type) {
            PackageType::create([
                'name' => $type,
            ]);
        }
    }
}
