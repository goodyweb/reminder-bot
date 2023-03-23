<?php

namespace Database\Seeders;

use App\Models\Ununfixeddate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnunfixeddateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unfixeddate = new Unfixeddate;
        $unfixeddate->id = 1;
        $unfixeddate->details = 'Tax monthly';
        $unfixeddate->webhook = 'https://discord.com/api/webhooks/1080061315986505738/xNUWOmuxn4tHCUQLs_P5Yxvc4jnbop_4tCwlc2XxtJvRsA-QHTv9sBl2DVFhlIfTMfof';
        $unfixeddate->startMonth = 3;
        $unfixeddate->endMonth = 3;
        $unfixeddate->startDay = 23;
        $unfixeddate->endDay = 23;
        $unfixeddate->year = 2023;
        $unfixeddate->frequency = 'Monthly';
        $unfixeddate->save();


        $unfixeddate = new Unfixeddate;
        $unfixeddate->id = 2;
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
