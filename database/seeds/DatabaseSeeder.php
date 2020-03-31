<?php
// namespace Database\seeds;
use Illuminate\Database\Seeder;
// use database\RoleSeeder;
// use database\PrivilegeSeeder;
// use database\CompanySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RoleSeeder::class,
            PrivilegeSeeder::class,
            CompanySeeder::class
        ]);
    }
}
