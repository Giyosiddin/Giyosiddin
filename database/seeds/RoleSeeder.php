<?php

use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = ['admin','worker'];
        foreach($data as $value) {
            $role = new \App\Role();
            $role->name = $value;
            $role->save();
        }
    }
}
