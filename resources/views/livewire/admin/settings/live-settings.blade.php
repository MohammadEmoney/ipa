<div class="container-fluid">
    <livewire:admin.components.live-breadcrumb :items="[['title' => __('global.categories'), 'route' => route('admin.categories.index')], ['title' => $title]]" />
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
                                                            <label for="email" class="form-label">{{ __('global.email') }}
                                                                *</label>
                                                            <input type="email" class="form-control"
                                                                wire:model.live.debounce.800ms="data.email" id="email"
                                                                aria-describedby="textHelp" placeholder="{{ __('global.email') }}">
                                                            <div>
                                                                @error('data.email')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="phone" class="form-label">{{ __('global.phone_number') }}
                                                                *</label>
                                                            <input type="text" class="form-control"
                                                                wire:model.live.debounce.800ms="data.phone" id="phone"
                                                                aria-describedby="textHelp" placeholder="{{ __('global.phone_number') }}">
                                                            <div>
                                                                @error('data.phone')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="second_phone" class="form-label">{{ __('global.second_phone_number') }}
                                                                *</label>
                                                            <input type="text" class="form-control"
                                                                wire:model.live.debounce.800ms="data.second_phone" id="second_phone"
                                                                aria-describedby="textHelp" placeholder="{{ __('global.second_phone_number') }}">
                                                            <div>
                                                                @error('data.second_phone')
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
                                                        <div class="">
                                                            <label for="exampleInputtext1" class="form-label">{{ __('global.timezone') }}</label>
                                                            <select id="categories" class="form-control">
                                                                <option value="">{{ __('global.select_item') }}</option>
                                                                @foreach (\App\Enums\EnumTimeZone::getTranslatedAll() as  $value)
                                                                    <option value="{{ $value }}"
                                                                        @selected($value==($data['timezone']??''))>
                                                                        {{ $value }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div>
                                                            @error('data.timezone')
                                                                {{ $message }}
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
    
                                                <div class="row">
                                                    <div class="row justify-content-center">
                                                        <div class="col-md-12">
                                                            <div class="mb-3">
                                                                <label for="formFile" class="form-label">{{ __('global.logo') }}</label>
                                                                <input class="form-control"
                                                                    wire:model.live="data.logo"
                                                                    type="file" id="formFile">
                                                                <div>
                                                                    @error('data.logo')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @if (isset($data['logo']))
                                                            @if(method_exists($data['logo'], 'temporaryUrl'))
                                                                <div class="col-md-6 px-5 mb-3">
                                                                    <img src="{{ $data['logo']->temporaryUrl() }}" class="w-100">
                                                                </div>
                                                            @else
                                                                <div class="col-md-6 px-5 mb-3">
                                                                    <img src="{{ $data['logo']->getUrl() }}" class="w-100">
                                                                    <span class="fs-4 position-absolute text-danger cursor-pointer" wire:click="deleteMedia({{ $data['mainImage']->id }}, 'mainImage')"><i class="ti ti-trash"></i></span>
                                                                </div>
                                                            @endif
                                                        @endif
                                                    </div>
                                                </div>
    
                                                <div class="row">     
                                                    <div class="col-md-12 mb-3" wire:ignore>
                                                        <label for="address" class="form-label">{{ __('global.address') }}</label>
                                                        <textarea id="address" class="form-control" cols="30" rows="10" wire:model.live="data.address"></textarea>
                                                    </div>
                                                    <div>
                                                        @error('data.address')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="row">     
                                                    <div class="col-md-12 mb-3" wire:ignore>
                                                        <label for="about_us" class="form-label">{{ __('global.about_us') }}</label>
                                                        <textarea id="about_us" class="form-control" cols="30" rows="10" wire:model.live="data.about_us"></textarea>
                                                    </div>
                                                    <div>
                                                        @error('data.about_us')
                                                            {{ $message }}
                                                        @enderror
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
    @include('admin.components.ckeditor', ['selectorId' => 'about_us'])
@endpush