<?php

namespace Database\Seeders;

use App\Models\Todo;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $todo = new Todo();
        $todo->id = "1";
        $todo->todo = "halo";
        $todo->save();

        $todo = new Todo();
        $todo->id = "2";
        $todo->todo = "halo halo";
        $todo->save();
    }
}
