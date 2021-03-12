<?php

use Illuminate\Database\Seeder;

class SystemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'מיזוג אויר',
            'אורור',
            'חשמל',
            'מ נ.מ',
            'בקרת מבנה (B.M.S)',
            'בקרת חניון',
            'תברואה',
            'אינסטלציה',
            'גילוי אש',
            'כריזה',
            'ספרינקלרים',
            'כיבוי אש',
            'אורור',
            'שחרור עשן',
            'C.O בקרת',
            'הגברת לחץ מים',
            'בטיחות אש במערכות אלקטרומכניות',
            'בריכת שחייה',
            'בריכת נוי',
            'מערכות משולבות עם מסחר',
            'לחץ אויר',
            'גזים רפואיים',
            'צנרת תהליך',
            'חדרים נקיים',
            'שוט אשפה',
            'מערכת סולארית משותפת',
            'מאגרי מים',
        ];
        foreach ($data as $value) {
            $system = new \App\System();
            $system->name = $value;
            $system->save();
        }
    }
}
