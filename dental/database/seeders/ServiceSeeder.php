<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
        Service::insert([
            ['name' => 'Teeth Cleaning', 'price' => 500],
            ['name' => 'Cavity Filling', 'price' => 700],
            ['name' => 'Tooth Extraction', 'price' => 1000],
            ['name' => 'Dental Checkup', 'price' => 400],
            ['name' => 'Braces Consultation', 'price' => 1500],
        ]);
    }
    }

