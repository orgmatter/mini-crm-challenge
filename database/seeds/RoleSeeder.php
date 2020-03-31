<?php

// namespace Database\seeds;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
// use database\seeds\Roles;
use App\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = (new \Roles())->get_roles();
        
        foreach($roles as $role) {
            Role::create([
                'name' => $role
            ]);
        }
    }
}
