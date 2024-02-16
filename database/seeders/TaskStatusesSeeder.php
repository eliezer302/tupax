<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaskStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $newTaskStatuses = [
            [
                'name'        => 'Pendiente',
                'description' => 'Pendiente',
                'created_at'  => now(),
                'updated_at'  => now()
            ],
            [
                'name'        => 'Ejecución',
                'description' => 'Ejecución',
                'created_at'  => now(),
                'updated_at'  => now()
            ],
            [
                'name'        => 'Revisión',
                'description' => 'Revisión',
                'created_at'  => now(),
                'updated_at'  => now()
            ],
            [
                'name'        => 'Completado',
                'description' => 'Completado',
                'created_at'  => now(),
                'updated_at'  => now()
            ]
        ];

        DB::table('task_statuses')->insert($newTaskStatuses);
    }
}
