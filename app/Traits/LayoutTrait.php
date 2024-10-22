<?php

namespace App\Traits;

use App\Enums\EnumLayoutReleaseType;
use App\Factories\LayoutFactories\Articles\ArticleStrategyFactory;
use App\Factories\LayoutFactories\Menu\MenuStrategyFactory;
use App\Factories\LayoutFactories\Products\ProductStrategyFactory;
use App\Factories\LayoutFactories\Sliders\SliderStrategyFactory;
use App\Models\LayoutGroup;
use Carbon\Carbon;

trait LayoutTrait
{
    public function getLayoutGroup($id=null,$tags=null, $orderBy = 'priority', $direction = 'ASC')
    {
        $layout=LayoutGroup::query()->lang();

        if(!empty($id))
            $layout=$layout->where('id', $id);
        else
            $layout=$layout->where('tag','LIKE', "%$tags%");

        return $layout->with(['layouts' => function($query) use ($orderBy, $direction){
            $query->orderBy($orderBy, $direction);
        }, 'layouts.children'])->active()->first();
    }

    public function getLayoutGroupWithParent($id=null,$tags=null, $orderBy = 'priority', $direction = 'ASC')
    {
        $layout=LayoutGroup::query();

        if(!empty($id))
            $layout=$layout->where('id', $id);
        else
            $layout=$layout->where('tag','LIKE', "%$tags%");

        return $layout->with(['layouts' => function($query) use ($orderBy, $direction){
            $query->where('parent', null)->orderBy($orderBy, $direction);
        }, 'layouts.children'])->active()->first();
    }

    public function getLayoutGroupWithTag($tag, $orderBy = 'priority', $direction = 'ASC')
    {
        return LayoutGroup::where('tag', "like", "%$tag%")->with(['layouts' => function($query) use ($orderBy, $direction){
            $query->where('active', 1)->orderBy($orderBy, $direction);
        }])->active()->get();
    }

    public function getLayouts($layoutGroup, $limit = null)
    {
        if(is_null($layoutGroup)) return collect([]);

        if($sliders = $layoutGroup?->layouts()->whereIsRoot()->get()){
            if($sliders->count()){
                
                $sliders = $sliders->map(function($layout, $key){
                    $data = $layout->data;
                    $limit = $layout->count_list;

                    if (
                        $layout->is_active &&
                        (
                            $layout->release_type === EnumLayoutReleaseType::RELEASE || 
                            (
                                $layout->release_type === 'date' && 
                                $layout->end_date_release >= now() && 
                                $layout->start_date_release <= now()
                            )
                        )
                    ) {
                        if($layout->end_date_release){
                            $date = Carbon::parse($layout->end_date_release);
                            $layout->year = $date->year;
                            $layout->month = $date->month;
                            $layout->day = $date->day;
                            $layout->hour = $date->hour;
                            $layout->minute = $date->minute;
                            $layout->second = $date->second;
                        }
                        if(isset($data["select_item"]) && isset($data["select_id"])){
                            // Id Or the Value
                            $id = $data["select_id"];
            
                            if ($layout->type == 'product') {
                                $strategy = ProductStrategyFactory::getStrategy($data["select_item"]);
                                $products = $strategy->handle($id, $limit ?: 10);
                                if ($products) {
                                    $layout->products = $products;
                                }
                            }
            
                            if ($layout->type == 'article') {
                                $strategy = ArticleStrategyFactory::getStrategy($data["select_item"]);
                                $articles = $strategy->handle($id, $limit ?: 10);
                                if ($articles) {
                                    $layout->articles = $articles;
                                }
                            }
            
                            if ($layout->type == 'menu') {
                                $strategy = MenuStrategyFactory::getStrategy($data["select_item"]);
                                $menu = $strategy->handle($id);
                                if ($menu) {
                                    $layout->model = $menu['model'] ?? "";
                                    $layout->model_slug = $menu['slug'] ?? "";
                                    $layout->model_id = $menu['id'] ?? "";
                                    $layout->model_title = $menu['title'] ?? "";
                                    $layout->link = $menu['link'] ?? "";
                                }
                            }
            
                            if ($layout->type == 'slider') {
                                $strategy = SliderStrategyFactory::getStrategy($data["select_item"]);
                                $slider = $strategy->handle($id);
                                if ($slider) {
                                    $layout->model = $slider['model'] ?? "";
                                    $layout->model_slug = $slider['slug'] ?? "";
                                    $layout->model_id = $slider['id'] ?? "";
                                    $layout->model_title = $slider['title'] ?? "";
                                    $layout->link = $slider['link'] ?? "";
                                }
                            }
                        }
                        return $layout;
                    }
                    return null;

                    // Recursively add extra fields to children
                    // if($layout){
                    //     $layout->children = $layout?->children->map(function ($child) use ($limit) {
                    //         $child = $this->prepareLayout($child);
            
                    //         // Recursively process grandchildren
                    //         if($child){
                    //             $child->children = $child?->children->map(function ($grandchild) use ($limit) {
                    //                 // Add extra fields to the grandchild
                    //                 $grandchild = $this->prepareLayout($grandchild);
                    //                 // ... other extra fields
                
                    //                 // Continue recursion for deeper levels if needed
                    //                 return $grandchild;
                    //             })->filter();
                    //         }
            
                    //         return $child;
                    //     })->filter();
                    // }

                    // return $layout;
                    
                })->filter();
            }
            // if(!empty($limit) || !empty($layoutGroup->count_list))
            //     $sliders=$sliders->take($limit ?: $layoutGroup->count_list);
        }
        return $sliders ?: collect([]);
    }

    public function prepareLayout($layout)
    {
        if (
            $layout->is_active &&
            (
                $layout->release_type === EnumLayoutReleaseType::RELEASE || 
                (
                    $layout->release_type === 'date' && 
                    $layout->end_date_release >= now() && 
                    $layout->start_date_release <= now()
                )
            )
        ) {
            if($layout->end_date_release){
                $date = Carbon::parse($layout->end_date_release);
                $layout->year = $date->year;
                $layout->month = $date->month;
                $layout->day = $date->day;
                $layout->hour = $date->hour;
                $layout->minute = $date->minute;
                $layout->second = $date->second;
            }
            if(isset($data["select_item"]) && isset($data["select_id"])){
                // Id Or the Value
                $id = $data["select_id"];

                if ($layout->type == 'product') {
                    $strategy = ProductStrategyFactory::getStrategy($data["select_item"]);
                    $products = $strategy->handle($id, $limit ?: 10);
                    if ($products) {
                        $layout->products = $products;
                    }
                }

                if ($layout->type == 'article') {
                    $strategy = ArticleStrategyFactory::getStrategy($data["select_item"]);
                    $articles = $strategy->handle($id, $limit ?: 10);
                    if ($articles) {
                        $layout->articles = $articles;
                    }
                }

                if ($layout->type == 'menu') {
                    $strategy = MenuStrategyFactory::getStrategy($data["select_item"]);
                    $menu = $strategy->handle($id);
                    if ($menu) {
                        $layout->model = $menu['model'] ?? "";
                        $layout->model_slug = $menu['slug'] ?? "";
                        $layout->model_id = $menu['id'] ?? "";
                        $layout->model_title = $menu['title'] ?? "";
                        $layout->link = $menu['link'] ?? "";
                    }
                }

                if ($layout->type == 'slider') {
                    $strategy = SliderStrategyFactory::getStrategy($data["select_item"]);
                    $slider = $strategy->handle($id);
                    if ($slider) {
                        $layout->model = $slider['model'] ?? "";
                        $layout->model_slug = $slider['slug'] ?? "";
                        $layout->model_id = $slider['id'] ?? "";
                        $layout->model_title = $slider['title'] ?? "";
                        $layout->link = $slider['link'] ?? "";
                    }
                }
            }
            return $layout;
        }
        return null;
    }

    public function prepareLayouts ( $layouts , $limit = null)
    {
        if($sliders = $layouts){
            $sliders = $sliders->map(function($value, $key){
                $limit = $value->count_list;
                $data = $value->data;
                if (
                    $value->is_active &&
                    (
                        $value->release_type === EnumLayoutReleaseType::RELEASE || 
                        (
                            $value->release_type === 'date' && 
                            $value->end_date_release >= now() && 
                            $value->start_date_release <= now()
                        )
                    )
                ) {
                    if($value->end_date_release){
                        $date = Carbon::parse($value->end_date_release);
                        $value->year = $date->year;
                        $value->month = $date->month;
                        $value->day = $date->day;
                        $value->hour = $date->hour;
                        $value->minute = $date->minute;
                        $value->second = $date->second;
                    }
                    if(isset($data["select_item"]) && isset($data["select_id"])){
                        // Id Or the Value
                        $id = $data["select_id"];

                        if ($value->type == 'product') {
                            $strategy = ProductStrategyFactory::getStrategy($data["select_item"]);
                            $products = $strategy->handle($id, $limit ?: 10);
                            if ($products) {
                                $value->products = $products;
                            }
                        }

                        if ($value->type == 'article') {
                            $strategy = ArticleStrategyFactory::getStrategy($data["select_item"]);
                            $articles = $strategy->handle($id, $limit ?: 10);
                            if ($articles) {
                                $value->articles = $articles;
                            }
                        }

                        if ($value->type == 'menu') {
                            $strategy = MenuStrategyFactory::getStrategy($data["select_item"]);
                            $menu = $strategy->handle($id);
                            if ($menu) {
                                $value->model = $menu['model'] ?? "";
                                $value->model_slug = $menu['slug'] ?? "";
                                $value->model_id = $menu['id'] ?? "";
                                $value->model_title = $menu['title'] ?? "";
                                $value->link = $menu['link'] ?? "";
                                if($value->children()?->count()){
                                    $this->prepareLayouts($value->children);
                                }
                            }
                        }

                        if ($value->type == 'slider') {
                            $strategy = SliderStrategyFactory::getStrategy($data["select_item"]);
                            $slider = $strategy->handle($id);
                            if ($slider) {
                                $value->model = $slider['model'] ?? "";
                                $value->model_slug = $slider['slug'] ?? "";
                                $value->model_id = $slider['id'] ?? "";
                                $value->model_title = $slider['title'] ?? "";
                                $value->link = $slider['link'] ?? "";
                                if($value->children()?->count()){
                                    $this->prepareLayouts($value->children);
                                }
                            }
                        }
                    }
                    return $value;
                }
                return null;
            })->filter();
            // if(!empty($limit) || !empty($layoutGroup->count_list))
            //     $sliders=$sliders->take($limit ?: $layoutGroup->count_list);
        }
        return $sliders ?: [];
    }
}
