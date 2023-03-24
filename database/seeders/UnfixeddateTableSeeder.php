<?php

namespace Database\Seeders;

use App\Models\Unfixeddate;
use App\Models\User;
use App\Models\Ununfixeddate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnfixeddateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::find(1);

        $unfixeddate = new Unfixeddate;
        $unfixeddate->id = 1;
        $unfixeddate->user_id = $user->id;
        $unfixeddate->details = 'Tax monthly';
        $unfixeddate->webhook = 'https://discord.com/api/webhooks/1080061315986505738/xNUWOmuxn4tHCUQLs_P5Yxvc4jnbop_4tCwlc2XxtJvRsA-QHTv9sBl2DVFhlIfTMfof';
        $unfixeddate->month = 3;
        $unfixeddate->week = 3;
        $unfixeddate->day = 4;
        $unfixeddate->year = 2023;
        $unfixeddate->frequency = 'Monthly';
        $unfixeddate->save();


        $unfixeddate = new Unfixeddate;
        $unfixeddate->id = 2;
        $unfixeddate->user_id = $user->id;
        $unfixeddate->details = 'Tax quarterly';
        $unfixeddate->webhook = 'https://discord.com/api/webhooks/1080061315986505738/xNUWOmuxn4tHCUQLs_P5Yxvc4jnbop_4tCwlc2XxtJvRsA-QHTv9sBl2DVFhlIfTMfof';
        $unfixeddate->month = 3;
        $unfixeddate->week = 3;
        $unfixeddate->day = 4;
        $unfixeddate->year = 2023;
        $unfixeddate->frequency = 'Quarterly';
        $unfixeddate->save();

        $unfixeddate = new Unfixeddate;
        $unfixeddate->id = 3;
        $unfixeddate->user_id = $user->id;
        $unfixeddate->details = 'Tax annually';
        $unfixeddate->webhook = 'https://discord.com/api/webhooks/1080061315986505738/xNUWOmuxn4tHCUQLs_P5Yxvc4jnbop_4tCwlc2XxtJvRsA-QHTv9sBl2DVFhlIfTMfof';
        $unfixeddate->month = 3;
        $unfixeddate->week = 3;
        $unfixeddate->day = 4;
        $unfixeddate->year = 2023;
        $unfixeddate->frequency = 'Annually';
        $unfixeddate->save();


        $unfixeddate = new Unfixeddate;
        $unfixeddate->id = 4;
        $unfixeddate->user_id = $user->id;
        $unfixeddate->details = 'Tax semiannually';
        $unfixeddate->webhook = 'https://discord.com/api/webhooks/1080061315986505738/xNUWOmuxn4tHCUQLs_P5Yxvc4jnbop_4tCwlc2XxtJvRsA-QHTv9sBl2DVFhlIfTMfof';
        $unfixeddate->month = 3;
        $unfixeddate->week = 3;
        $unfixeddate->day = 4;
        $unfixeddate->year = 2023;
        $unfixeddate->frequency = 'SemiAnnually';
        $unfixeddate->save();
    }
}
