<?php

// namespace Database\seeds;
use Illuminate\Database\Seeder;
// use database\seeds\Privileges;
use App\Privilege;

class PrivilegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $privileges = (new \Privileges())->get_privileges();

        extract($privileges);

        foreach($admin_priv as $admin_role_priv){
            extract($admin_role_priv);
            Privilege::create([
                'role_id' => $role_id,
                'name' => $priv,
            ]);
        }
        foreach($user_priv as $admin_role_priv){
            extract($admin_role_priv);
            Privilege::create([
                'role_id' => $role_id,
                'name' => $priv,
            ]);
        }
    }
}
