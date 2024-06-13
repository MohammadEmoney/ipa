<div class="container-fluid">
    <livewire:admin.components.live-breadcrumb :items="[['title' => __('global.posts'), 'route' => route('admin.posts.index')], ['title' => $title]]" />
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
                                                        <label for="exampleInputtext1" class="form-label">{{ __('global.slug') }}
                                                            *</label>
                                                        <input type="text" class="form-control"
                                                            wire:model.live.debounce.800ms="data.slug" id="exampleInputtext1"
                                                            aria-describedby="textHelp" placeholder="{{ __('global.slug') }}">
                                                        <div>
                                                            @error('data.slug')
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
                                                            @foreach ($langs as $key => $value)
                                                                <option value="{{ $key }}">{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="" wire:ignore>
                                                        <label for="exampleInputtext1" class="form-label">{{ __('global.main_category') }}</label>
                                                        <select id="main_categories" class="form-control select2" )
                                                            {{-- onchange="livewireSelect2('data.category_id', this)" --}}
                                                            >
                                                            <option value="">{{ __('global.select_item') }}</option>
                                                            @foreach ($categories as $key => $value)
                                                                <option value="{{ $value->id }}">{{ $value->title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div>
                                                        @error('data.category_id')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div class="" wire:ignore>
                                                        <label for="exampleInputtext1" class="form-label">{{ __('global.category') }}</label>
                                                        <select id="categories" class="form-control select2"
                                                            {{-- onchange="livewireSelect2Multi('data.categories', this)"  --}}
                                                            multiple>
                                                            <option value="">{{ __('global.select_item') }}</option>
                                                            @foreach ($categories as $key => $value)
                                                                <option value="{{ $value->id }}">{{ $value->title }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div>
                                                        @error('data.categories')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
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
                                            </div>

                                            <div class="row">
                                                <div class="col-md-12 mb-3" wire:ignore>
                                                    <label for="summary" class="form-label">{{ __('global.summary') }}</label>
                                                    <textarea id="summary" class="form-control" cols="30" rows="10" wire:model="data.summary">{{ $this->data['summary'] ?? null }}</textarea>
                                                </div>
                                                <div>
                                                    @error('data.summary')
                                                        {{ $message }}
                                                    @enderror
                                                </div>
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
                                                <div class="col-md-6">
                                                    <button type="submit"
                                                        class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-0">
                                                        <span class="spinner-border spinner-border-sm"
                                                            wire:loading></span> {{ __('global.edit') }}
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
        $(document).ready(function () {
            function livewireSelect2(component, event) {
                @this.set(component, $(event).val())
            }

            var data = [];
            var categoryIds = {!! json_encode($data['categories']?? []) !!};
            $.each(categoryIds, function (key, value) {
                data.push(value);
            });

            $('#categories').val(data).trigger('change');
            $('#main_categories').val("{{ $data['category_id'] }}").trigger('change');
        });

        // function livewireSelect2Multi(component, event) {
        //     var selectedValues = [];
        //     $(event).find('option:selected').each(function () {
        //         selectedValues.push($(this).val());
        //     });
        //     @this.set(component, selectedValues)
        // }

    

    </script>
@endpush

@script
<script>
    $(document).ready(function () {
        $('#categories').on('change', function(){
            let data = $(this).val();
            console.log(data);
            $wire.set('data.categories', data);
        });
        $('#main_categories').on('change', function(){
            let data = $(this).val();
            console.log(data);
            $wire.set('data.category_id', data);
        });
    });

    
</script>
@endscript