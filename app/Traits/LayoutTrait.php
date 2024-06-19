<?php

namespace App\Traits;

use App\Factories\LayoutFactories\Articles\ArticleStrategyFactory;
use App\Factories\LayoutFactories\Menu\MenuStrategyFactory;
use App\Factories\LayoutFactories\Products\ProductStrategyFactory;
use App\Factories\LayoutFactories\Sliders\SliderStrategyFactory;
use App\Models\Article;
use App\Models\Category;
use App\Models\LayoutGroup;
use App\Models\Page;
use App\Models\Product;
use App\Models\Tag;
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
        if($sliders = $layoutGroup?->layouts){
            $sliders = $sliders->map(function($value, $key){
                $data = $value->data;
                $limit = $value->count_list;
                if($value->end_date_release === null || $value->end_date_release >= now()){
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
                            }
                        }

                       /*  if($value->type == 'product'){
                             switch ($data["select_item"]) {
                                 case 'select':
                                     $product = $this->getSelectedProduct($id);
                                     if ($product) {
                                         $value->product = $product;
                                     }
                                 case 'newest':
                                     $products = $this->getLatestProducts();

                                     if ($products) {
                                         $value->products = $products;
                                     }
                                 case 'oldest':
                                     $products = $this->getOldestProducts();

                                     if ($products) {
                                         $value->products = $products;
                                     }
                                 case 'most_visited':
                                     $products = $this->getMostVisitedProducts();

                                     if ($products) {
                                         $value->products = $products;
                                     }
                                 case 'most_popular':
                                     $products = $this->getMostPopularProducts();

                                     if ($products) {
                                         $value->products = $products;
                                     }
                                 case 'random':
                                     $products = $this->getRandomProducts();

                                     if ($products) {
                                         $value->products = $products;
                                     }
                                 case 'bestselling':
                                     $products = $this->getBestSellingProduct();

                                     if ($products) {
                                         $value->products = $products;
                                     }
                                 case 'category':
                                     $products = $this->getCategoryProduct($id);

                                     if ($products) {
                                         $value->products = $products;
                                     }
                                 case 'tag':
                                     $products = $this->getTagProduct($id);

                                     if ($products) {
                                         $value->products = $products;
                                     }
                                 case 'discount':
                                     $products = $this->getDiscountProduct();

                                     if ($products) {
                                         $value->products = $products;
                                     }
                                 default:

                                     break;
                             }
                         }

                         if($value->type == 'menu'){
                             switch ($data["select_item"]) {
                                 case 'page':
                                     $page = $this->getPage($id);

                                     if ($page) {
                                         $value->page_slug = $page->slug;
                                         $value->page_id = $page->id;
                                         $value->page_title = $page->title;
                                         $value->link = router('vitrin.pages.show', ['page' => $page->slug]);
                                     }
                                     break;
                                 case 'none':
                                     $value->link = "#";
                                     break;
                                 case 'static':
                                     $value->link = $id;
                                     break;
                                 case 'category':
                                     $category = $this->getCategoryMenu($id);
                                     if($category){
                                         $value->categoryChildren = $category->children;
                                         $value->category_title = $category->title;
                                         $value->category_id = $category->id;
                                         $value->link = router('vitrin.categories.show', $category->id);
                                     }
                                     break;
                                 case 'tag':
                                     $tag = $this->getTagProductsMenu($id);
                                     if($tag){
                                         $value->products = $tag->products;
                                         $value->tag_title = $tag->title;
                                         $value->tag_id = $tag->id;
                                         // $value->link = router('vitrin.categories.show', $tag->id);
                                         $value->link = "#";
                                     }
                                     break;

                                 default:
                                     # code...
                                     break;
                             }
                         }

                         if($value->type == 'article'){

                         }

                         if ($data["select_item"] === "category" && $value->type == 'slider') {
                             $category = Category::find($data["select_id"]);

                             if ($category) {
                                 $value->category_slug = $category->slug;
                                 $value->category_id = $category->id;
                                 $value->category_title = $category->title;
                                 $value->link = router('vitrin.categories.show', ['category' => $category->id]);
                             }
                         }elseif($data["select_item"] === "category" && $value->type == 'article'){
                             $articles = Article::whereHas('categories', function($query) use ($data){
                                 $query->where('id', $data['selected_id']);
                             })->get();
                             $value->articles = $articles;
                         } elseif ($data["select_item"] === "page") {
                             $page = Page::find($data["select_id"]);

                             if ($page) {
                                 $value->page_slug = $page->slug;
                                 $value->page_id = $page->id;
                                 $value->page_title = $page->title;
                                 $value->link = router('vitrin.pages.show', ['page' => $page->slug]);
                             }
                         } elseif ($data["select_item"] === "select") {
                             $product = Product::find($data["select_id"]);

                             if ($product) {
                                 $value->product = $product;
                             }
                         } elseif ($data["select_item"] === "newest") {
                             $products = $this->getProducts();

                             if ($products) {
                                 $value->products = $products;
                             }
                         } elseif ($data["select_item"] === "oldest") {
                             $products = Product::oldest()->take(10)->get();

                             if ($products) {
                                 $value->products = $products;
                             }
                         } elseif ($data["select_item"] === "most_visited") {
                             $products = Product::orderBy('views', 'DESC')->take(10)->get();

                             if ($products) {
                                 $value->products = $products;
                             }
                         } elseif ($data["select_item"] === "most_popular") {
                             $products = Product::withCount('wishlists')->orderBy('wishlists_count', 'DESC')->take(10)->get();

                             if ($products) {
                                 $value->products = $products;
                             }
                         } elseif ($data["select_item"] === "random") {
                             $products = Product::inRandomOrder()->take(10)->get();

                             if ($products) {
                                 $value->products = $products;
                             }
                         } elseif ($data["select_item"] === "bestselling") {
                             $products = Product::withCount(['orderItems' => function($query){
                                 $query->where('status_id', '!=', 1);
                             }])->orderBy('order_items_count', 'DESC')->take(10)->get();

                             if ($products) {
                                 $value->products = $products;
                             }
                         } elseif ($data["select_item"] === "category" && $value->type == 'product') {
                             $products = Product::whereRelation('categories', 'id',  $data["select_id"])->latest()->take(10)->get();

                             if ($products) {
                                 $value->products = $products;
                             }
                         } elseif ($data["select_item"] === "tag") {
                             $products = Product::whereRelation('tags', 'id',  $data["select_id"])->latest()->take(10)->get();

                             if ($products) {
                                 $value->products = $products;
                             }
                         } elseif ($data["select_item"] === "discount") {
                             $products = Product::selectRaw('*, CASE
                                 WHEN discount_type = "prices" THEN (discount_value / sales_price) * 100
                                 WHEN discount_type = "percent" THEN discount_value
                                 END as discount_amount')
                                 ->orderBy('discount_amount', 'DESC')
                                 ->take(10)->get();

                             if ($products) {
                                 $value->products = $products;
                             }
                         } elseif ($data["select_item"] === "tag") {
                             $products = Product::whereHas('tag', function($query) use ($data){
                                 $query->where('id', $data['select_id']);
                             })->take(10)->get();

                             if ($products) {
                                 $value->products = $products;
                             }
                         }elseif ($data["select_item"] === "static") {
                             $value->link = $data["select_id"];
                         }elseif ($data["select_item"] === "none") {
                             $value->link = "#";
                         }else{
                             $value->link = "#";
                         }*/
                    }
                }
                return $value;
            });
            if(!empty($limit) || !empty($layoutGroup->count_list))
                $sliders=$sliders->take($limit ?: $layoutGroup->count_list);
        }
        return $sliders ?: collect([]);
    }

    public function prepareLayouts ( $layouts , $limit = null)
    {
        if($sliders = $layouts){
            $sliders = $sliders->map(function($value, $key){
                $limit = $value->count_list;
                $data = $value->data;
                if($value->end_date_release === null || $value->end_date_release >= now()){
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
                }
                return $value;
            });
            if(!empty($limit) || !empty($layoutGroup->count_list))
                $sliders=$sliders->take($limit ?: $layoutGroup->count_list);
        }
        return $sliders ?: [];
    }

    // products

    public function getLatestProducts($count = 10)
    {
        return Product::latest()->take($count)->get();
    }

    public function getOldestProducts($count = 10)
    {
        return Product::oldest()->take($count)->get();
    }

    public function getMostVisitedProducts($count = 10)
    {
        return Product::orderBy('views', 'DESC')->take($count)->get();
    }

    public function getMostPopularProducts($count = 10)
    {
        return Product::withCount('wishlists')->orderBy('wishlists_count', 'DESC')->take($count)->get();
    }

    public function getRandomProducts($count = 10)
    {
        return Product::inRandomOrder()->take($count)->get();
    }

    public function getBestSellingProduct($count = 10)
    {
        return Product::withCount(['orderItems' => function($query){
            $query->where('status_id', '!=', 1);
        }])->orderBy('order_items_count', 'DESC')->take($count)->get();
    }

    public function getCategoryProduct($id, $count = 10)
    {
        return Product::whereRelation('categories', 'id',  $id)->latest()->take($count)->get();
    }

    public function getTagProduct($id, $count = 10)
    {
        return Product::whereRelation('tags', 'id',  $id)->latest()->take($count)->get();
    }

    public function getDiscountProduct($count = 10)
    {
        return Product::selectRaw('*, CASE
            WHEN discount_type = "prices" THEN (discount_value / sales_price) * 100
            WHEN discount_type = "percent" THEN discount_value
            END as discount_amount')
            ->orderBy('discount_amount', 'DESC')
            ->take($count)->get();
    }

    public function getSelectedProduct($id)
    {
        return Product::find($id);
    }

    public function getPage($id)
    {
        return Page::find($id);
    }

    public function getCategoryMenu($id)
    {
        return Category::where('id', $id)->with('children')->first();
    }


    public function getTagProductsMenu($id)
    {
        return Tag::where('id', $id)->with('products')->first();
    }


}
