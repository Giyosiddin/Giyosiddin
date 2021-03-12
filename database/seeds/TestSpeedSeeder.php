<?php

use Illuminate\Database\Seeder;

class TestSpeedSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $urgency = [
            'לא דחוף',
            'דחוף',
            'דחוף מאוד'
        ];
        foreach($urgency as $value) {
            $speed = new \App\TestSpeed();
            $speed->name = $value;
            $speed->save();
        }
    }
}
