<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'admin',
                'email' => 'admin',
                'password' => bcrypt('abc123'),
                'role_id' => \App\Role::ADMIN,
            ],
            [
                'name' => 'worker',
                'email' => 'worker',
                'password' => bcrypt('abc123'),
                'role_id' => \App\Role::WORKER,
            ]
        ];
        foreach($data as $value) {
            $user = new \App\User();
            $user->name = $value['name'];
            $user->email = $value['email'];
            $user->password = $value['password'];
            $user->role_id = $value['role_id'];
            $user->save();
        }
    }
}
