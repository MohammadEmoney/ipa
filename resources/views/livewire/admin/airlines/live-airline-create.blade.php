<div class="container-fluid">
    <livewire:admin.components.live-breadcrumb :items="[['title' => __('global.airlines'), 'route' => route('admin.airlines.index')], ['title' => $title]]" />
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
                                                        <label for="exampleInputtext1" class="form-label">{{ __('global.title_en') }}
                                                            *</label>
                                                        <input type="text" class="form-control"
                                                            wire:model.blur="data.title_en" id="exampleInputtext1"
                                                            aria-describedby="textHelp" placeholder="{{ __('global.title_en') }}">
                                                        <div>
                                                            @error('data.title_en')
                                                                {{ $message }}
                                                            @enderror
                                                        </div>
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
    @include('admin.components.ckeditor', ['selectorIds' => [
        'description' => 'description' 
    ]])
    <script>
        var dir = "{{ App::isLocale('en') ? "ltr" : "rtl" }}";
        function livewireSelect2(component, event) {
            @this.set(component, $(event).val())
        }
    </script>
@endpush