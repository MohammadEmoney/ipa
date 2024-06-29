<?php

namespace Database\Seeders;

use App\Enums\EnumLayoutReleaseType;
use App\Models\Layout;
use App\Models\LayoutGroup;
use App\Traits\MediaTrait;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\UploadedFile;

class LayoutTableSeeder extends Seeder
{
    use MediaTrait;
    
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('layouts')->truncate();
        DB::table('layout_groups')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $mainMenu = $this->mainMenu();
        $mainMenuEn = $this->mainMenuEn();
        $mainSlider = $this->mainSlider();
        $mainSliderEn = $this->mainSliderEn();
        $homeAbout = $this->homeAbout();
        $homeAboutEn = $this->homeAboutEn();
        $mainCTA = $this->mainCTA();
        $mainCTAEn = $this->mainCTAEn();
        $services = $this->services();
        $servicesEn = $this->servicesEn();
        $mainNews = $this->mainNews();
        $mainNewsEn = $this->mainNewsEn();
        $socialMedia = $this->socialMedia();
        $socialMediaEn = $this->socialMediaEn();
        // $mainContent = $this->mainContent();
        // $footer = $this->mainFooter();

        $groups = [
            [
                "title" => "منو اصلی",
                "active" => 1,
                "count_list" => null,
                "layouts" => $mainMenu,
                "tag" => "main-menu",
                'lang' => 'fa', 
            ],
            [
                "title" => "Main Menu",
                "active" => 1,
                "count_list" => null,
                "layouts" => $mainMenuEn,
                "tag" => "main-menu",
                'lang' => 'en', 
            ],
            [
                "title" => "اسلایدر اصلی",
                "active" => 1,
                "count_list" => 3,
                "layouts" => $mainSlider,
                "tag" => 'main-slider',
                'lang' => 'fa',
            ],
            [
                "title" => "Main Slider",
                "active" => 1,
                "count_list" => 3,
                "layouts" => $mainSliderEn,
                "tag" => 'main-slider',
                'lang' => 'en',
            ],
            [
                "title" => "درباره ما",
                "active" => 1,
                "count_list" => 0,
                "layouts" => $homeAbout,
                "tag" => 'main-about',
                'lang' => 'fa',
                'description' => '<p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است.</p>',
            ],
            [
                "title" => "About Us",
                "active" => 1,
                "count_list" => 0,
                "layouts" => $homeAboutEn,
                "tag" => 'main-about',
                'lang' => 'en',
                'description' => '<p>Aperiam dolorum et et wuia molestias qui eveniet numquam nihil porro incidunt dolores placeat sunt id nobis omnis tiledo stran delop</p>',
            ],
            [
                "title" => "اقدام به عمل",
                "active" => 1,
                "count_list" => 3,
                "layouts" => $mainCTA,
                "tag" => 'main-cta',
                'lang' => 'fa',
            ],
            [
                "title" => "Call To Action",
                "active" => 1,
                "count_list" => 3,
                "layouts" => $mainCTAEn,
                "tag" => 'main-cta',
                'lang' => 'en',
            ],
            [
                "title" => "خدمات ما",
                "active" => 1,
                "count_list" => 6,
                "layouts" => $services,
                "tag" => 'services',
                'lang' => 'fa',
                'description' => '<p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است.</p>',
            ],
            [
                "title" => "Our Services",
                "active" => 1,
                "count_list" => 6,
                "layouts" => $servicesEn,
                "tag" => 'services',
                'lang' => 'en',
                'description' => '<p>Aperiam dolorum et et wuia molestias qui eveniet numquam nihil porro incidunt dolores placeat sunt id nobis omnis tiledo stran delop</p>',
            ],
            [
                "title" => "اخبار صفحه اصلی",
                "active" => 1,
                "count_list" => 3,
                "layouts" => $mainNews,
                "tag" => 'main-news',
                'lang' => 'fa',
            ],
            [
                "title" => "Main Page news",
                "active" => 1,
                "count_list" => 3,
                "layouts" => $mainNewsEn,
                "tag" => 'main-news',
                'lang' => 'en',
            ],
            [
                "title" => "شبکه های اجتماعی",
                "active" => 1,
                "count_list" => 5,
                "layouts" => $socialMedia,
                "tag" => 'social-media',
                'lang' => 'fa',
            ],
            [
                "title" => "Social Media",
                "active" => 1,
                "count_list" => 5,
                "layouts" => $socialMediaEn,
                "tag" => 'social-media',
                'lang' => 'en',
            ],
        ];

        foreach ($groups as $group) {
            $lg = LayoutGroup::create([
                "title" => $group["title"],
                "is_active" => 1,
                "tag" => $group["tag"] ?? "",
                "lang" => $group["lang"] ?? "",
                "count_list" => $group["count_list"],
                'description' => $group['description'] ?? "",
            ]);
            $this->createLayoutWithSubLayouts($group['layouts'], $lg);
        }
    }

    /**
     * @return array[]
     */
    public function mainMenu()
    {
        return [
            [
                'title' => "خانه",
                'type' => 'menu',
                'data' => ["select_item" => "static", "select_id" => '/fa'],
                'tag' => 'main-menu',
                'lang' => 'fa',
                'layouts' => [],
            ],
            [
                'title' => "اخبار",
                'type' => 'menu',
                'data' => ["select_item" => "static", "select_id" => '/fa/news'],
                'tag' => 'main-menu',
                'lang' => 'fa',
                'layouts' => [],
            ],
            [
                'title' => "درباره ما",
                'type' => 'menu',
                'data' => ["select_item" => "static", "select_id" => '/fa/pages/about-us-fa'],
                'tag' => 'main-menu',
                'lang' => 'fa',
                'layouts' => [],
            ],
            [
                'title' => "آموزش",
                'type' => 'menu',
                'data' => ["select_item" => "static", "select_id" => '/fa/pages/education-fa'],
                'tag' => 'main-menu',
                'lang' => 'fa',
                'layouts' => [],
            ],
            [
                'title' => "ایمنی",
                'type' => 'menu',
                'data' => ["select_item" => "static", "select_id" => '/fa/pages/safety-fa'],
                'tag' => 'main-menu',
                'lang' => 'fa',
                'layouts' => [],
            ],
        ];
    }
    /**
     * @return array[]
     */
    public function mainMenuEn()
    {
        return [
            [
                'title' => "Home",
                'type' => 'menu',
                'data' => ["select_item" => "static", "select_id" => '/en'],
                'tag' => 'main-menu',
                'lang' => 'en',
                'layouts' => [],
            ],
            [
                'title' => "News",
                'type' => 'menu',
                'data' => ["select_item" => "static", "select_id" => '/en/news'],
                'tag' => 'main-menu',
                'lang' => 'en',
                'layouts' => [],
            ],
            [
                'title' => "About Us",
                'type' => 'menu',
                'data' => ["select_item" => "static", "select_id" => '/en/pages/about-us'],
                'tag' => 'main-menu',
                'lang' => 'en',
                'layouts' => [],
            ],
            [
                'title' => "Education",
                'type' => 'menu',
                'data' => ["select_item" => "static", "select_id" => '/en/pages/education'],
                'tag' => 'main-menu',
                'lang' => 'en',
                'layouts' => [],
            ],
            [
                'title' => "Safety",
                'type' => 'menu',
                'data' => ["select_item" => "static", "select_id" => '/en/pages/safety'],
                'tag' => 'main-menu',
                'lang' => 'en',
                'layouts' => [],
            ],
        ];
    }

    public function mainSlider()
    {
        $img1 = public_path("Impact/assets/img/seed/carousel-1.jpg");
        $img2 = public_path("Impact/assets/img/seed/carousel-2.jpg");
        $img3 = public_path("Impact/assets/img/seed/carousel-3.jpg");
        $fakeUploadedFile1 = $fakeUploadedFile2 = $fakeUploadedFile3 = null;
        if (file_exists($img1)) {
            $fakeUploadedFile1 = UploadedFile::fake()->createWithContent("carousel-1.jpg", file_get_contents($img1));
        }
        if (file_exists($img2)) {
            $fakeUploadedFile2 = UploadedFile::fake()->createWithContent("carousel-2.jpg", file_get_contents($img2));
        }
        if (file_exists($img3)) {
            $fakeUploadedFile3 = UploadedFile::fake()->createWithContent("carousel-3.jpg", file_get_contents($img3));
        }
        return [
            [
                'title' => "صدای جهانی خلبانان",
                'type' => 'slider',
                'description' => '<p>فدراسیون بین المللی انجمن های خلبانان خطوط هوایی</p>',
                'data' => ["select_item" => "static", "select_id" => '#about'],
                'tag' => 'main-slider',
                'lang' => 'fa',
                'image' => $fakeUploadedFile1,
                'layouts' => [],
            ],
            [
                'title' => "صدای جهانی خلبانان",
                'type' => 'slider',
                'description' => '<p>فدراسیون بین المللی انجمن های خلبانان خطوط هوایی</p>',
                'data' => ["select_item" => "static", "select_id" => '#about'],
                'tag' => 'main-slider',
                'lang' => 'fa',
                'image' => $fakeUploadedFile2,
                'layouts' => [],
            ],
            [
                'title' => "صدای جهانی خلبانان",
                'type' => 'slider',
                'description' => '<p>فدراسیون بین المللی انجمن های خلبانان خطوط هوایی</p>',
                'data' => ["select_item" => "static", "select_id" => '#about'],
                'tag' => 'main-slider',
                'lang' => 'fa',
                'image' => $fakeUploadedFile3,
                'layouts' => [],
            ],
        ];
    }

    public function mainSliderEn()
    {
        $img1 = public_path("Impact/assets/img/seed/carousel-1.jpg");
        $img2 = public_path("Impact/assets/img/seed/carousel-2.jpg");
        $img3 = public_path("Impact/assets/img/seed/carousel-3.jpg");
        $fakeUploadedFile1 = $fakeUploadedFile2 = $fakeUploadedFile3 = null;
        if (file_exists($img1)) {
            $fakeUploadedFile1 = UploadedFile::fake()->createWithContent("carousel-1.jpg", file_get_contents($img1));
        }
        if (file_exists($img2)) {
            $fakeUploadedFile2 = UploadedFile::fake()->createWithContent("carousel-2.jpg", file_get_contents($img2));
        }
        if (file_exists($img3)) {
            $fakeUploadedFile3 = UploadedFile::fake()->createWithContent("carousel-3.jpg", file_get_contents($img3));
        }
        return [
            [
                'title' => "The Global Voice Of Pilots",
                'description' => "<p>The International Federation of Air Line Pilots' Associations</p>",
                'type' => 'slider',
                'data' => ["select_item" => "static", "select_id" => '#about'],
                'tag' => 'main-slider',
                'lang' => 'en',
                'image' => $fakeUploadedFile1,
                'layouts' => [],
            ],
            [
                'title' => "The Global Voice Of Pilots",
                'description' => "<p>The International Federation of Air Line Pilots' Associations</p>",
                'type' => 'slider',
                'data' => ["select_item" => "static", "select_id" => '#about'],
                'tag' => 'main-slider',
                'lang' => 'en',
                'image' => $fakeUploadedFile2,
                'layouts' => [],
            ],
            [
                'title' => "The Global Voice Of Pilots",
                'description' => "<p>The International Federation of Air Line Pilots' Associations</p>",
                'type' => 'slider',
                'data' => ["select_item" => "static", "select_id" => '#about'],
                'tag' => 'main-slider',
                'lang' => 'en',
                'image' => $fakeUploadedFile3,
                'layouts' => [],
            ],
        ];
    }

    public function mainNews()
    {
        return [
            [
                'title' => "اخبار 1",
                'type' => 'article',
                'data' => ["select_item" => "select", "select_id" => '11'],
                'tag' => 'main-news',
                'lang' => 'fa',
                'layouts' => [],
            ],
            [
                'title' => "اخبار 2",
                'type' => 'article',
                'data' => ["select_item" => "select", "select_id" => '12'],
                'tag' => 'main-news',
                'lang' => 'fa',
                'layouts' => [],
            ],
            [
                'title' => "اخبار 3",
                'type' => 'article',
                'data' => ["select_item" => "select", "select_id" => '13'],
                'tag' => 'main-news',
                'lang' => 'fa',
                'layouts' => [],
            ],
        ];
    }

    public function mainNewsEn()
    {
        return [
            [
                'title' => "news 1",
                'type' => 'article',
                'data' => ["select_item" => "select", "select_id" => '1'],
                'tag' => 'main-news',
                'lang' => 'fa',
                'layouts' => [],
            ],
            [
                'title' => "news 2",
                'type' => 'article',
                'data' => ["select_item" => "select", "select_id" => '2'],
                'tag' => 'main-news',
                'lang' => 'fa',
                'layouts' => [],
            ],
            [
                'title' => "news 3",
                'type' => 'article',
                'data' => ["select_item" => "select", "select_id" => '3'],
                'tag' => 'main-news',
                'lang' => 'fa',
                'layouts' => [],
            ],
        ];
    }

    public function homeAbout()
    {
        $img1 = public_path("Impact/assets/img/about-2.jpg");
        $fakeUploadedFile1 = null;
        if (file_exists($img1)) {
            $fakeUploadedFile1 = UploadedFile::fake()->createWithContent("about-2", file_get_contents($img1));
        }
        return [
            [
                'title' => 'ستون اول',
                'description' => '
                        <h3>طراحان سایت هنگام طراحی قالب سایت معمولا با این موضوع رو برو هستند</h3>
                        <img src="/Impact/assets/img/about.jpg" class="img-fluid rounded-4 mb-4" alt="">
                        <p>ز آنجا که لورم ایپسوم، شباهت زیادی به متن های واقعی دارد، طراحان معمولا از لورم ایپسوم استفاده میکنند تا فقط به مشتری یا کار فرما نشان دهند که قالب طراحی شده بعد از اینکه متن در آن قرار میگرد چگونه خواهد بود و فونت ها و اندازه ها چگونه در نظر گرفته شده است.</p>
                        <p>نکته بعدی در مورد متن ساختگی لورم ایپسوم این است که بعضی از طراحان وبسایت و گرافیست کاران بعد از آنکه قالب و محتوای مورد نظرشون را ایجاد کردند از یاد می‌برند</p>
                    ',
                'type' => 'slider',
                'data' => ["select_item" => "none", "select_id" => ''],
                'tag' => 'main-about',
                'lang' => 'fa',
                'layouts' => [],
            ],
            [
                'title' => 'ستون دوم',
                'description' => '
                        <p class="fst-italic">
                            اگر شما یک طراح هستین و یا با طراحی های گرافیکی سروکار دارید به متن های برخورده اید که با نام لورم ایپسوم شناخته می‌شوند. لورم ایپسوم یا طرح‌نما (به انگلیسی: Lorem ipsum) متنی ساختگی و بدون معنی است که برای امتحان فونت و یا پر کردن فضا در یک طراحی گرافیکی و یا صنعت چاپ استفاده میشود.
                        </p>
                        <ul>
                            <li><i class="bi bi-check-circle-fill"></i> لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ</li>
                            <li><i class="bi bi-check-circle-fill"></i> مداد رنگی ها مشغول بودند به جز مداد سفید</li>
                            <li><i class="bi bi-check-circle-fill"></i> مداد سفید تا صبح ماه کشید مهتاب کشید و انقدر ستاره کشید که کوچک و کوچکتر شد</li>
                        </ul>
                        <p>
                            مداد رنگی ها مشغول بودند به جز مداد سفید، هیچکس به او کار نمیداد، همه میگفتند : تو به هیچ دردی نمیخوری، یک شب که مداد رنگی ها تو سیاهی شب گم شده بودند، مداد سفید تا صبح ماه کشید مهتاب کشید و انقدر ستاره کشید که کوچک و کوچکتر شد صبح توی جعبه مداد رنگی جای خالی او با هیچ رنگی  پر نشد
                        </p>
                    ',
                'type' => 'slider',
                'data' => ["select_item" => "static", "select_id" => 'https://www.youtube.com/watch?v=LXb3EKWsInQ'],
                'tag' => 'main-about',
                'lang' => 'fa',
                'image' => $fakeUploadedFile1,
                'layouts' => [],
            ],
        ];
    }

    public function homeAboutEn()
    {
        $img1 = public_path("Impact/assets/img/about-2.jpg");
        $fakeUploadedFile1 = null;
        if (file_exists($img1)) {
            $fakeUploadedFile1 = UploadedFile::fake()->createWithContent("about-2", file_get_contents($img1));
        }
        return [
            [
                'title' => 'First Column',
                'type' => 'about',
                'description' => '
                        <h3>Voluptatem dignissimos provident quasi corporis</h3>
                        <img src="/Impact/assets/img/about.jpg" class="img-fluid rounded-4 mb-4" alt="">
                        <p>Ut fugiat ut sunt quia veniam. Voluptate perferendis perspiciatis quod nisi et. Placeat debitis quia recusandae odit et consequatur voluptatem. Dignissimos pariatur consectetur fugiat voluptas ea.</p>
                        <p>Temporibus nihil enim deserunt sed ea. Provident sit expedita aut cupiditate nihil vitae quo officia vel. Blanditiis eligendi possimus et in cum. Quidem eos ut sint rem veniam qui. Ut ut repellendus nobis tempore doloribus debitis explicabo similique sit. Accusantium sed ut omnis beatae neque deleniti repellendus.</p>
                    ',
                'data' => ["select_item" => "none", "select_id" => ''],
                'tag' => 'main-about',
                'lang' => 'en',
                'layouts' => [],
            ],
            [
                'title' => 'Second Column',
                'type' => 'about',
                'description' => '
                        <p class="fst-italic">
                            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                            magna aliqua.
                        </p>
                        <ul>
                            <li><i class="bi bi-check-circle-fill"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                            <li><i class="bi bi-check-circle-fill"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
                            <li><i class="bi bi-check-circle-fill"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</li>
                        </ul>
                        <p>
                            Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                            velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident
                        </p>
                    ',
                'data' => ["select_item" => "static", "select_id" => 'https://www.youtube.com/watch?v=LXb3EKWsInQ'],
                'tag' => 'main-about',
                'image' => $fakeUploadedFile1,
                'lang' => 'en',
                'layouts' => [],
            ],
            
        ];
    }

    public function mainCTA()
    {
        $img1 = public_path("Impact/assets/img/seed/carousel-4.jpg");
        $fakeUploadedFile1 = null;
        if (file_exists($img1)) {
            $fakeUploadedFile1 = UploadedFile::fake()->createWithContent("carousel-4.jpg", file_get_contents($img1));
        }
        return [
            [
                'title' => "دعوت به اقدام",
                'description' => '<p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است.</p>',
                'type' => 'slider',
                'data' => ["select_item" => "static", "select_id" => 'https://www.aparat.com/v/i60dj35', "sub_title" => ""],
                'tag' => 'main-slider',
                'lang' => 'fa',
                'image' => $fakeUploadedFile1,
                'layouts' => [],
            ],
        ];
    }

    public function mainCTAEn()
    {
        $img1 = public_path("Impact/assets/img/seed/carousel-4.jpg");
        $fakeUploadedFile1 = null;
        if (file_exists($img1)) {
            $fakeUploadedFile1 = UploadedFile::fake()->createWithContent("carousel-4.jpg", file_get_contents($img1));
        }
        return [
            [
                'title' => "Call To Action",
                'description' => '<p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>',
                'type' => 'slider',
                'data' => ["select_item" => "static", "select_id" => '/en/education', "video_link" => "https://www.aparat.com/v/i60dj35"],
                'tag' => 'main-slider',
                'lang' => 'en',
                'image' => $fakeUploadedFile1,
                'layouts' => [],
            ],
        ];
    }

    public function services()
    {
        return [
            [
                'title' => "لورم ایپسوم",
                'description' => '<p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است</p>',
                'type' => 'slider',
                'data' => ["select_item" => "none", "select_id" => ''],
                'tag' => 'services',
                'icon' => 'bi bi-activity',
                'lang' => 'fa',
                'layouts' => [],
            ],
            [
                'title' => "صدای ما",
                'description' => '<p>برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. </p>',
                'type' => 'slider',
                'data' => ["select_item" => "none", "select_id" => ''],
                'tag' => 'services',
                'icon' => 'bi bi-broadcast',
                'lang' => 'fa',
                'layouts' => [],
            ],
            [
                'title' => "دیدگاه ها",
                'description' => '<p>کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد.</p>',
                'type' => 'slider',
                'data' => ["select_item" => "none", "select_id" => ''],
                'tag' => 'services',
                'icon' => 'bi bi-easel',
                'lang' => 'fa',
                'layouts' => [],
            ],
            [
                'title' => "چارچوب قوانین",
                'description' => '<p>با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد.</p>',
                'type' => 'slider',
                'data' => ["select_item" => "none", "select_id" => ''],
                'tag' => 'services',
                'icon' => 'bi bi-bounding-box-circles',
                'lang' => 'fa',
                'layouts' => [],
            ],
            [
                'title' => "جدول زمانی",
                'description' => '<p>در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد.</p>',
                'type' => 'slider',
                'data' => ["select_item" => "none", "select_id" => ''],
                'tag' => 'services',
                'icon' => 'bi bi-calendar4-week',
                'lang' => 'fa',
                'layouts' => [],
            ],
            [
                'title' => "پاسخ گویی",
                'description' => '<p>مان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>',
                'type' => 'slider',
                'data' => ["select_item" => "none", "select_id" => ''],
                'tag' => 'services',
                'icon' => 'bi bi-chat-square-text',
                'lang' => 'fa',
                'layouts' => [],
            ],
        ];
    }

    public function servicesEn()
    {
        return [
            [
                'title' => "Nesciunt Mete",
                'description' => '<p>Provident nihil minus qui consequatur non omnis maiores. Eos accusantium minus dolores iure perferendis tempore et consequatur.</p>',
                'type' => 'slider',
                'data' => ["select_item" => "none", "select_id" => ''],
                'tag' => 'services',
                'icon' => 'bi bi-activity',
                'lang' => 'en',
                'layouts' => [],
            ],
            [
                'title' => "Eosle Commodi",
                'description' => '<p>Ut autem aut autem non a. Sint sint sit facilis nam iusto sint. Libero corrupti neque eum hic non ut nesciunt dolorem.</p>',
                'type' => 'slider',
                'data' => ["select_item" => "none", "select_id" => ''],
                'tag' => 'services',
                'icon' => 'bi bi-broadcast',
                'lang' => 'en',
                'layouts' => [],
            ],
            [
                'title' => "Ledo Markt",
                'description' => '<p>Ut excepturi voluptatem nisi sed. Quidem fuga consequatur. Minus ea aut. Vel qui id voluptas adipisci eos earum corrupti.</p>',
                'type' => 'slider',
                'data' => ["select_item" => "none", "select_id" => ''],
                'tag' => 'services',
                'icon' => 'bi bi-easel',
                'lang' => 'en',
                'layouts' => [],
            ],
            [
                'title' => "Asperiores Commodit",
                'description' => '<p>Non et temporibus minus omnis sed dolor esse consequatur. Cupiditate sed error ea fuga sit provident adipisci neque.</p>',
                'type' => 'slider',
                'data' => ["select_item" => "none", "select_id" => ''],
                'tag' => 'services',
                'icon' => 'bi bi-bounding-box-circles',
                'lang' => 'en',
                'layouts' => [],
            ],
            [
                'title' => "Velit Doloremque",
                'description' => '<p>Cumque et suscipit saepe. Est maiores autem enim facilis ut aut ipsam corporis aut. Sed animi at autem alias eius labore.</p>',
                'type' => 'slider',
                'data' => ["select_item" => "none", "select_id" => ''],
                'tag' => 'services',
                'icon' => 'bi bi-calendar4-week',
                'lang' => 'en',
                'layouts' => [],
            ],
            [
                'title' => "Dolori Architecto",
                'description' => '<p>Hic molestias ea quibusdam eos. Fugiat enim doloremque aut neque non et debitis iure. Corrupti recusandae ducimus enim.</p>',
                'type' => 'slider',
                'data' => ["select_item" => "none", "select_id" => ''],
                'tag' => 'services',
                'icon' => 'bi bi-chat-square-text',
                'lang' => 'en',
                'layouts' => [],
            ],
        ];
    }

    public function socialMedia()
    {
        return [
            [
                'title' => "Twitter",
                'type' => 'slider',
                'data' => ["select_item" => "none", "select_id" => ''],
                'tag' => 'social-media',
                'icon' => 'bi bi-twitter',
                'lang' => 'fa',
                'layouts' => [],
            ],
            [
                'title' => "Facebook",
                'type' => 'slider',
                'data' => ["select_item" => "none", "select_id" => ''],
                'tag' => 'social-media',
                'icon' => 'bi bi-facebook',
                'lang' => 'fa',
                'layouts' => [],
            ],
            [
                'title' => "Instagram",
                'type' => 'slider',
                'data' => ["select_item" => "none", "select_id" => ''],
                'tag' => 'social-media',
                'icon' => 'bi bi-instagram',
                'lang' => 'fa',
                'layouts' => [],
            ],
            [
                'title' => "Telegram",
                'type' => 'slider',
                'data' => ["select_item" => "none", "select_id" => ''],
                'tag' => 'social-media',
                'icon' => 'bi bi-telegram',
                'lang' => 'fa',
                'layouts' => [],
            ],
            [
                'title' => "Linkedin",
                'type' => 'slider',
                'data' => ["select_item" => "none", "select_id" => ''],
                'tag' => 'social-media',
                'icon' => 'bi bi-linkedin',
                'lang' => 'fa',
                'layouts' => [],
            ],
        ]; 
    }

    public function socialMediaEn()
    {
        return [
            [
                'title' => "Twitter",
                'type' => 'slider',
                'data' => ["select_item" => "none", "select_id" => ''],
                'tag' => 'social-media',
                'icon' => 'bi bi-twitter',
                'lang' => 'en',
                'layouts' => [],
            ],
            [
                'title' => "Facebook",
                'type' => 'slider',
                'data' => ["select_item" => "none", "select_id" => ''],
                'tag' => 'social-media',
                'icon' => 'bi bi-facebook',
                'lang' => 'en',
                'layouts' => [],
            ],
            [
                'title' => "Instagram",
                'type' => 'slider',
                'data' => ["select_item" => "none", "select_id" => ''],
                'tag' => 'social-media',
                'icon' => 'bi bi-instagram',
                'lang' => 'en',
                'layouts' => [],
            ],
            [
                'title' => "Telegram",
                'type' => 'slider',
                'data' => ["select_item" => "none", "select_id" => ''],
                'tag' => 'social-media',
                'icon' => 'bi bi-telegram',
                'lang' => 'en',
                'layouts' => [],
            ],
            [
                'title' => "Linkedin",
                'type' => 'slider',
                'data' => ["select_item" => "none", "select_id" => ''],
                'tag' => 'social-media',
                'icon' => 'bi bi-linkedin',
                'lang' => 'en',
                'layouts' => [],
            ],
        ]; 
    }

    public function createLayoutWithSubLayouts($layouts, $layoutGroup, $layoutParent = null)
    {
        foreach ($layouts as $key => $layout) {
            $parentLayout = $this->createLayout($layout, $layoutGroup, $key, $layoutParent);
            if($layout['image'] ?? false)
                $image =  $this->createFakeImage($layout['image'], $parentLayout);
            if (count($layout['layouts'] ?? []))
                $this->createLayoutWithSubLayouts($layout['layouts'], $layoutGroup, $parentLayout);
        }
    }

    public function createLayout($layout, $layoutGroup, $key, $layoutParent = null)
    {
        return Layout::create([
            'layout_group_id' => $layoutGroup?->id,
            "title" => $layout["title"],
            'description' => $layout['description'] ?? null,
            'type' => $layout['type'] ?? null,
            'lang' => $layout['lang'] ?? null,
            'tag' => $layout['tag'] ?? null,
            'data' => $layout["data"],
            'icon' => $layout["icon"] ?? null,
            'start_date_release' => $layout["start_date_release"] ?? null,
            'end_date_release' => $layout["end_date_release"] ?? null,
            'release_type' => EnumLayoutReleaseType::RELEASE,
            'priority' => $key,
            'is_active' => 1,
            'parent_id' => $layoutParent?->id,
            'count_list' => $layout['count_list'] ?? 10,
        ]);
    }
}
