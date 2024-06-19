<?php

namespace Database\Seeders;

use App\Enums\EnumLayoutReleaseType;
use App\Models\Layout;
use App\Models\LayoutGroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LayoutTableSeeder extends Seeder
{
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
            // [
            //     "title" => "محتوا اصلی",
            //     "active" => 1,
            //     "count_list" => 0,
            //     "layouts" => $mainContent,
            //     "tag" => 'main-content',
            //     'lang' => 'fa',
            // ],
            // [
            //     "title" => "محتوای پاورقی",
            //     "active" => 1,
            //     "count_list" => 0,
            //     "layouts" => $footer,
            //     "tag" => 'main-footer',
            //     'lang' => 'fa',
            // ],
        ];

        foreach ($groups as $group) {
            $lg = LayoutGroup::create([
                "title" => $group["title"],
                "is_active" => 1,
                "tag" => $group["tag"] ?? "",
                "lang" => $group["lang"] ?? "",
                "count_list" => $group["count_list"],
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
                'data' => ["select_item" => "static", "select_id" => '/fa/about-us'],
                'tag' => 'main-menu',
                'lang' => 'fa',
                'layouts' => [],
            ],
            [
                'title' => "آموزش و ایمنی",
                'type' => 'menu',
                'data' => ["select_item" => "static", "select_id" => '/fa/education-and-safety'],
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
                'data' => ["select_item" => "static", "select_id" => '/en/about-us'],
                'tag' => 'main-menu',
                'lang' => 'en',
                'layouts' => [],
            ],
            [
                'title' => "Education and safety",
                'type' => 'menu',
                'data' => ["select_item" => "static", "select_id" => '/en/education-and-safety'],
                'tag' => 'main-menu',
                'lang' => 'en',
                'layouts' => [],
            ],
        ];
    }

    public function createLayoutWithSubLayouts($layouts, $layoutGroup, $layoutParent = null)
    {
        foreach ($layouts as $key => $layout) {
            $parentLayout = $this->createLayout($layout, $layoutGroup, $key, $layoutParent);
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
