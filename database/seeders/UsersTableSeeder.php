<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Hash;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();

         // Users Table
         $user = new User;
         $user->id = 1;
         $user->name = 'Admin';
         $user->email = 'admin@goodyweb.com';
         $user->password = Hash::make('admin');
         $user->created_at = now();
         $user->updated_at = now();
         $user->save();
 
//$user->assignRole('admin', 'hidden super admin');
 
    }
}
