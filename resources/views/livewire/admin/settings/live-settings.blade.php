<div class="container-fluid">
    <livewire:admin.components.live-breadcrumb :items="[['title' => __('global.categories'), 'route' => route('admin.categories.index')], ['title' => $title]]" />
        <div class="card">
            <div class="card-body">
                <h3 class="">{{ $title }}</h3>
                {{-- <div>
                    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
                        data-sidebar-position="fixed" data-header-position="fixed">
                        <div class="d-flex align-items-center justify-content-center w-100">
                            
                            
                        </div>
                    </div>
                </div> --}}
                <div class="row justify-content-center w-100">
                    <div class="col-md-12">
                            <!-- Ends -->
                            <!-- Section -->
                            <section class="bg-light py-5">
                                <div class="container">
                                <!-- Row -->
                                <div class="row">
                                    <!-- Column -->
                                    <div class="col">
                                        <!-- Tabs Links -->
                                        <ul class="nav nav-pills" role="tablist" wire:ignore>
                                            <!-- Tabs Links --> <!-- querySelector class // *** mouse-enter1 *** --> 
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active mouse-enter1" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">{{ __('global.general') }}</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link mouse-enter1" id="pills-profile-tab" data-bs-toggle="pill" data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile" aria-selected="false">{{ __('global.financials') }}</button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link mouse-enter1" id="pills-authentication-tab" data-bs-toggle="pill" data-bs-target="#pills-authentication" type="button" role="tab" aria-controls="pills-authentication" aria-selected="false">{{ __('global.authentication') }}</button>
                                            </li>
                                        </ul>
                                        <!-- Tabs Content -->
                                        <div class="tab-content bg-white p-4">
                                            <div class="tab-pane fade show active" wire:ignore.self id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
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
                                                                        <div class="col-md-6">
                                                                            <div class="mb-3">
                                                                                <label for="formFile" class="form-label">{{ __('global.logo') }}</label>
                                                                                <input class="form-control" wire:model.live="data.logo" type="file" id="formFile">
                                                                                <div>
                                                                                    @error('data.logo')
                                                                                        {{ $message }}
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            @if (isset($data['logo']) && !empty($data['logo']))
                                                                                @if(method_exists($data['logo'], 'temporaryUrl'))
                                                                                    <div class="col-md-12 px-5 mb-3">
                                                                                        <img src="{{ $data['logo']->temporaryUrl() }}" class="w-100">
                                                                                    </div>
                                                                                @else
                                                                                    <div class="col-md-12 px-5 mb-3">
                                                                                        <img src="{{ $data['logo']->getUrl() }}" class="w-100">
                                                                                        <span class="fs-4 position-absolute text-danger cursor-pointer" wire:click="deleteMedia({{ $data['logo']->id }}, 'logo')"><i class="ti ti-trash"></i></span>
                                                                                    </div>
                                                                                @endif
                                                                            @endif
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="mb-3">
                                                                                <label for="formFile" class="form-label">{{ __('global.favicon') }}</label>
                                                                                <input class="form-control" wire:model.live="data.favicon" type="file" id="formFile">
                                                                                <div>
                                                                                    @error('data.favicon')
                                                                                        {{ $message }}
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                            @if (isset($data['favicon']) && !empty($data['favicon']))
                                                                                @if(method_exists($data['favicon'], 'temporaryUrl'))
                                                                                    <div class="col-md-12 px-5 mb-3">
                                                                                        <img src="{{ $data['favicon']->temporaryUrl() }}" style="max-width: 100px">
                                                                                    </div>
                                                                                @else
                                                                                    <div class="col-md-12 px-5 mb-3">
                                                                                        <img src="{{ $data['favicon']->getUrl() }}" style="max-width: 100px">
                                                                                        <span class="fs-4 position-absolute text-danger cursor-pointer" wire:click="deleteMedia({{ $data['favicon']->id }}, 'favicon')"><i class="ti ti-trash"></i></span>
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
                                                                            <textarea id="about_us" class="form-control" cols="30" rows="10" wire:model.live="data.about_us">{!! $data['about_us'] ?? "" !!}</textarea>
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
                                            <div class="tab-pane fade" wire:ignore.self id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                                <div class="row justify-content-center w-100">
                                                    <div class="col-md-12">
                                                        <form wire:submit.prevent="submit">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label for="membership_fee" class="form-label">{{ __('global.membership_fee') }} ({{ __('global.toman') }})
                                                                            *</label>
                                                                        <input type="number" class="form-control numeric num2persian" step="10000" dir="ltr"
                                                                            wire:model.live.debounce.800ms="data.membership_fee" id="membership_fee"
                                                                            aria-describedby="textHelp" placeholder="{{ __('global.membership_fee') }}">
                                                                        <span class="error" id="lbl-membership_fee" wire:ignore></span>
                                                                        <div>
                                                                            @error('data.membership_fee')
                                                                                {{ $message }}
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12 mb-3" wire:ignore>
                                                                    <label for="membership_description" class="form-label">{{ __('global.membership_description') }}</label>
                                                                    <textarea id="membership_description" class="form-control" cols="30" rows="10" wire:model.live="data.membership_description">{!! $data['membership_description'] ?? "" !!}</textarea>
                                                                </div>
                                                                <div>
                                                                    @error('data.membership_description')
                                                                        {{ $message }}
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12 mb-3">
                                                                    <label for="exampleInputtext1" class="form-label">{{ __('global.payment_via') }}</label>
                                                                        <select id="payment_via" class="form-control"
                                                                            wire:model.live="data.payment_via">
                                                                            <option value="">{{ __('global.select_item') }}</option>
                                                                            @foreach ($paymentMethods as $key => $value)
                                                                                <option value="{{ $key }}">{{ $value }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label for="cardNumber" class="form-label">{{ __('global.card_number') }}
                                                                            *</label>
                                                                        <input type="text" class="form-control"
                                                                            wire:model.blur="data.card_number" id="cardNumber" oninput="formatCardNumber(this)"
                                                                            aria-describedby="textHelp" placeholder="xxxx-xxxx-xxxx-xxxx">
                                                                        <div>
                                                                            @error('data.card_number')
                                                                                {{ $message }}
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label for="cardOwner" class="form-label">{{ __('global.card_owner') }}
                                                                            *</label>
                                                                        <input type="text" class="form-control"
                                                                            wire:model.blur="data.card_owner" id="cardOwner"
                                                                            aria-describedby="textHelp" placeholder="{{ __('global.card_owner_name') }}">
                                                                        <div>
                                                                            @error('data.card_owner')
                                                                                {{ $message }}
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label for="exampleInputtext1" class="form-label">{{ __('global.zarinpal_merchant_id') }}
                                                                            *</label>
                                                                        <input type="text" class="form-control"
                                                                            wire:model.blur="data.merchant_id" id="exampleInputtext1"
                                                                            aria-describedby="textHelp" placeholder="xxxxxx-xxxx-xxxxxxx-xxxx-xxxxxx">
                                                                        <div>
                                                                            @error('data.merchant_id')
                                                                                {{ $message }}
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6 mb-3">
                                                                    <label for="exampleInputtext1" class="form-label">{{ __('global.zarinpal_mode') }}</label>
                                                                        <select id="zarinpal_mode" class="form-control"
                                                                            wire:model.live="data.zarinpal_mode">
                                                                            <option value="">{{ __('global.select_item') }}</option>
                                                                            @foreach ($zarinpalModes as $key => $value)
                                                                                <option value="{{ $key }}">{{ $value }}</option>
                                                                            @endforeach
                                                                        </select>
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
                                            <div class="tab-pane fade" wire:ignore.self id="pills-authentication" role="tabpanel" aria-labelledby="pills-authentication-tab">
                                                <div class="row justify-content-center w-100">
                                                    <div class="col-md-12">
                                                        <form wire:submit.prevent="submit">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="mb-3">
                                                                        <label for="formFile" class="form-label">{{ __('global.login_background') }}</label>
                                                                        <input class="form-control" wire:model.live="data.login" type="file" id="formFile">
                                                                        <div>
                                                                            @error('data.login')
                                                                                {{ $message }}
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    @if (isset($data['login']) && !empty($data['login']))
                                                                        @if(method_exists($data['login'], 'temporaryUrl'))
                                                                            <div class="col-md-12 px-5 mb-3">
                                                                                <img src="{{ $data['login']->temporaryUrl() }}" class="w-100">
                                                                            </div>
                                                                        @else
                                                                            <div class="col-md-12 px-5 mb-3">
                                                                                <img src="{{ $data['login']->getUrl() }}" class="w-100">
                                                                                <span class="fs-4 position-absolute text-danger cursor-pointer" wire:click="deleteMedia({{ $data['login']->id }}, 'login')"><i class="ti ti-trash"></i></span>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                </div>
                                                                {{-- <div class="col-md-6">
                                                                    <div class="mb-3">
                                                                        <label for="formFile" class="form-label">{{ __('global.register') }}</label>
                                                                        <input class="form-control" wire:model.live="data.register" type="file" id="formFile">
                                                                        <div>
                                                                            @error('data.register')
                                                                                {{ $message }}
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                    @if (isset($data['register']) && !empty($data['register']))
                                                                        @if(method_exists($data['register'], 'temporaryUrl'))
                                                                            <div class="col-md-12 px-5 mb-3">
                                                                                <img src="{{ $data['register']->temporaryUrl() }}" style="max-width: 100px">
                                                                            </div>
                                                                        @else
                                                                            <div class="col-md-12 px-5 mb-3">
                                                                                <img src="{{ $data['register']->getUrl() }}" style="max-width: 100px">
                                                                                <span class="fs-4 position-absolute text-danger cursor-pointer" wire:click="deleteMedia({{ $data['register']->id }}, 'register')"><i class="ti ti-trash"></i></span>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                </div> --}}
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
                            </section>
                            <!-- Ends -->
                    </div>
                </div>
            </div>
        </div>
</div>
@push('scripts')
    @include('admin.components.ckeditor', ['selectorIds' => [
        'about_us' => 'about_us' 
    ]])
    <script>
        function formatCardNumber(input) {
            // Remove all non-digit characters
            let value = input.value.replace(/\D/g, '');

            // Format the value with hyphens after every 4 digits
            let formattedValue = '';
            for (let i = 0; i < value.length; i += 4) {
                if (i > 0) {
                    formattedValue += '-';
                }
                formattedValue += value.substring(i, i + 4);
            }

            input.value = formattedValue;
        }
    </script>
@endpush