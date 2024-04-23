<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $departments = [
            [
                'title' => 'Meal Manager',
                'detail' => 'Meal Manager manages meals',
            ] ,
            [
                'title' => 'Room Allocation Manger',
                'detail' => 'Room Allocation Manager manages Room Allocations'
            ]
        ];
        Department::insert($departments);
    }
}
