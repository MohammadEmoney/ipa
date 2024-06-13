<?php

namespace Database\Seeders;

use App\Models\DefaultLanguage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DefualtLangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DefaultLanguage::create(['lang' => 'en']);
    }
}
