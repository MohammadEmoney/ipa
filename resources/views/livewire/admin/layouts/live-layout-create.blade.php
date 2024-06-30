<div class="container-fluid">
    <livewire:admin.components.live-breadcrumb :items="[['title' => __('global.layouts'), 'route' => route('admin.layouts.index', ['layoutGroup' => $layoutGroup->id])], ['title' => $title]]" />
    <div class="card">
        <div class="card-body">
            <h3 class="">{{ $title }}</h3>
            <div>
                <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
                    data-sidebar-position="fixed" data-header-position="fixed">
                    <div class="d-flex align-items-center justify-content-center w-100">
                        <div class="row justify-content-center w-100">
                            <div class="col-md-12">
                                <div class="card mb-3 mt-3">
                                    <div class="card-body">

                                        {{-- @if (count($errors->messages()))
                                            <div class="alert alert-warning" role="alert">
                                                لطفا گزینه های ستاره دار را تکمیل نمایید تا اطلاعات شما ثبت
                                                گردد.
                                            </div>
                                        @endif --}}
                                        <form wire:submit.prevent="submit" autocomplete="off">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="exampleInputtext1" class="form-label">{{ __('global.title') }}
                                                            *</label>
                                                        <input type="text" class="form-control"
                                                            wire:model.blur="data.title" id="exampleInputtext1"
                                                            aria-describedby="textHelp" placeholder="{{ __('global.title') }}">
                                                        <div>
                                                            @error('data.title')
                                                                {{ $message }}
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="exampleInputtext1" class="form-label">{{ __('global.count_list') }}
                                                            *</label>
                                                        <input type="number" class="form-control" min="0"
                                                            wire:model.blur="data.count_list" id="exampleInputtext1"
                                                            aria-describedby="textHelp" placeholder="{{ __('global.count_list') }}">
                                                        <div>
                                                            @error('data.count_list')
                                                                {{ $message }}
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <label for="exampleInputtext1" class="form-label">{{ __('global.lang') }}</label>
                                                    <select id="langs" class="form-control"
                                                        wire:model.live="data.lang">
                                                        <option value="">{{ __('global.select_item') }}</option>
                                                        @foreach (\App\Enums\EnumLanguages::getTranslatedAll() as $key => $value)
                                                            <option value="{{ $key }}">{{ $value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <label for="exampleInputtext1" class="form-label">{{ __('global.tag') }}</label>
                                                    <select id="tags" class="form-control"
                                                        wire:model.live="data.tag">
                                                        <option value="">{{ __('global.select_item') }}</option>
                                                        @foreach (\App\Enums\EnumLayoutGroupTags::getTranslatedAll() as $key => $value)
                                                            <option value="{{ $key }}">{{ $value }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="row justify-content-center">
                                                <div class="col-md-12">
                                                    <div class="mb-3">
                                                        <label for="formFile" class="form-label">{{ __('global.image') }}
                                                            *</label>
                                                        <input class="form-control"
                                                            wire:model.live="data.mainImage"
                                                            type="file" id="formFile">
                                                    </div>
                                                </div>
                                                @if (isset($data['mainImage']))
                                                    @if(method_exists($data['mainImage'], 'temporaryUrl'))
                                                        <div class="col-md-6 px-5 mb-3">
                                                            <img src="{{ $data['mainImage']->temporaryUrl() }}" class="w-100">
                                                        </div>
                                                    @else
                                                        <div class="col-md-6 px-5 mb-3">
                                                            <img src="{{ $data['mainImage']->getUrl() }}" class="w-100">
                                                            <span class="fs-4 position-absolute text-danger cursor-pointer" wire:click="deleteMedia({{ $data['mainImage']->id }}, 'mainImage')"><i class="ti ti-trash"></i></span>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="exampleInputtext1" class="form-label">{{ __('global.icon') }}</label>
                                                        <input type="text" class="form-control"
                                                            wire:model.blur="data.icon" id="exampleInputtext1"
                                                            aria-describedby="textHelp" placeholder="{{ __('global.icon') }}">
                                                        <div>
                                                            @error('data.icon')
                                                                {{ $message }}
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
    
                                                <div class="col-md-6 mb-3">
                                                    <div class="" wire:ignore>
                                                        <label for="exampleInputtext1" class="form-label">{{ __('global.parent_layout') }}</label>
                                                        <select id="parent_layout" class="form-control select2"
                                                            onchange="livewireSelect2('data.parent_id', this)">
                                                            <option value="">{{ __('global.select_item') }}</option>
                                                            @foreach ($layouts as $key => $value)
                                                                <option value="{{ $value->id }}">{{ $value->title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div>
                                                        @error('data.parent_id')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 mb-3" wire:ignore>
                                                    <label for="description" class="form-label">{{ __('global.description') }}</label>
                                                    <textarea id="description" class="form-control" cols="30" rows="10" wire:model="data.description">{{ $this->data['description'] ?? null }}</textarea>
                                                </div>
                                                <div>
                                                    @error('data.description')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3" wire:ignore>
                                                        <label class="form-label">{{ __('global.layout_type') }}</label>
                                                        <select class="select2Single form-control"
                                                                onchange="livewireSelect2('data.type', this)">
                                                            <option></option>
                                                            @foreach (\App\Enums\EnumLayoutType::getTranslatedAll() as $key => $value)
                                                                <option
                                                                    value="{{ $key }}" {{($key==($data['type']??''))?'selected':''}}>{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                @if(in_array(($data['type']??''), \App\Enums\EnumLayoutType::Except(['menu', 'slider'])))
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3" wire:ignore>
                                                            <label class="form-label" for="filters">{{ __('global.display_filter') }} </label>
                                                            <select class="select2Single form-control" id="filters"
                                                                    onchange="livewireSelect2('data.filter', this)">
                                                                <option></option>
                                                                @foreach (\App\Enums\EnumLayoutFilter::getTranslatedAll() as $key => $value)
                                                                    <option
                                                                        value="{{ $key }}" {{($key==($data['filter']??''))?'selected':''}}>{{ $value }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
            
                                                    @if(($data['filter'] ?? '')==\App\Enums\EnumLayoutFilter::SELECT)
                                                        <div class="col-md-4" id="post">
                                                            <div class="form-group mb-3" wire:ignore>
                                                                <label class="form-label" for="featured">{{ __('global.news') }}</label>
                                                                <select class="select2Single form-control"
                                                                        onchange="livewireSelect2('data.post', this)">
                                                                    <option></option>
                                                                    @foreach ($posts as $post)
                                                                        <option
                                                                            value="{{ $post->id }}" {{($post->id==($data['post']??0))?'selected':''}}>{{ $post->title }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    @elseif(($data['filter'] ?? '')==\App\Enums\EnumLayoutFilter::CATEGORY)
                                                        <div class="col-md-4" id="category">
                                                            <div class="form-group mb-3" wire:ignore>
                                                                <label class="form-label" for="featured">{{ __('global.category') }}</label>
                                                                <select class="select2Single form-control"
                                                                        onchange="livewireSelect2('data.category', this)">
                                                                    <option></option>
                                                                    @foreach ($categories as  $category)
                                                                        <option
                                                                            value="{{ $category->id }}" {{($category->id==($data['category']??''))?'selected':''}}>{{ $category->title }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @elseif(in_array(($data['type']??''), [\App\Enums\EnumLayoutType::MENU,\App\Enums\EnumLayoutType::SLIDER]))
            
                                                    <div class="col-md-4" id="link_type">
                                                        <div class="form-group mb-3">
                                                            <label class="form-label" for="featured">{{ __('global.link_type') }}</label>
                                                            <select class="select2Single form-control"
                                                                    onchange="livewireSelect2('data.link_type', this)">
                                                                <option></option>
                                                                @foreach (\App\Enums\EnumLayoutLinkType::getTranslatedAll() as $key => $value)
                                                                    <option
                                                                        value="{{ $key }}" {{($key==($data['link_type']??''))?'selected':''}}>{{ $value }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
            
                                                    @if($data['link_type']==\App\Enums\EnumLayoutLinkType::STATIC)
                                                        <div class="col-md-6" id="static">
                                                            <div class="form-group mb-3">
                                                                <label class="form-label">{{ __('messages.select_link_address') }}</label>
                                                                <input type="text"
                                                                       class="form-control form-control-sm text-right ltr"
                                                                       maxlength="255"
                                                                       wire:model.defer="data.layoutable_value"
                                                                       placeholder="{{ __('messages.select_link_address') }}">
                                                            </div>
                                                        </div>
                                                    @elseif($data['link_type']==\App\Enums\EnumLayoutLinkType::PAGE)
                                                        <div class="col-md-4" id="page">
                                                            <div class="form-group mb-3" wire:ignore>
                                                                <label class="form-label" for="featured">{{ __('global.page') }}</label>
                                                                <select class="select2Single form-control"
                                                                        onchange="livewireSelect2('data.layoutable_value', this)">
                                                                    <option></option>
                                                                    @foreach ($pages as  $page)
                                                                        <option
                                                                            value="{{ $page->id }}" {{($page->id==($data['layoutable_value']??0))?'selected':''}}>{{ $page->title }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    @elseif($data['link_type']==\App\Enums\EnumLayoutLinkType::CATEGORY)
                                                        <div class="col-md-4" id="category">
                                                            <div class="form-group mb-3" wire:ignore>
                                                                <label class="form-label" for="featured">{{ __('global.category') }}</label>
                                                                <select class="select2Single form-control"
                                                                        onchange="livewireSelect2('data.layoutable_value', this)">
                                                                    <option></option>
                                                                    @foreach ($categories as  $category)
                                                                        <option
                                                                            value="{{ $category->id }}" {{($category->id==($data['layoutable_value']??0))?'selected':''}}>{{ $category->title }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    @elseif($data['link_type']==\App\Enums\EnumLayoutLinkType::TAG)
                                                        <div class="col-md-4" id="tag">
                                                            <div class="form-group mb-3" wire:ignore>
                                                                <label class="form-label" for="featured">{{ __('global.tag') }}</label>
                                                                <select class="select2Single form-control"
                                                                        onchange="livewireSelect2('data.layoutable_value', this)">
                                                                    <option></option>
                                                                    @foreach ($tags as $tag)
                                                                        <option
                                                                            value="{{ $tag->id }}" {{($tag->id==($data['layoutable_value']??0))?'selected':''}}>{{ $tag->title . " ({$tag->type}) " }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endif
                                            </div>
            
                                            <div class="row" id="releas">
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3" wire:ignore>
                                                        <label class="form-label" for="featured">{{ __('global.release_type') }}</label>
                                                        <select class="select2Single form-control"
                                                                onchange="livewireSelect2('data.release_type', this)">
                                                            <option></option>
                                                            @foreach (\App\Enums\EnumLayoutReleaseType::getTranslatedAll() as $key => $value)
                                                                <option
                                                                    value="{{ $key }}" {{($key==($data['release_type']??''))?'selected':''}}>{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
            
                                                @if($data['release_type']==\App\Enums\EnumLayoutReleaseType::DATE)
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="form-label">{{ __('global.start_date') }}</label>
                                                            <input type="text"
                                                                   class="form-control form-control-sm text-center ltr datetimepicker"
                                                                   maxlength="16"
                                                                   wire:model.defer="data.start_date_release"
                                                                   placeholder="----/--/-- --:--">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="form-label">{{ __('global.end_date') }}</label>
                                                            <input type="text"
                                                                   class="form-control form-control-sm text-center ltr persianDatePicker"
                                                                   maxlength="16"
                                                                   wire:model.defer="data.end_date_release"
                                                                   placeholder="----/--/-- --:--">
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
            
                                            <div class="row">
                                                <div class="col-12 col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">{{ __('global.display_priority') }}</label>
                                                        <input type="number"
                                                               class="form-control form-control-sm text-center"
                                                               min="0" max="255" wire:model.defer="data.priority"
                                                               placeholder="{{ __('global.priority') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">{{ __('global.count_list') }}</label>
                                                        <input type="number" class="form-control text-center form-control-sm" maxlength="255"
                                                               wire:model.defer="data.count_list" min="0"
                                                               placeholder="{{ __('global.count_list') }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label class="form-label">{{ __('global.is_active') }}</label>
                                                        <div class="form-check form-switch d-flex ps-0 {{ app()->getLocale() === "en" ? "" : "flex-row-reverse justify-content-end" }}">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">{{ __('global.inactive') }}</label>
                                                            <input class="form-check-input mx-2" type="checkbox" role="switch" id="flexSwitchCheckDefault" wire:model.defer="data.is_active">
                                                            <label class="form-check-label" for="flexSwitchCheckDefault">{{ __('global.active') }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <button type="submit"
                                                        class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-0">
                                                        <span class="spinner-border spinner-border-sm"
                                                            wire:loading></span> {{ __('global.submit') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
    @include('admin.components.ckeditor')
    <script>
        var dir = "{{ App::isLocale('en') ? "ltr" : "rtl" }}";
        function livewireSelect2(component, event) {
            @this.set(component, $(event).val())
        }
    </script>
@endpush
@script
<script>
    $(document).ready(function () {
        $('#parent_layout').on('change', function(){
            let data = $(this).val();
            console.log(data);
            $wire.set('data.parent_id', data);
        });
    });
</script>
@endscript