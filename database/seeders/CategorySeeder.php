<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['id' => 1, 'name' => 'Homecare', 'slug' => Str::slug('Homecare'), 'parent_id' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 2, 'name' => 'ICU/Critical Care', 'slug' => Str::slug('ICU/Critical Care'), 'parent_id' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 3, 'name' => 'OT Equipment', 'slug' => Str::slug('OT Equipment'), 'parent_id' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 4, 'name' => 'Diagnostics & Imaging', 'slug' => Str::slug('Diagnostics & Imaging'), 'parent_id' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 5, 'name' => 'Supplies & Accessories', 'slug' => Str::slug('Supplies & Accessories'), 'parent_id' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 6, 'name' => 'Hospital Furniture', 'slug' => Str::slug('Hospital Furniture'), 'parent_id' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 7, 'name' => 'Lab Equipment', 'slug' => Str::slug('Lab Equipment'), 'parent_id' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 8, 'name' => 'Dental', 'slug' => Str::slug('Dental'), 'parent_id' => null, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 9, 'name' => 'Respiratory Care', 'slug' => Str::slug('Respiratory Care'), 'parent_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 10, 'name' => 'Health & Personal Care Care', 'slug' => Str::slug('Health & Personal Care Care'), 'parent_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 11, 'name' => 'Mobile Aid', 'slug' => Str::slug('Mobile Aid'), 'parent_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 12, 'name' => 'Support- Brace & Splints', 'slug' => Str::slug('Support- Brace & Splints'), 'parent_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 13, 'name' => 'Physiotherapy & Rehabilitation', 'slug' => Str::slug('Physiotherapy & Rehabilitation'), 'parent_id' => 1, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 14, 'name' => 'BiPAP & CPAP Machines', 'slug' => Str::slug('BiPAP & CPAP Machines'), 'parent_id' => 9, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 15, 'name' => 'Nebulizer Machines', 'slug' => Str::slug('Nebulizer Machines'), 'parent_id' => 9, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 16, 'name' => 'Oxygen Concentrators', 'slug' => Str::slug('Oxygen Concentrators'), 'parent_id' => 9, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 17, 'name' => 'Respiratory Masks', 'slug' => Str::slug('Respiratory Masks'), 'parent_id' => 9, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 18, 'name' => 'Spirometers', 'slug' => Str::slug('Spirometers'), 'parent_id' => 9, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 19, 'name' => 'Peak Flow Meters', 'slug' => Str::slug('Peak Flow Meters'), 'parent_id' => 9, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 20, 'name' => 'Air Purifiers', 'slug' => Str::slug('Air Purifiers'), 'parent_id' => 9, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 21, 'name' => 'Cough Assist Machines', 'slug' => Str::slug('Cough Assist Machines'), 'parent_id' => 9, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 22, 'name' => 'Ventilator Machines', 'slug' => Str::slug('Ventilator Machines'), 'parent_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 23, 'name' => 'Defibrillator, AED, Pacemakers', 'slug' => Str::slug('Defibrillator, AED, Pacemakers'), 'parent_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 24, 'name' => 'Infusion Pump', 'slug' => Str::slug('Infusion Pump'), 'parent_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 25, 'name' => 'Patient Monitoring System', 'slug' => Str::slug('Patient Monitoring System'), 'parent_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 26, 'name' => 'Dialysis Equipment', 'slug' => Str::slug('Dialysis Equipment'), 'parent_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 27, 'name' => 'Portable Ventilator', 'slug' => Str::slug('Portable Ventilator'), 'parent_id' => 22, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 28, 'name' => 'ICU Ventilator', 'slug' => Str::slug('ICU Ventilator'), 'parent_id' => 22, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 29, 'name' => 'Automated External Defibrillator (AED)', 'slug' => Str::slug('Automated External Defibrillator (AED)'), 'parent_id' => 23, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 30, 'name' => 'Implantable Pacemaker', 'slug' => Str::slug('Implantable Pacemaker'), 'parent_id' => 23, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 31, 'name' => 'Syringe Pump', 'slug' => Str::slug('Syringe Pump'), 'parent_id' => 24, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 32, 'name' => 'Volumetric Pump', 'slug' => Str::slug('Volumetric Pump'), 'parent_id' => 24, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 33, 'name' => 'Multi-Parameter Monitor', 'slug' => Str::slug('Multi-Parameter Monitor'), 'parent_id' => 25, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 34, 'name' => 'ECG Monitor', 'slug' => Str::slug('ECG Monitor'), 'parent_id' => 25, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 35, 'name' => 'Hemodialysis Machine', 'slug' => Str::slug('Hemodialysis Machine'), 'parent_id' => 26, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 36, 'name' => 'Peritoneal Dialysis Machine', 'slug' => Str::slug('Peritoneal Dialysis Machine'), 'parent_id' => 26, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 37, 'name' => 'Fitness Equipment', 'slug' => Str::slug('Fitness Equipment'), 'parent_id' => 2, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 38, 'name' => 'Step Counters/Pedometers', 'slug' => Str::slug('Step Counters/Pedometers'), 'parent_id' => 37, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 39, 'name' => 'Massagers', 'slug' => Str::slug('Massagers'), 'parent_id' => 37, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 40, 'name' => 'Body Care Products', 'slug' => Str::slug('Body Care Products'), 'parent_id' => 37, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 41, 'name' => 'Hearing Aid', 'slug' => Str::slug('Hearing Aid'), 'parent_id' => 37, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 42, 'name' => 'Walking Sticks', 'slug' => Str::slug('Walking Sticks'), 'parent_id' => 11, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 43, 'name' => 'Wheelchairs', 'slug' => Str::slug('Wheelchairs'), 'parent_id' => 11, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 44, 'name' => 'Commode Chairs', 'slug' => Str::slug('Commode Chairs'), 'parent_id' => 11, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 45, 'name' => 'Crutches', 'slug' => Str::slug('Crutches'), 'parent_id' => 11, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 46, 'name' => 'Ankle & Foot Supports', 'slug' => Str::slug('Ankle & Foot Supports'), 'parent_id' => 12, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 47, 'name' => 'Arm Supports', 'slug' => Str::slug('Arm Supports'), 'parent_id' => 12, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 48, 'name' => 'Back Supports', 'slug' => Str::slug('Back Supports'), 'parent_id' => 12, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 49, 'name' => 'Body Belts', 'slug' => Str::slug('Body Belts'), 'parent_id' => 12, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 50, 'name' => 'Hip Supports', 'slug' => Str::slug('Hip Supports'), 'parent_id' => 12, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 51, 'name' => 'Shoulder Supports', 'slug' => Str::slug('Shoulder Supports'), 'parent_id' => 12, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 52, 'name' => 'Waist & Abdomen Supports', 'slug' => Str::slug('Waist & Abdomen Supports'), 'parent_id' => 12, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 53, 'name' => 'Splints', 'slug' => Str::slug('Splints'), 'parent_id' => 12, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 54, 'name' => 'Physiotherapy Equipment', 'slug' => Str::slug('Physiotherapy Equipment'), 'parent_id' => 13, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 55, 'name' => 'Rehabilitation Equipment', 'slug' => Str::slug('Rehabilitation Equipment'), 'parent_id' => 13, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 56, 'name' => 'Acupressure Devices', 'slug' => Str::slug('Acupressure Devices'), 'parent_id' => 13, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 57, 'name' => 'Rehab Cushions', 'slug' => Str::slug('Rehab Cushions'), 'parent_id' => 13, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 58, 'name' => 'Heat Therapy Equipment', 'slug' => Str::slug('Heat Therapy Equipment'), 'parent_id' => 13, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
            ['id' => 59, 'name' => 'Cold Therapy Equipment', 'slug' => Str::slug('Cold Therapy Equipment'), 'parent_id' => 13, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()],
        ]);
    }
}
