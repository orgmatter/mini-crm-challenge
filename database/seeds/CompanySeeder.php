<?php

use Illuminate\Database\Seeder;
use App\Company;
use App\Employee;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Company::class, 19)->create()->each(function ($company) {

            $company->employees()->createMany(factory(Employee::class, 3)->make()->toArray());

        });
    }
}
