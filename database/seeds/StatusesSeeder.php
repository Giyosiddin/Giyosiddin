<?php

use Illuminate\Database\Seeder;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'לא סגור',
            'לביצוע',
            'בתהליך',
            'מושהה',
            'סגור',
            'נבדק ע"י מהנדס',
            'ממתין להשלמת פרטים'
        ];
        foreach($data as $value) {
            $status = new \App\Status();
            $status->name = $value;
            $status->save();
        }
    }
}
