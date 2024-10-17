<?php

namespace Database\Seeders;

use App\Models\Todo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class Todos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Todo::create(['user_id' => 1, 'title' => 'end some project', 'status' => 0]);
        Todo::create(['user_id' => 1, 'title' => 'eat somthing', 'status' => 0]);
        Todo::create(['user_id' => 1, 'title' => 'dp somthing interesting', 'status' => 0]);
    }
}
