<?php

namespace Database\Seeders;
use App\Models\Fixeddate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FixeddateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fixeddate = new Fixeddate;
        $fixeddate->id = 1;
        $fixeddate->details = 'Tax monthly';
        $fixeddate->webhook = 'https://discord.com/api/webhooks/1080061315986505738/xNUWOmuxn4tHCUQLs_P5Yxvc4jnbop_4tCwlc2XxtJvRsA-QHTv9sBl2DVFhlIfTMfof';
        $fixeddate->startMonth = 3;
        $fixeddate->endMonth = 3;
        $fixeddate->startDay = 23;
        $fixeddate->endDay = 23;
        $fixeddate->year = 2023;
        $fixeddate->frequency = 'Monthly';
        $fixeddate->save();


        $fixeddate = new Fixeddate;
        $fixeddate->id = 2;
        $fixeddate->details = 'Tax quarterly';
        $fixeddate->webhook = 'https://discord.com/api/webhooks/1080061315986505738/xNUWOmuxn4tHCUQLs_P5Yxvc4jnbop_4tCwlc2XxtJvRsA-QHTv9sBl2DVFhlIfTMfof';
        $fixeddate->startMonth = 3;
        $fixeddate->endMonth = 3;
        $fixeddate->startDay = 23;
        $fixeddate->endDay = 23;
        $fixeddate->year = 2023;
        $fixeddate->frequency = 'Quarterly';
        $fixeddate->save();

        $fixeddate = new Fixeddate;
        $fixeddate->id = 3;
        $fixeddate->details = 'Tax annually';
        $fixeddate->webhook = 'https://discord.com/api/webhooks/1080061315986505738/xNUWOmuxn4tHCUQLs_P5Yxvc4jnbop_4tCwlc2XxtJvRsA-QHTv9sBl2DVFhlIfTMfof';
        $fixeddate->startMonth = 3;
        $fixeddate->endMonth = 3;
        $fixeddate->startDay = 23;
        $fixeddate->endDay = 23;
        $fixeddate->year = 2023;
        $fixeddate->frequency = 'Annually';
        $fixeddate->save();


        $fixeddate = new Fixeddate;
        $fixeddate->id = 4;
        $fixeddate->details = 'Tax semiannually';
        $fixeddate->webhook = 'https://discord.com/api/webhooks/1080061315986505738/xNUWOmuxn4tHCUQLs_P5Yxvc4jnbop_4tCwlc2XxtJvRsA-QHTv9sBl2DVFhlIfTMfof';
        $fixeddate->startMonth = 3;
        $fixeddate->endMonth = 3;
        $fixeddate->startDay = 23;
        $fixeddate->endDay = 23;
        $fixeddate->year = 2023;
        $fixeddate->frequency = 'SemiAnnually';
        $fixeddate->save();
    }
}
