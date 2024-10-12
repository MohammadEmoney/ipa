<?php

namespace Database\Seeders;

use App\Models\Airline;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AirlineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('airlines')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $data = [
            'ایران ایر',
            'هواپیمایی ایران ایرتور',
            'هواپیمایی آسمان',
            'هواپیمایی ساها',
            'هواپیمایی کیش',
            'هواپیمایی ماهان',
            'هواپیمایی کاسپین',
            'هواپیمایی قشم',
            'هواپیمایی چابهار',
            'هواپیمایی زاگرس',
            'هواپیمایی تابان',
            'هواپیمایی آتا',
            'هواپیمایی معراج',
            'هواپیمایی سپهران',
            'هواپیمایی پویا',
            'هواپیمایی پارس',
            'هواپیمایی کارون',
            'هواپیمایی وارش',
            'هواپیمایی فلای پرشیا',
            'هواپیمایی آساجت',
            'هواپیمایی ایر وان',
            'هواپیمایی طوس',
            'هواپیمایی یزد',
            'هواپیمایی آوا',
            'هوافراجا',
            'کرندون ایرلاینز',
            'فرودگاهها و ناوبری هوایی ایران',
            'هوانوردی آسو',
            'هواپیمایی نسیم',
        ];

        $dataEn = [
            'IRANAIR',
            'AIRTOUR',
            'ASEMAN',
            'SAHA',
            'KISH AIR',
            'MAHAN AIR',
            'CASPIAN',
            'QESHM AIR',
            'CHABAHARCHABAHAR',
            'ZAGROS',
            'TABAN',
            'ATALAR AIR',
            'MERAJ AIRLINE',
            'SHIRAZI',
            'POUYA AIR',
            'PARS SKY',
            'KARUN',
            'SKY VICTOR',
            'PERSIA',
            'ASAJET AIRLINES',
            'AVICENNA',
            'TOOS',
            'YAZD AIRWAYS',
            'AVA',
            'HAVAFARAJA',
            'CORENDON',
            'IRAN AIRPORTS COMPANY',
            'ASOO',
            'NASIM',
        ];

        $combine = array_combine($data, $dataEn);

        DB::beginTransaction();
        foreach($combine as $key => $value)
            Airline::create(['title' => $key, 'title_en' => $value]);
        DB::commit();
    }
}
