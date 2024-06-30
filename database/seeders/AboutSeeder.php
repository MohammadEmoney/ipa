<?php

namespace Database\Seeders;

use App\Enums\EnumLayoutReleaseType;
use App\Models\Layout;
use App\Models\LayoutGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;

class AboutSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $layouts = $this->homeAbout();
        $layoutsEn = $this->homeAboutEn();
        $layoutGroup = LayoutGroup::where('tag', 'main-about')->where('lang', 'fa')->first();
        $layoutGroupEn = LayoutGroup::where('tag', 'main-about')->where('lang', 'en')->first();
        foreach($layouts as $key => $layout)
            $this->createLayout($layout, $layoutGroup, $key);
        foreach($layoutsEn as $key => $layoutEn)
            $this->createLayout($layoutEn, $layoutGroupEn, $key);
    }

    public function createLayout($layout, $layoutGroup, $key, $layoutParent = null)
    {
        return Layout::updateOrCreate([
            'layout_group_id' => $layoutGroup?->id,
            "title" => $layout["title"],
        ],
        [
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
                        <h3>رویای شیرین بشریت</h3>
                        <img src="/Impact/assets/img/about.jpg" class="img-fluid rounded-4 mb-4" alt="">
                        <p>پرواز در اوج آسمان‌ها از دیرباز رویای شیرین بشریت بوده‌است که به لطف تلاش‌ها، آزمون و خطاها و پرداخت هزینه‌های جانی و مالی گزاف در کنار فراز و فرودهای متعدد تا اختراع هواپیما، شاهد پیشرفت روزمره صنعت هوانوردی در تمامی مجامع بین‌الملل و مبدل شدن آن به یک جزء اساسی زندگی انسان‌ها هستیم.</p>
                        <p>در جهت توسعه هر چه بیشتر صنعت هوانوردی همکاری تمامی ارکان و اعضای آن علی‌الخصوص خلبان‌های این صنعت که خود این موقعیت شغلی مهم و حساس در کنار جذابیت‌های ظاهری و حساسیت‌های بسیار از جمله مسائل ایمنی و اقتصادی که کانون توجه قشر گسترده‌ای از جامعه می‌باشد امری جبری و لازم می‌باشد. انجمن خلبانی ایران به‌ نام IPA اقدام به تأسیس کرده است تا به همکاری با سایر ارکان و ارگان‌های داخلی و خارجی بپردازد و اقدامات لازمه را برای بهبود شرایط و ارتقاء شغل خلبانی به عمل بیاورند.</p>
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
                            انجمن خلبانان ایران یک سازمان حرفه ای است که به حمایت و حمایت از منافع خلبانان در ایران اختصاص دارد. ما متعهد به ارتقای ایمنی هوانوردی، تقویت توسعه حرفه ای و نمایندگی صدای اعضای خود هستیم.
                        </p>
                        <ul>
                            <li> ارتقای ایمنی هوانوردی از طریق آموزش، آموزش و حمایت.</li>
                            <li> فراهم کردن بستری برای خلبانان برای اتصال، شبکه و به اشتراک گذاری دانش.</li>
                            <li> ارائه منافع خلبانان به سازمان های دولتی و ذینفعان صنعت.</li>
                        </ul>
                        <p>
                            جامعه‌ خلبانی‌ ایران با توجه‌ به‌ توانایی‌هاي تخصـصـی‌ و تجارب فراوان و نیز وجود افراد شـایسـته‌ در صـنعت‌ هوانوردي اقدام به‌ تأســـیس‌ انجمن‌ خلبانی‌ ایران به‌ نام IPA(Iran Pilots Association) نموده اســـت‌ تا با تعامل‌ و همکاري با سـایر ارکان و ارگانهاي داخلی‌ و هم‌چنین‌ تشـکل‌ها و سـازمانهاي دولتی‌ و غیر دولتی‌ داخلی‌ و بین‌ المللی‌ در جهت‌ پیشبرد اهداف، بهبود شرایط‌ و ارتقاء شغل‌ خلبانی‌ اقدامات لازمه‌ را به‌ عمل‌ بیاورند.
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
                        <h3>The sweet dream of humanity</h3>
                        <img src="/Impact/assets/img/about.jpg" class="img-fluid rounded-4 mb-4" alt="">
                        <p>Flying in the sky has long been the sweet dream of mankind, which thanks to the efforts, trials and errors and the payment of huge financial and life costs along with numerous ups and downs until the invention of the airplane, witnessed the daily progress of the aviation industry in all international forums and turned it into a We are an essential part of human life.</p>
                        <p>In order to develop the aviation industry as much as possible, the cooperation of all its elements and members, especially the pilots of this industry, which is an important and sensitive job position, in addition to its attractiveness and many sensitivities, including safety and economic issues, which is the focus of attention of a wide segment of the society, is imperative. It is necesary. The Iranian Pilot Association, named IPA, has been established in order to cooperate with other domestic and foreign bodies and organizations and take necessary measures to improve the conditions and promote the pilot job.</p>
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
                            The Iranian Pilots Association is a professional organization dedicated to supporting and advocating for the interests of pilots in Iran. We are committed to promoting aviation safety, fostering professional development, and representing the voices of our members
                        </p>
                        <ul>
                            <li> Promoting aviation safety through education, training, and advocacy.</li>
                            <li> Providing a platform for pilots to connect, network, and share knowledge.</li>
                            <li> Representing the interests of pilots to government agencies and industry stakeholders.</li>
                        </ul>
                        <p>
                            Considering the specialized abilities and many experiences, as well as the presence of worthy people in the aviation industry, the Iranian pilot community has established the Iranian Pilots Association (IPA) in order to interact and cooperate with other internal bodies and organizations as well as organizations and Domestic and international governmental and non-governmental organizations should take the necessary measures in order to advance the goals, improve the conditions and promote the pilot job.
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
}
