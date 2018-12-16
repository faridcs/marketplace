<?php

class UsersTableSeeder extends DatabaseSeeder
{

    public function run()
    {
        $user = \App\Models\User::create([
            'first_name' => 'customer',
            'last_name' => 'customer',
            'username' => '09362586363',
            'email' => 'customer@alopyk.com',
            'password' => Hash::make('admin'),
        ]);

        $customer = \App\Models\Role::create([
            'name' => 'customer',
            'display_name' => 'customer',
            'description' => 'customer'
        ]);

        \App\Models\Role::create([
            'name' => 'seller',
            'display_name' => 'seller',
            'description' => 'seller'
        ]);

        DB::table('role_user')->insert(
            ['user_id' => $user->id, 'role_id' => $customer->id]
        );
    }
}