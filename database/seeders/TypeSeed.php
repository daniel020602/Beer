<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\models\Type;
use Illuminate\Database\Seeder;

class TypeSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Type::query()->firstOrCreate([
            'title'=>'magyar csoda',
            
        ]);
        Type::query()->firstOrCreate([
            'title'=>'szupermarket szutyok',
            
        ]);
        Type::query()->firstOrCreate([
            'title'=>'magyar kisüzemi',
            
        ]);
        Type::query()->firstOrCreate([
            'title'=>'külföldi',
            
        ]);
    }
}
