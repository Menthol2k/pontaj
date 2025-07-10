<?php

namespace Database\Seeders;

use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'first_name'   => 'Stefan',
                'last_name'    => 'Voicu',
                'phone_number' => '0731795273',
                'adresa'       => 'Salcioara',
                'position'     => 'Necalificat',
                'location'     => 'Deplasare',
                'workbook'     => false,
                'hired_at'     => '2025-06-02',
                'left_at'      => null,
                'status'       => true,
                'obs'          => null,
                'created_at'   => '2025-07-10 11:58:02',
                'updated_at'   => '2025-07-10 11:58:02',
            ],
            [
                'first_name'   => 'Costin',
                'last_name'    => 'Dumitru',
                'phone_number' => '0721774291',
                'adresa'       => 'Branistea',
                'position'     => 'Necalificat',
                'location'     => 'Deplasare',
                'workbook'     => false,
                'hired_at'     => '2025-06-02',
                'left_at'      => null,
                'status'       => true,
                'obs'          => null,
                'created_at'   => '2025-07-10 11:58:59',
                'updated_at'   => '2025-07-10 11:58:59',
            ],
            [
                'first_name'   => 'Iulian',
                'last_name'    => 'Lamba',
                'phone_number' => '0736645400',
                'adresa'       => 'Chiajna, Ilfov',
                'position'     => 'Calificat',
                'location'     => 'Deplasare',
                'workbook'     => false,
                'hired_at'     => '2024-01-01',
                'left_at'      => null,
                'status'       => true,
                'obs'          => null,
                'created_at'   => '2025-07-10 11:59:57',
                'updated_at'   => '2025-07-10 11:59:57',
            ],
            [
                'first_name'   => 'Danut',
                'last_name'    => 'Vamesu',
                'phone_number' => '0769920454',
                'adresa'       => 'Poiana',
                'position'     => 'Calificat',
                'location'     => 'Birou',
                'workbook'     => true,
                'hired_at'     => '2024-12-10',
                'left_at'      => null,
                'status'       => true,
                'obs'          => null,
                'created_at'   => '2025-07-10 12:00:58',
                'updated_at'   => '2025-07-10 12:00:58',
            ],
            [
                'first_name'   => 'Gheorghe',
                'last_name'    => 'Nicolae',
                'phone_number' => '0712345678',
                'adresa'       => 'Romanesti',
                'position'     => 'Necalificat',
                'location'     => 'Birou',
                'workbook'     => false,
                'hired_at'     => '2024-12-10',
                'left_at'      => null,
                'status'       => true,
                'obs'          => null,
                'created_at'   => '2025-07-10 12:12:31',
                'updated_at'   => '2025-07-10 12:12:31',
            ],
            [
                'first_name'   => 'Valeriu',
                'last_name'    => 'Puntaru',
                'phone_number' => '0721437821',
                'adresa'       => 'Poiana',
                'position'     => 'Necalificat',
                'location'     => 'Deplasare',
                'workbook'     => true,
                'hired_at'     => '2025-05-02',
                'left_at'      => null,
                'status'       => true,
                'obs'          => null,
                'created_at'   => '2025-07-10 12:13:49',
                'updated_at'   => '2025-07-10 12:13:49',
            ],
            [
                'first_name'   => 'Nicolae',
                'last_name'    => 'Olteanu',
                'phone_number' => '0721188931',
                'adresa'       => 'Poiana',
                'position'     => 'Necalificat',
                'location'     => 'Deplasare',
                'workbook'     => false,
                'hired_at'     => '2025-02-05',
                'left_at'      => null,
                'status'       => true,
                'obs'          => null,
                'created_at'   => '2025-07-10 12:15:29',
                'updated_at'   => '2025-07-10 13:54:47',
            ],
        ];

        collect($data)->each(function ($factory) {
            Employee::create($factory);
        });
    }
}
