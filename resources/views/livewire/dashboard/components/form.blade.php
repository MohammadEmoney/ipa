<h5 class="text-center">{{ __('global.register') }}</h5>
<div class="mb-3">
    <small class="text-muted">{{ __('messages.register_support_text') }}</small>
    <small class="d-block">
        <strong>{{ __('global.telegram_id') }}:</strong> <a href="https://t.me/Saeedf1987">{{ __('global.support') }}</a>
    </small>
    <small class="text-muted">{{ __('messages.register_support_sub_text') }}</small>
</div>
<form wire:submit.prevent="submit">
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="firstNameInputtext1" class="form-label">{{ __('global.first_name') }} *</label>
                <input type="text" class="@error('data.first_name') invalid-input @enderror form-control" wire:model="data.first_name"
                    id="firstNameInputtext1" aria-describedby="textHelp" placeholder="{{ __('global.your_first_name') }}">
                <div class="text-danger">@error('data.first_name') {{ $message }} @enderror</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="lastNameInputtext1" class="form-label">{{ __('global.last_name') }} *</label>
                <input type="text" class="@error('data.last_name') invalid-input @enderror form-control" wire:model="data.last_name"
                    id="lastNameInputtext1" aria-describedby="textHelp" placeholder="{{ __('global.your_last_name') }}">
                <div class="text-danger">@error('data.last_name') {{ $message }} @enderror</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3">
                <label for="phoneInputtext1" class="form-label">{{ __('global.phone_number') }}
                    *</label>
                <input type="text" class="@error('data.phone') invalid-input @enderror form-control" wire:model="data.phone"
                    id="phoneInputtext1" aria-describedby="textHelp" placeholder="09123456789">
                <div class="text-danger">@error('data.phone') {{ $message }} @enderror</div>
            </div>
        </div>
    </div>
    {{-- <div class="row">
        <div class="col-md-12">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">{{ __('global.email') }} *</label>
                <input type="email" autocomplete="username" class="@error('data.email') invalid-input @enderror form-control" wire:model="data.email"
                    id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="example@email.com">
                <div class="text-danger">@error('data.email') {{ $message }} @enderror</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="mb-4 col-md-12">
            <div class="position-relative">
                <label for="exampleInputPassword1" class="form-label">{{ __('global.password') }} *</label>
                <input type="password" autocomplete="new-password" class="@error('data.password') invalid-input @enderror form-control password" id="exampleInputPassword1" wire:model="data.password">
                <i class="fa fa-eye password-icon"></i>
            </div>
            <div class="text-danger">
                @error('data.password')
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="mb-4 col-md-12">
            <div class="position-relative">
                <label for="exampleInputPassword2" class="form-label">{{ __('global.password_confirmation') }} *</label>
                <input type="password" autocomplete="new-password" class="@error('data.password_confirmation') invalid-input @enderror form-control password" id="exampleInputPassword2" wire:model="data.password_confirmation">
                <i class="fa fa-eye password-icon"></i>
            </div>
            <div class="text-danger">
                @error('data.password_confirmation')
                    {{ $message }}
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3">
                <label for="exampleInputtext1"
                    class="form-label">{{ __('global.job_status') }} *</label>
                <select  id="" class="@error('data.situation') invalid-input @enderror form-control" wire:model.live="data.situation">
                    <option value="">{{ __('global.select_item') }}</option>
                    @foreach ($situations as $key => $value )
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
                <div class="text-danger">@error('data.situation') {{ $message }} @enderror</div>
            </div>
        </div>
        @if(isset($data['situation']) && $data['situation'] === "student")
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="university" class="form-label">{{ __('global.university_name') }}
                        *</label>
                    <input type="text" class="@error('data.university') invalid-input @enderror form-control" wire:model="data.university"
                        id="university" aria-describedby="textHelp" placeholder="{{ __('global.example') }}: {{ __('global.university_of_tehran') }}">
                    <div class="text-danger">@error('data.university') {{ $message }} @enderror</div>
                </div>
            </div>
        @elseif (isset($data['situation']) && $data['situation'] === "employed")
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="company" class="form-label">{{ __('global.company_name') }} *</label>
                    <select  id="" class="@error('data.airline_id') invalid-input @enderror form-control" wire:model.live="data.situation">
                        <option value="">{{ __('global.select_item') }}</option>
                        @foreach ($airlines as $value )
                            <option value="{{ $value->id }}">{{ $value->title }} ( {{ $value->title_en }} )</option>
                        @endforeach
                    </select>
                    <div class="text-danger">@error('data.airline_id') {{ $message }} @enderror</div>
                </div>
            </div>
        @endif
    </div> --}}
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" >
                <span class="spinner-border spinner-border-sm" wire:loading></span> {{ __('global.continue') }}
            </button>
        </div>
    </div>
</form>
