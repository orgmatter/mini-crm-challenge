<?php

use Illuminate\Database\Seeder;
use App\Company;
use App\User;

class UpdateCompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('role_id', 1)->first();
        $company = Company::where('user_id', '')->update(['user_id' => $user->id]);
    }
}
