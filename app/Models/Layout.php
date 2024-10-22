<?php

namespace App\Models;

use App\Enums\EnumLayoutReleaseType;
use App\Factories\LayoutFactories\Articles\ArticleStrategyFactory;
use App\Factories\LayoutFactories\Menu\MenuStrategyFactory;
use App\Factories\LayoutFactories\Products\ProductStrategyFactory;
use App\Factories\LayoutFactories\Sliders\SliderStrategyFactory;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Kalnoy\Nestedset\NodeTrait;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Layout extends Model implements HasMedia
{
    use HasFactory, NodeTrait, InteractsWithMedia;

    /**
    * The attributes that are mass assignable.
    *
    * @var array<int, string>
    */
    protected $fillable = [
        'layout_group_id',
        'type',
        'data',
        'title',
        'description',
        'button_title',
        'release_type',
        'start_date_release',
        'end_date_release',
        'priority',
        'icon',
        'tag',
        'lang',
        'count_list',
        'is_active',
        'parent_id',
    ];

    /**
    * The attributes that should be cast.
    *
    * @var array
    */
    protected $casts = [
        'data' => 'json',
    ];

    /**
     * Get the layoutGroup that owns the Layout
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function layoutGroup(): BelongsTo
    {
        return $this->belongsTo(LayoutGroup::class);
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this
            ->addMediaConversion('mainImage')
            ->nonQueued();
    }
    
    /**
     * Active Scope
     */
    public function scopeActive($query)
    {
        $query->where('is_active', 1);
    }
    
    /**
     * Active Scope
     */
    public function scopeLang($query, $lang = null)
    {
        $query->where('lang', $lang ?: config('app.locale'));
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
