<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Traits\MediaTrait;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryTableSeeder extends Seeder
{
    use MediaTrait;
    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('categories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $dataEn = [
            [
                'title' => 'Fatigue',
                'description' => '',
            ],
            [
                'title' => 'Runway Safety',
                'description' => "Aviation safety is a shared responsibility between pilots, operators and regulators. It is by working together that we are able to identify risks and develop effective mitigation strategies to further improve the safety performance of the aviation system. This library shares IPA's runway safety positions, briefings and guidance,",
            ],
            [
                'title' => 'Helicopter',
                'description' => 'These publications have been produced by the IPA Helicopter Committee and provide pilot community insight into concerns in rotary-wing operations.',
            ],
            [
                'title' => 'Dangerous Goods',
                'description' => "These publications have been produced by the IPA Dangerous Goods Committee and provide the pilot community's insight into issues concerning the transport of dangerous goods by air.",
            ],
            [
                'title' => 'Sustainable Aviation',
                'description' => '',
            ],
            [
                'title' => 'Performance Based Navigation (PBN)',
                'description' => '',
            ],
        ];

        $dataFa = [
            [
                'title' => 'خستگی',
                'description' => '',
            ],
            [
                'title' => 'ایمنی باند',
                'description' => "ایمنی هوانوردی یک مسئولیت مشترک بین خلبانان، اپراتورها و تنظیم کنندگان است. با همکاری یکدیگر است که می‌توانیم ریسک‌ها را شناسایی کرده و استراتژی‌های کاهش موثر برای بهبود عملکرد ایمنی سیستم هوانوردی را توسعه دهیم. این کتابخانه موقعیت های ایمنی باند فرودگاه، توضیحات و راهنمایی های IPA را به اشتراک می گذارد،",
            ],
            [
                'title' => 'بالگرد',
                'description' => 'این نشریات توسط کمیته هلیکوپتر IPA تهیه شده است و بینش جامعه خلبانی را در مورد نگرانی های مربوط به عملیات بال چرخشی ارائه می دهد.',
            ],
            [
                'title' => 'کالاهای خطرناک',
                'description' => "این نشریات توسط کمیته کالاهای خطرناک IPA تهیه شده است و بینش جامعه خلبان را در مورد مسائل مربوط به حمل و نقل کالاهای خطرناک از طریق هوایی فراهم می کند.",
            ],
            [
                'title' => 'هوانوردی پایدار',
                'description' => '',
            ],
            [
                'title' => 'ناوبری مبتنی بر عملکرد (PBN)',
                'description' => '',
            ],
        ];

        foreach($dataEn as $key => $data)
            $this->createCategory($data, 'en', $key+1);
        foreach($dataFa as $key => $data)
            $this->createCategory($data, 'fa', $key+1);
    }

    public function createCategory($data, $lang, $i)
    {
        $category =  Category::create([
            'lang' => $lang,
            'title' => $data['title'],
            'slug' => Str::slug($data['title']),
            'description' => $data['description'] ?? null,
        ]);

        // $i = rand(1, 6);
        $img = public_path("Impact/assets/img/category/$i.jpg");
        if (file_exists($img)) {
            $fakeUploadedFile = UploadedFile::fake()->createWithContent("$i.jpg", file_get_contents($img));
            $image =  $this->createFakeImage($fakeUploadedFile, $category);
        }
    }
}
