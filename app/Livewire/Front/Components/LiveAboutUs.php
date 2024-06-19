<?php

namespace App\Livewire\Front\Components;

use Livewire\Component;

class LiveAboutUs extends Component
{
    public function render()
    {
        $data = $this->getData();
        return view('livewire.front.components.live-about-us', compact('data'));
    }

    protected function getData()
    {
        $dataEn = [
            'title' => 'About Us',
            'sub_title' => 'Aperiam dolorum et et wuia molestias qui eveniet numquam nihil porro incidunt dolores placeat sunt id nobis omnis tiledo stran delop',
            'first_content' => '
                <h3>Voluptatem dignissimos provident quasi corporis</h3>
                <img src="/Impact/assets/img/about.jpg" class="img-fluid rounded-4 mb-4" alt="">
                <p>Ut fugiat ut sunt quia veniam. Voluptate perferendis perspiciatis quod nisi et. Placeat debitis quia recusandae odit et consequatur voluptatem. Dignissimos pariatur consectetur fugiat voluptas ea.</p>
                <p>Temporibus nihil enim deserunt sed ea. Provident sit expedita aut cupiditate nihil vitae quo officia vel. Blanditiis eligendi possimus et in cum. Quidem eos ut sint rem veniam qui. Ut ut repellendus nobis tempore doloribus debitis explicabo similique sit. Accusantium sed ut omnis beatae neque deleniti repellendus.</p>
            ',
            'second_content' => '
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

                <div class="position-relative mt-4">
                    <img src="/Impact/assets/img/about-2.jpg" class="img-fluid rounded-4" alt="">
                    <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox play-btn"></a>
                </div>
            ',
        ];

        $dataFa = [
            'title' => 'درباره ما',
            'sub_title' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است.',
            'first_content' => '
                <h3>طراحان سایت هنگام طراحی قالب سایت معمولا با این موضوع رو برو هستند</h3>
                <img src="/Impact/assets/img/about.jpg" class="img-fluid rounded-4 mb-4" alt="">
                <p>ز آنجا که لورم ایپسوم، شباهت زیادی به متن های واقعی دارد، طراحان معمولا از لورم ایپسوم استفاده میکنند تا فقط به مشتری یا کار فرما نشان دهند که قالب طراحی شده بعد از اینکه متن در آن قرار میگرد چگونه خواهد بود و فونت ها و اندازه ها چگونه در نظر گرفته شده است.</p>
                <p>نکته بعدی در مورد متن ساختگی لورم ایپسوم این است که بعضی از طراحان وبسایت و گرافیست کاران بعد از آنکه قالب و محتوای مورد نظرشون را ایجاد کردند از یاد می‌برند</p>
            ',
            'second_content' => '
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

                <div class="position-relative mt-4">
                    <img src="/Impact/assets/img/about-2.jpg" class="img-fluid rounded-4" alt="">
                    <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox play-btn"></a>
                </div>
            ',
        ];
        return app()->getLocale() === 'en' ? $dataEn : $dataFa;
    }
}
