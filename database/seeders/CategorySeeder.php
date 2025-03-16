<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'Homecare', 'parent_id' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 2, 'name' => 'ICU/Critical Care', 'parent_id' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 3, 'name' => 'OT Equipment', 'parent_id' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 4, 'name' => 'Diagnostics & Imaging', 'parent_id' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 5, 'name' => 'Supplies & Accessories', 'parent_id' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 6, 'name' => 'Hospital Furniture', 'parent_id' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 7, 'name' => 'Lab Equipment', 'parent_id' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 8, 'name' => 'Dental', 'parent_id' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 9, 'name' => 'Respiratory Care', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ,'parent_id'=>1],
            ['id' => 10, 'name' => 'Health & Personal Care Care', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ,'parent_id'=>1],
            ['id' => 11, 'name' => 'Mobile Aid', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ,'parent_id'=>1],
            ['id' => 12, 'name' => 'Support- Brace & Splints', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ,'parent_id'=>1],
            ['id' => 13, 'name' => 'Physiotherapy & Rehabilitation', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ,'parent_id'=>1],
            ['id' => 14, 'name' => 'BiPAP & CPAP Machines', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ,'parent_id'=>9],
            ['id' => 15, 'name' => 'Nebulizer Machines', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ,'parent_id'=>9],
            ['id' => 16, 'name' => 'Oxygen Concentrators', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ,'parent_id'=>9],
            ['id' => 17, 'name' => 'Respiratory Masks', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ,'parent_id'=>9],
            ['id' => 18, 'name' => 'Spirometers', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ,'parent_id'=>9],
            ['id' => 19, 'name' => 'Peak Flow Meters', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ,'parent_id'=>9],
            ['id' => 20, 'name' => 'Air Purifiers', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ,'parent_id'=>9],
            ['id' => 21, 'name' => 'Cough Assist Machines', 'created_at' => Carbon::now(), 'updated_at' => Carbon::now() ,'parent_id'=>9],
            ['id' => 22, 'name' => 'Ventilator Machines', 'parent_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 23, 'name' => 'Defibrillator, AED, Pacemakers', 'parent_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 24, 'name' => 'Infusion Pump', 'parent_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 25, 'name' => 'Patient Monitoring System', 'parent_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 26, 'name' => 'Dialysis Equipment', 'parent_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 27, 'name' => 'Portable Ventilator', 'parent_id' => 22, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 28, 'name' => 'ICU Ventilator', 'parent_id' => 22, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 29, 'name' => 'Automated External Defibrillator (AED)', 'parent_id' => 23, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 30, 'name' => 'Implantable Pacemaker', 'parent_id' => 23, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 31, 'name' => 'Syringe Pump', 'parent_id' => 24, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 32, 'name' => 'Volumetric Pump', 'parent_id' => 24, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 33, 'name' => 'Multi-Parameter Monitor', 'parent_id' => 25, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 34, 'name' => 'ECG Monitor', 'parent_id' => 25, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 35, 'name' => 'Hemodialysis Machine', 'parent_id' => 26, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 36, 'name' => 'Peritoneal Dialysis Machine', 'parent_id' => 26, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 37, 'name' => 'Fitness Equipment', 'parent_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 38, 'name' => 'Step Counters/Pedometers', 'parent_id' => 37, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 39, 'name' => 'Massagers', 'parent_id' => 37, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 40, 'name' => 'Body Care Products', 'parent_id' => 37, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 41, 'name' => 'Hearing Aid', 'parent_id' => 37, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],





            ['id' => 42, 'name' => 'Walking Sticks', 'parent_id' => 11, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 43, 'name' => 'Wheelchairs', 'parent_id' => 11, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 44, 'name' => 'Commode Chairs', 'parent_id' => 11, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 45, 'name' => 'Crutches', 'parent_id' => 11, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],



            ['id' => 46, 'name' => 'Ankle & Foot Supports', 'parent_id' => 12, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 47, 'name' => 'Arm Supports', 'parent_id' => 12, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 48, 'name' => 'Back Supports', 'parent_id' => 12, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 49, 'name' => 'Body Belts', 'parent_id' => 12, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 50, 'name' => 'Hip Supports', 'parent_id' => 12, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 51, 'name' => 'Shoulder Supports', 'parent_id' => 12, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 52, 'name' => 'Waist & Abdomen Supports', 'parent_id' => 12, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 53, 'name' => 'Splints', 'parent_id' => 12, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],



            ['id' => 54, 'name' => 'Physiotherapy Equipment', 'parent_id' => 13, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 55, 'name' => 'Rehabilitation Equipment', 'parent_id' => 13, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 56, 'name' => 'Acupressure Devices', 'parent_id' => 13, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 57, 'name' => 'Rehab Cushions', 'parent_id' => 13, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 58, 'name' => 'Heat Therapy Equipment', 'parent_id' => 13, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 59, 'name' => 'Cold Therapy Equipment', 'parent_id' => 13, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],





        ]);
    }
}
