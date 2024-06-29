<?php

namespace App\Livewire\Front\Components;

use App\Traits\LayoutTrait;
use Livewire\Component;

class LiveOurServices extends Component
{
    use LayoutTrait;

    public function render()
    {
        $data = $this->getData();
        $layoutGroup = $this->getLayoutGroup(null,'services');
        $layouts = $this->getLayouts($layoutGroup);
        return view('livewire.front.components.live-our-services', compact('layouts', 'layoutGroup'));
    }

    protected function getData()
    {
        $dataEn = [
            'title' => 'Our Services',
            'sub_title' => 'Aperiam dolorum et et wuia molestias qui eveniet numquam nihil porro incidunt dolores placeat sunt id nobis omnis tiledo stran delop',
            'items' => [
                '<div class="col-lg-4 col-md-6">
                    <div class="service-item  position-relative">
                        <div class="icon">
                            <i class="bi bi-activity"></i>
                        </div>
                        <h3>Nesciunt Mete</h3>
                        <p>Provident nihil minus qui consequatur non omnis maiores. Eos accusantium minus dolores iure perferendis tempore et consequatur.</p>
                        <a href="#" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div><!-- End Service Item -->',
                '
                <div class="col-lg-4 col-md-6">
                    <div class="service-item position-relative">
                    <div class="icon">
                        <i class="bi bi-broadcast"></i>
                    </div>
                    <h3>Eosle Commodi</h3>
                    <p>Ut autem aut autem non a. Sint sint sit facilis nam iusto sint. Libero corrupti neque eum hic non ut nesciunt dolorem.</p>
                    <a href="#" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div><!-- End Service Item -->
                ',
                '
                <div class="col-lg-4 col-md-6">
                    <div class="service-item position-relative">
                    <div class="icon">
                        <i class="bi bi-easel"></i>
                    </div>
                    <h3>Ledo Markt</h3>
                    <p>Ut excepturi voluptatem nisi sed. Quidem fuga consequatur. Minus ea aut. Vel qui id voluptas adipisci eos earum corrupti.</p>
                    <a href="#" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div><!-- End Service Item -->
                ',
                '
                <div class="col-lg-4 col-md-6">
                    <div class="service-item position-relative">
                    <div class="icon">
                        <i class="bi bi-bounding-box-circles"></i>
                    </div>
                    <h3>Asperiores Commodit</h3>
                    <p>Non et temporibus minus omnis sed dolor esse consequatur. Cupiditate sed error ea fuga sit provident adipisci neque.</p>
                    <a href="#" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div><!-- End Service Item -->
                ',
                '
                <div class="col-lg-4 col-md-6">
                    <div class="service-item position-relative">
                    <div class="icon">
                        <i class="bi bi-calendar4-week"></i>
                    </div>
                    <h3>Velit Doloremque</h3>
                    <p>Cumque et suscipit saepe. Est maiores autem enim facilis ut aut ipsam corporis aut. Sed animi at autem alias eius labore.</p>
                    <a href="#" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div><!-- End Service Item -->
                ',
                '
                <div class="col-lg-4 col-md-6">
                    <div class="service-item position-relative">
                    <div class="icon">
                        <i class="bi bi-chat-square-text"></i>
                    </div>
                    <h3>Dolori Architecto</h3>
                    <p>Hic molestias ea quibusdam eos. Fugiat enim doloremque aut neque non et debitis iure. Corrupti recusandae ducimus enim.</p>
                    <a href="#" class="readmore stretched-link">Read more <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div><!-- End Service Item -->
                ',
            ],
        ];

        $dataFa = [
            'title' => 'خدمات ما',
            'sub_title' => 'لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان گرافیک است.',
            'items' => [
                '<div class="col-lg-4 col-md-6">
                    <div class="service-item  position-relative">
                        <div class="icon">
                            <i class="bi bi-activity"></i>
                        </div>
                        <h3>لورم ایپسوم</h3>
                        <p>لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است</p>
                        <a href="#" class="readmore stretched-link">بیشتر بخوانید <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div><!-- End Service Item -->',
                '
                <div class="col-lg-4 col-md-6">
                    <div class="service-item position-relative">
                    <div class="icon">
                        <i class="bi bi-broadcast"></i>
                    </div>
                    <h3>صدای ما</h3>
                    <p>برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. </p>
                    <a href="#" class="readmore stretched-link">بیشتر بخوانید <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div><!-- End Service Item -->
                ',
                '
                <div class="col-lg-4 col-md-6">
                    <div class="service-item position-relative">
                    <div class="icon">
                        <i class="bi bi-easel"></i>
                    </div>
                    <h3>دیدگاه ها</h3>
                    <p>کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد.</p>
                    <a href="#" class="readmore stretched-link">بیشتر بخوانید <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div><!-- End Service Item -->
                ',
                '
                <div class="col-lg-4 col-md-6">
                    <div class="service-item position-relative">
                    <div class="icon">
                        <i class="bi bi-bounding-box-circles"></i>
                    </div>
                    <h3>چارچوب قوانین</h3>
                    <p>با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد.</p>
                    <a href="#" class="readmore stretched-link">بیشتر بخوانید <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div><!-- End Service Item -->
                ',
                '
                <div class="col-lg-4 col-md-6">
                    <div class="service-item position-relative">
                    <div class="icon">
                        <i class="bi bi-calendar4-week"></i>
                    </div>
                    <h3>جدول زمانی</h3>
                    <p>در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد.</p>
                    <a href="#" class="readmore stretched-link">بیشتر بخوانید <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div><!-- End Service Item -->
                ',
                '
                <div class="col-lg-4 col-md-6">
                    <div class="service-item position-relative">
                    <div class="icon">
                        <i class="bi bi-chat-square-text"></i>
                    </div>
                    <h3>پاسخ گویی</h3>
                    <p>مان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>
                    <a href="#" class="readmore stretched-link">بیشتر بخوانید <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div><!-- End Service Item -->
                ',
            ],
        ];
        return app()->getLocale() === 'en' ? $dataEn : $dataFa;
    }
}
