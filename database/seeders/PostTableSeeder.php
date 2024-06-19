<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Post;
use App\Traits\MediaTrait;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostTableSeeder extends Seeder
{
    use MediaTrait;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('posts')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $postsEn = [
            [
                'title' => 'Enhancing Pilot Monitoring',
                'summary' => 'IPA recognizes the critical roles of Pilot Flying (PF) and Pilot Monitoring (PM) as foundational elements in flight deck operations.',
                'description' => '<div class="rich-text">
                    <p>IPA recognizes the critical roles of Pilot Flying (PF) and Pilot Monitoring (PM) as foundational elements in flight deck operations. While the aviation industry has established clear definitions and responsibilities for these specific <strong>roles</strong>, IPA advocates for a renewed focus on the monitoring <strong>tasks</strong> associated with both the pilot flying and monitoring positions during all phases of flight. This leaflet aims to highlight the pilot monitoring <strong>tasks</strong>,&nbsp;supporting flight safety and operational efficiency, and introduce tools for enhancing its effectiveness in the cockpit.</p>
                    <p>This briefing also introduces a theoretical background on human perception, cognition, and a model of situational awareness for pilot monitoring tasks. It then describes five tools designed to enhance monitoring effectiveness and their real-world applications. The reader is invited either to review the complete document or to review the tools individually, with references to the theoretical background where necessary.</p>
                </div>',
            ],
            [
                'title' => 'Transport of lithium batteries as cargo',
                'summary' => 'Two major types of lithium batteries power many types of consumer electronic devices',
                'description' => '<div class="rich-text">
                    <p>Two major types of lithium batteries power many types of consumer electronic devices: lithium ion batteries (including lithium ion polymer) and lithium metal batteries. Lithium ion batteries are typically rechargeable, and power devices such as laptop computers, mobile phones and portable music players, while non-rechargeable lithium metal batteries are normally used to power devices including cameras, flashlights and Automatic External Defibrillators. A lithium metal battery typically is composed of a single cell, while a lithium ion laptop battery may be composed of between 6 and 12 cells.</p>
                    <p>This Briefing Leaflet covers the risks posed by lithium batteries, current regulations as well as proposals to improve current regulations.</p>
                </div>',
            ],
            [
                'title' => 'Operational Opportunities to Reduce the Impact of Contrails',
                'summary' => 'Growing scientific evidence indicates that contrails, and especially aircraft-induced cirrus, have a significant overall warming effect.',
                'description' => '<div class="rich-text">
                    <p>Growing scientific evidence indicates that contrails, and especially aircraft-induced cirrus, have a significant overall warming effect. Chemical and physical processes can lead to contrail plumes and cirrus, depending on local atmospheric conditions (humidity and temperature), and on engine emissions.<br><br>Emission standards do not take contrail formation into account. Operational measures, such as tactical (real time) and strategic (planning) avoidance of these critical locations and timing, may prove beneficial. A relatively small change in altitude may reduce the contrails significantly. Interdependencies on fuel use, flight time diversion, and airspace capacity must be assessed.</p>
                </div>',
            ],
            [
                'title' => 'GBAS and GLS',
                'summary' => 'GBAS (Ground Based Augmentation System) and GLS (GBAS Landing System) is a GNSS (GPS) based approach and monitoring system that utilises a local airport facility to increase the accuracy and integrity of the position of an aircraft both vertically and laterally to support a Precision Approach.',
                'description' => '<div class="rich-text">
                    <p>GBAS (Ground Based Augmentation System) and GLS (GBAS Landing System) is a GNSS (GPS) based approach and monitoring system that utilises a local airport facility to increase the accuracy and integrity of the position of an aircraft both vertically and laterally to support a Precision Approach.</p>
                    <p>This system is in operation or in trial at many airports globally including Newark, Charleston, Houston and Moses Lake in the United States, Sydney in Australia, Bremen and Frankfurt in Germany, and Malaga in Spain.</p>
                    <p>The FAA is currently working on design approval for GLS for CAT III operations, and operations can be expected to commence when aircraft are certified for GLS CAT-III.</p>
                    <p>The purpose of this Briefing Leaflet is not to give too much in-depth technical information, but to enable IPA members an overview of the GLS and GBAS, how it works, the systems requirements on the ground and in the aircraft, and a pilot’s perspective on the system.</p>
                </div>',
            ],
            [
                'title' => 'Runway Status Lights (RWSL)',
                'summary' => 'RWSL is an automated system that provides advisory information for flight crews and airport vehicle drivers to indicate if it is unsafe to enter, cross or takeoff from a runway.',
                'description' => '<div class="rich-text">
                    <p>RWSL is an automated system that provides advisory information for flight crews and airport vehicle drivers to indicate if it is unsafe to enter, cross or takeoff from a runway. The system has been implemented on certain runways at a number of busy airports in the United States and Japan and is being implemented at Paris Charles de Gaulle (CDG) airport in France. Designed to reduce the number of runway incursions, the system is comprised of Runway Entrance Lights (RELs) and Takeoff Hold Lights (THLs).</p>
                    <p>The aim of this Briefing Leaflet is to introduce the core elements of Runway Status Lights (RWSL) as they have been deployed and identify the operational considerations relevant to flight crews.</p>
                </div>',
            ],
            [
                'title' => 'Alcohol Information for Pilots',
                'summary' => 'The importance of not drinking alcohol in proximity to duty is well known among the pilot population.',
                'description' => '<div class="rich-text">
                    <div>The importance of not drinking alcohol in proximity to duty is well known among the pilot population. However, the consumption of alcohol poses risks to long term health which could have an impact on flight safety. This Briefing Leaflet expands upon and explains those risks, and provides recommendations for pilots.</div>
                </div>',
            ],
            [
                'title' => 'Smoking and Aircrew',
                'summary' => 'Cigarette smoking is the single most important preventable environmental factor contributing to illness, disability, and premature death.',
                'description' => '<div class="rich-text">
                    <div>
                    <div class="copy-paste-block">Cigarette smoking is the single most important preventable environmental factor contributing to illness, disability, and premature death. The high morbidity and mortality rate is due to the effects of cigarette smoke on several diseases, primarily lung cancer, ischaemic heart disease, stroke, and peripheral vascular disease.</div>
                    <div class="copy-paste-block">&nbsp;</div>
                    <div class="copy-paste-block">In addition, the use of electronic cigarettes is known to cause adverse health effects.</div>
                    </div>
                </div>',
            ],
            [
                'title' => 'Dangerous Goods on RPAS & UAS',
                'summary' => 'Whilst the transport of DG on manned aircraft is heavily regulated, in most States there is currently no set of regulations that controls how DG are transported by RPAS and UAS.',
                'description' => '<div class="rich-text">
                    <p>Whilst the transport of DG on manned aircraft is heavily regulated, in most States there is currently no set of regulations that controls how DG are transported by RPAS and UAS. The carriage of DG by RPAS and UAS should only take place at a level of safety equivalent to the one guaranteed by ICAO provisions for manned aircraft.</p>
                </div>',
            ],
            [
                'title' => 'Problematic Substance Use Testing',
                'summary' => 'IPA fully supports an aviation industry free of substance abuse, particularly for those whose professional responsibilities are safety sensitive in nature. ',
                'description' => '<div class="rich-text">
                    <p>IPA fully supports an aviation industry free of substance abuse, particularly for those whose professional responsibilities are safety sensitive in nature. Quite often the workplace is one of the last places where substance abuse is noticed. Family members, friends and colleagues most often will have noticed the problem during leisure time before it becomes evident in the work environment. At this stage peer intervention programs are an effective means of intervention and prevention as opposed to the problematic substance-use testing programs in the workplace. Testing programs introduced as a reaction to political pressure create the false perception that such testing improves safety.</p>
                </div>',
            ],
            [
                'title' => 'Mental Health Requirements for Active Pilots',
                'summary' => 'IPA considers that an extensive psychological/psychiatric evaluation, as part of the routine pilot aeromedical assessment, is neither productive nor cost effective and therefore not warranted.',
                'description' => '<div class="rich-text">
                    <p>IPA considers that an extensive psychological/psychiatric evaluation, as part of the routine pilot aeromedical assessment, is neither productive nor cost effective and therefore not warranted.</p>
                    <p>Serious mental health illnesses are relatively rare among pilots and the onset of such illness is impossible to predict.</p>
                    <p>Routine psychological/psychiatric evaluation is a gross invasion of privacy and may impose more stress, threat and anxiety on the individual. Not all tests are culturally valid and screening tools are unreliable. Mental health assessment will only create the illusion of safety enhancement.</p>
                </div>',
            ],
        ];

        $postsFa = [
            [
                'title' => 'تقویت پایلوت پایلوت',
                'summary' => 'IPA نقش حیاتی پرواز خلبان (PF) و پایش خلبان (PM) را به عنوان عناصر اساسی در عملیات عرشه پرواز می شناسد.',
                'description' => '<div class="rich-text">
                    <p>IPA نقش حیاتی پرواز خلبان (PF) و پایش خلبان (PM) را به عنوان عناصر اساسی در عملیات عرشه پرواز می شناسد. در حالی که صنعت هوانوردی تعاریف و مسئولیت های روشنی را برای این <strong>نقش</strong>های خاص ایجاد کرده است، IPA از تمرکز مجدد بر روی <strong>وظایف</strong> نظارتی مرتبط با موقعیت های پروازی و نظارتی خلبان در تمام مدت دفاع می کند. مراحل پرواز هدف این جزوه برجسته کردن <strong>وظایف</strong> پایش خلبان، حمایت از ایمنی پرواز و کارایی عملیاتی، و معرفی ابزارهایی برای افزایش اثربخشی آن در کابین خلبان است.</p>
                    <p>این جلسه توجیهی همچنین یک پیشینه نظری در مورد ادراک انسان، شناخت و مدلی از آگاهی موقعیتی برای وظایف نظارت خلبان معرفی می کند. سپس پنج ابزار طراحی شده برای افزایش اثربخشی نظارت و کاربردهای واقعی آنها را شرح می دهد. از خواننده دعوت می شود که سند کامل را بررسی کند یا ابزارها را به صورت جداگانه با ارجاع به پیشینه نظری در صورت لزوم بررسی کند.</p>
                </div>',
            ],
            [
                'title' => 'حمل و نقل باتری های لیتیومی به عنوان محموله',
                'summary' => 'دو نوع عمده از باتری های لیتیومی انرژی بسیاری از انواع دستگاه های الکترونیکی مصرفی را تامین می کنند',
                'description' => '<div class="rich-text">
                    <p>دو نوع اصلی از باتری‌های لیتیومی انرژی بسیاری از دستگاه‌های الکترونیکی مصرفی را تامین می‌کنند: باتری‌های لیتیوم یونی (از جمله پلیمر یون لیتیوم) و باتری‌های فلزی لیتیوم. باتری‌های لیتیوم یونی معمولاً قابل شارژ هستند و دستگاه‌هایی مانند رایانه‌های لپ‌تاپ، تلفن‌های همراه و پخش‌کننده‌های موسیقی قابل حمل را تغذیه می‌کنند، در حالی که باتری‌های غیرقابل شارژ لیتیوم فلزی معمولاً برای تغذیه دستگاه‌هایی از جمله دوربین‌ها، چراغ قوه‌ها و دفیبریلاتورهای خارجی خودکار استفاده می‌شوند. یک باتری فلزی لیتیومی معمولاً از یک سلول تشکیل شده است، در حالی که یک باتری لپ تاپ لیتیوم یونی ممکن است از 6 تا 12 سلول تشکیل شده باشد.</p>
                    <p>این جزوه توجیهی خطرات ناشی از باتری های لیتیومی، مقررات فعلی و همچنین پیشنهادهایی برای بهبود مقررات فعلی را پوشش می دهد.</p>
                </div>',
            ],
            [
                'title' => 'فرصت های عملیاتی برای کاهش تأثیر Contrails',
                'summary' => 'شواهد علمی رو به رشد نشان می دهد که contrails، و به خصوص سیروس ناشی از هواپیما، اثر گرم شدن کلی قابل توجهی دارد.',
                'description' => '<div class="rich-text">
                    <p>شواهد علمی رو به رشد نشان می دهد که contrails، و به خصوص سیروس ناشی از هواپیما، اثر گرم شدن کلی قابل توجهی دارد. فرآیندهای شیمیایی و فیزیکی بسته به شرایط جوی محلی (رطوبت و دما) و آلاینده‌های موتور می‌توانند منجر به ایجاد توده‌های مخرب و سیروس شوند.<br><br>استانداردهای انتشار، تشکیل contrail را در نظر نمی‌گیرند. اقدامات عملیاتی، مانند اجتناب تاکتیکی (زمان واقعی) و استراتژیک (برنامه ریزی) از این مکان های بحرانی و زمان بندی، ممکن است مفید باشد. یک تغییر نسبتاً کوچک در ارتفاع ممکن است به طور قابل توجهی از contrails کاهش دهد. وابستگی متقابل به مصرف سوخت، انحراف زمان پرواز و ظرفیت فضای هوایی باید ارزیابی شود.</p>
                </div>',
            ],
            [
                'title' => 'GBAS و GLS',
                'summary' => 'GBAS (Ground Based Augmentation System) و GLS (GBAS Landing System) یک رویکرد و سیستم نظارتی مبتنی بر GNSS (GPS) است که از یک تسهیلات فرودگاهی محلی برای افزایش دقت و یکپارچگی موقعیت هواپیما به صورت عمودی و جانبی برای پشتیبانی از یک فرودگاه استفاده می‌کند. رویکرد دقیق',
                'description' => '<div class="rich-text">
                    <p>GBAS (Ground Based Augmentation System) و GLS (GBAS Landing System) یک رویکرد و سیستم نظارتی مبتنی بر GNSS (GPS) است که از تسهیلات فرودگاهی محلی برای افزایش دقت و یکپارچگی موقعیت هواپیما به صورت عمودی و جانبی برای پشتیبانی از یک فرودگاه استفاده می کند. رویکرد دقیق</p>
                    <p>این سیستم در بسیاری از فرودگاه های جهان از جمله نیوآرک، چارلستون، هیوستون و دریاچه موزس در ایالات متحده، سیدنی در استرالیا، برمن و فرانکفورت در آلمان و مالاگا در اسپانیا در حال اجرا یا آزمایش است.</p>
                    <p>FAA در حال حاضر روی تایید طراحی برای GLS برای عملیات CAT III کار می کند و انتظار می رود زمانی که هواپیماها برای GLS CAT-III گواهینامه دریافت کنند، عملیات شروع شود.</p>
                    <p>هدف این بروشور ارائه اطلاعات فنی بسیار عمیق نیست، بلکه این است که اعضای IPA یک دید کلی از GLS و GBAS، نحوه عملکرد آن، الزامات سیستم در زمین و هواپیما و دیدگاه خلبان را فراهم کند. روی سیستم</p>
                </div>',
            ],
            [
                'title' => 'چراغ های وضعیت باند (RWSL)',
                'summary' => 'RWSL یک سیستم خودکار است که اطلاعات مشاوره ای را برای خدمه پرواز و رانندگان وسایل نقلیه فرودگاه فراهم می کند تا نشان دهد آیا ورود، عبور یا برخاستن از باند فرودگاه ایمن نیست یا خیر.',
                'description' => '<div class="rich-text">
                    <p>RWSL یک سیستم خودکار است که اطلاعات مشاوره ای را برای خدمه پرواز و رانندگان وسایل نقلیه فرودگاه فراهم می کند تا نشان دهد آیا ورود، عبور یا برخاستن از باند فرودگاه ایمن نیست یا خیر. این سیستم در باندهای خاصی در تعدادی از فرودگاه های شلوغ در ایالات متحده و ژاپن پیاده سازی شده است و در فرودگاه پاریس شارل دوگل (CDG) فرانسه در حال اجرا است. این سیستم برای کاهش تعداد تهاجمات باند فرودگاه طراحی شده است و از چراغ های ورودی باند (REL) و چراغ های نگهدارنده برخاست (THL) تشکیل شده است.</p>
                    <p>هدف این بروشور توجیهی معرفی عناصر اصلی چراغ‌های وضعیت باند (RWSL) همانطور که مستقر شده‌اند و شناسایی ملاحظات عملیاتی مربوط به خدمه پرواز است.</p>
                </div>',
            ],
            [
                'title' => 'اطلاعات الکل برای خلبانان',
                'summary' => 'اهمیت ننوشیدن الکل در مجاورت وظیفه در میان جمعیت خلبان به خوبی شناخته شده است.',
                'description' => '<div class="rich-text">
                    <div>اهمیت ننوشیدن الکل در مجاورت وظیفه در میان جمعیت خلبان به خوبی شناخته شده است. با این حال، مصرف الکل خطراتی برای سلامتی طولانی مدت دارد که می تواند بر ایمنی پرواز تأثیر بگذارد. این جزوه توجیهی این خطرات را گسترش داده و توضیح می دهد و توصیه هایی را برای خلبانان ارائه می دهد.</div>
                </div>',
            ],
            [
                'title' => 'سیگار کشیدن و خدمه هواپیما',
                'summary' => 'سیگار تنها مهم ترین عامل محیطی قابل پیشگیری است که در ایجاد بیماری، ناتوانی و مرگ زودرس نقش دارد.',
                'description' => '<div class="rich-text">
                    <div>
                    <div class="copy-paste-block">سیگار تنها مهم ترین عامل محیطی قابل پیشگیری است که در ایجاد بیماری، ناتوانی و مرگ زودرس نقش دارد. میزان بالای عوارض و مرگ و میر ناشی از اثرات دود سیگار بر چندین بیماری، در درجه اول سرطان ریه، بیماری ایسکمیک قلبی، سکته مغزی و بیماری عروق محیطی است.</div>
                    <div class="copy-paste-block">&nbsp;</div>
                    <div class="copy-paste-block">علاوه بر این، استفاده از سیگارهای الکترونیکی به عنوان اثرات نامطلوب بر سلامت شناخته شده است.</div>
                    </div>
                </div>',
            ],
            [
                'title' => 'کالاهای خطرناک در RPAS و UAS',
                'summary' => 'در حالی که حمل و نقل DG در هواپیماهای سرنشین دار به شدت تنظیم شده است، در اکثر ایالت ها در حال حاضر مجموعه ای از مقررات وجود ندارد که نحوه انتقال DG توسط RPAS و UAS را کنترل کند.',
                'description' => '<div class="rich-text">
                    <p>در حالی که حمل و نقل DG در هواپیماهای سرنشین دار به شدت تنظیم شده است، در اکثر ایالت ها در حال حاضر مجموعه ای از مقررات وجود ندارد که نحوه انتقال DG توسط RPAS و UAS را کنترل کند. حمل DG توسط RPAS و UAS فقط باید در سطح ایمنی معادل سطح تضمین شده توسط مقررات ایکائو برای هواپیماهای سرنشین دار انجام شود.</p>
                </div>',
            ],
            [
                'title' => 'تست استفاده از مواد مشکل ساز',
                'summary' => 'IPA به طور کامل از صنعت هوانوردی عاری از سوء مصرف مواد پشتیبانی می کند، به ویژه برای کسانی که مسئولیت های حرفه ای آنها در طبیعت حساس به ایمنی است.',
                'description' => '<div class="rich-text">
                    <p>IPA به طور کامل از صنعت هوانوردی عاری از سوء مصرف مواد پشتیبانی می کند، به ویژه برای کسانی که مسئولیت های حرفه ای آنها در طبیعت حساس به ایمنی است. اغلب اوقات محل کار یکی از آخرین مکان هایی است که سوء مصرف مواد مورد توجه قرار می گیرد. اعضای خانواده، دوستان و همکاران اغلب قبل از اینکه در محیط کار آشکار شود، در اوقات فراغت متوجه این مشکل شده اند. در این مرحله، برنامه‌های مداخله همسالان بر خلاف برنامه‌های مشکل‌ساز تست مصرف مواد در محیط کار، ابزار مؤثری برای مداخله و پیشگیری هستند. برنامه های آزمایشی که به عنوان واکنشی به فشار سیاسی معرفی می شوند این تصور نادرست را ایجاد می کنند که چنین آزمایشی ایمنی را بهبود می بخشد.</p>
                </div>',
            ],
            [
                'title' => 'الزامات سلامت روان برای خلبانان فعال',
                'summary' => 'IPA معتقد است که یک ارزیابی روانشناختی/روانپزشکی گسترده، به عنوان بخشی از ارزیابی معمول هواپزشکی خلبان، نه مولد و نه مقرون به صرفه است و بنابراین ضمانت ندارد.',
                'description' => '<div class="rich-text">
                    <p>IPA معتقد است که یک ارزیابی روانشناختی/روانپزشکی گسترده، به عنوان بخشی از ارزیابی معمول هواپزشکی خلبان، نه مولد و نه مقرون به صرفه است و بنابراین ضمانت ندارد.</p>
                    <p>بیماری های جدی سلامت روان در بین خلبانان نسبتاً نادر است و پیش بینی شروع چنین بیماری غیرممکن است.</p>
                    <p>ارزیابی روتین روانشناختی/روانپزشکی یک تجاوز فاحش به حریم خصوصی است و ممکن است استرس، تهدید و اضطراب بیشتری را به فرد تحمیل کند. همه آزمون ها از نظر فرهنگی معتبر نیستند و ابزار غربالگری غیرقابل اعتماد هستند. ارزیابی سلامت روان تنها توهم افزایش ایمنی را ایجاد می کند.</p>
                </div>',
            ],
        ];

        foreach($postsEn as $key => $post)
            $this->createPost($post, 'en', $key +1);
        foreach($postsFa as $key => $post)
            $this->createPost($post, 'fa', $key +1);
    }

    public function createPost($data, $lang, $i)
    {
        $post = Post::create([
            'lang' => $lang,
            'title' => $data['title'],
            'slug' =>  Str::slug($data['title']),
            'summary' => $data['summary'] ?? null,
            'description' => $data['description'] ?? null,
            'is_active' => true,
            'created_by' => 1,
            'views' => rand(0, 999),
        ]);
        // $i = rand(1, 6);
        $img = public_path("Impact/assets/img/blog/$i.jpg");
        if (file_exists($img)) {
            $fakeUploadedFile = UploadedFile::fake()->createWithContent("$i.jpg", file_get_contents($img));
            $image =  $this->createFakeImage($fakeUploadedFile, $post);
        }

        $categories = Category::where('lang', $lang)->pluck('id');

        $post->mainCategory()->attach($categories->random(), ['is_main' => true]);
        $post->categories()->attach($categories->random(rand(0,2)) ?? []);
    }
}
