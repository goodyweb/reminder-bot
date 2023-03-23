<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotifyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $notify = new Notify;
         $notify->id = 1;
         $notify->name = 'Monthly';
         $notify->created_at = now();
         $notify->updated_at = now();
         $notify->save();


         $notify = new Notify;
         $notify->id = 2;
         $notify->name = 'Quarterly';
         $notify->created_at = now();
         $notify->updated_at = now();
         $notify->save();

         $notify = new Notify;
         $notify->id = 3;
         $notify->name = 'SemiAnnually';
         $notify->created_at = now();
         $notify->updated_at = now();
         $notify->save();

         $notify = new Notify;
         $notify->id = 4;
         $notify->name = 'Annually';
         $notify->created_at = now();
         $notify->updated_at = now();
         $notify->save();
    }
}
