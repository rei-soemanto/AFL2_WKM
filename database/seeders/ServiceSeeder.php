<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::insert([
            [
                'category_id' => 1,
                'name' => 'PLC Maintenance',
                'description' => 'PLC maintenance involves the inspection, testing, troubleshooting, and repair of Programmable Logic Controllers (PLCs) to ensure they operate correctly and reliably.',
            ],
            [
                'category_id' => 1,
                'name' => 'SCADA Maintenance',
                'description' => 'SCADA maintenance involves the ongoing management, monitoring, and servicing of a Supervisory Control and Data Acquisition (SCADA) system.',
            ],
            [
                'category_id' => 1,
                'name' => 'Security Maintenance',
                'description' => 'Security maintenance is the continuous, proactive process of reviewing, updating, and managing an organizations security measures to protect its assets—including physical property, digital data, and personnel.',
            ],
            [
                'category_id' => 2,
                'name' => 'Technical Engineering',
                'description' => 'Technical engineering is the practical, hands-on application of scientific and mathematical principles to design, develop, implement, and maintain systems, structures, and processes. It bridges the gap between theoretical concepts and real-world results, focusing on making things work efficiently and reliably.',
            ],
            [
                'category_id' => 2,
                'name' => 'SCADA & PLC Integration',
                'description' => 'SCADA & PLC integration is the process of connecting Programmable Logic Controllers (PLCs) with a Supervisory Control and Data Acquisition (SCADA) system to create a cohesive and powerful industrial automation solution.',
            ],
        ]);
    }
}
