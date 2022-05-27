<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            [ 'name' => 'aounhassan1',
            'email' => 'admin1@mail.com',
            'type' => '1',
            'password' => Hash::make('1234'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()],
            
            ['name' => 'Aounhassan2',
            'email' => 'admin2@mail.com',
            'type' => '1',
            'password' => Hash::make('1234'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()],
        ]);
        DB::table('users')->insert([
            [ 'name' => 'aounshah1',
            'email' => 'user1@mail.com',
            'password' => Hash::make('1234'),
            'left' => uniqid(),
            'right' => uniqid(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()],
            
            ['name' => 'aounhassan1',
            'email' => 'user2@mail.com',
            'password' => Hash::make('1234'),
            'left' => uniqid(),
            'right' => uniqid(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()],
        ]);
        DB::table('sources')->insert([
            ['name' => 'PerfectMoney'],
        ]);
        DB::table('company_accounts')->insert([
            ['name' => 'Expense Income'],
            ['name' => 'Flash Income'],
            ['name' => 'Reward Income'],
            ['name' => 'Loss Income'],
            ['name' => 'Salary'],
        ]);
        DB::table('payments')->insert([
            [
                'name' => 'Name 1',
                'number' => '03030672683',
                'method' => 'PerfectMoney',
                'bnumber' => '132123123123',
            ],
            
        ]);
        DB::table('packages')->insert([
            [ 'price' => '1000',
            'name' => 'Package 1',
            'direct_income' => '40',
            'matching_income' => '40',
            'withdraw_limit' => '1000',
            'income_limit' => '1000',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()],
            
        ]);
    }
}
