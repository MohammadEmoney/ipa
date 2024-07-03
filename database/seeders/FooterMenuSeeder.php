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

class FooterMenuSeeder extends Seeder
{
    use MediaTrait;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::beginTransaction();
            $footerMenu = $this->footerMenu();
            $footerMenuEn = $this->footerMenuEn();

            $groups = [
                [
                    "title" => "منو فوتر",
                    "active" => 1,
                    "count_list" => null,
                    "layouts" => $footerMenu,
                    "tag" => "footer-menu",
                    'lang' => 'fa', 
                ],
                [
                    "title" => "Footer Menu",
                    "active" => 1,
                    "count_list" => null,
                    "layouts" => $footerMenuEn,
                    "tag" => "footer-menu",
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
            DB::commit();
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

     /**
     * @return array[]
     */
    public function footerMenu()
    {
        return [
            [
                'title' => "خانه",
                'type' => 'menu',
                'data' => ["select_item" => "static", "select_id" => '/fa'],
                'tag' => 'footer-menu',
                'lang' => 'fa',
                'layouts' => [],
            ],
            [
                'title' => "اخبار",
                'type' => 'menu',
                'data' => ["select_item" => "static", "select_id" => '/fa/news'],
                'tag' => 'footer-menu',
                'lang' => 'fa',
                'layouts' => [],
            ],
            [
                'title' => "درباره ما",
                'type' => 'menu',
                'data' => ["select_item" => "static", "select_id" => '/fa/pages/about-us-fa'],
                'tag' => 'footer-menu',
                'lang' => 'fa',
                'layouts' => [],
            ],
            [
                'title' => "آموزش",
                'type' => 'menu',
                'data' => ["select_item" => "static", "select_id" => '/fa/pages/education-fa'],
                'tag' => 'footer-menu',
                'lang' => 'fa',
                'layouts' => [],
            ],
            [
                'title' => "ایمنی",
                'type' => 'menu',
                'data' => ["select_item" => "static", "select_id" => '/fa/pages/safety-fa'],
                'tag' => 'footer-menu',
                'lang' => 'fa',
                'layouts' => [],
            ],
        ];
    }
    /**
     * @return array[]
     */
    public function footerMenuEn()
    {
        return [
            [
                'title' => "Home",
                'type' => 'menu',
                'data' => ["select_item" => "static", "select_id" => '/en'],
                'tag' => 'footer-menu',
                'lang' => 'en',
                'layouts' => [],
            ],
            [
                'title' => "News",
                'type' => 'menu',
                'data' => ["select_item" => "static", "select_id" => '/en/news'],
                'tag' => 'footer-menu',
                'lang' => 'en',
                'layouts' => [],
            ],
            [
                'title' => "About Us",
                'type' => 'menu',
                'data' => ["select_item" => "static", "select_id" => '/en/pages/about-us'],
                'tag' => 'footer-menu',
                'lang' => 'en',
                'layouts' => [],
            ],
            [
                'title' => "Education",
                'type' => 'menu',
                'data' => ["select_item" => "static", "select_id" => '/en/pages/education'],
                'tag' => 'footer-menu',
                'lang' => 'en',
                'layouts' => [],
            ],
            [
                'title' => "Safety",
                'type' => 'menu',
                'data' => ["select_item" => "static", "select_id" => '/en/pages/safety'],
                'tag' => 'footer-menu',
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
