<form wire:submit.prevent="submit">
    
    <div class="accordion" id="accordionExample">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="firstNameInputtext1" class="form-label">{{ __('global.first_name') }} *</label>
                    <input type="text" class="form-control" wire:model="data.first_name"
                        id="firstNameInputtext1" aria-describedby="textHelp" placeholder="{{ __('global.your_first_name') }}">
                    <div>@error('data.first_name') {{ $message }} @enderror</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="lastNameInputtext1" class="form-label">{{ __('global.last_name') }} *</label>
                    <input type="text" class="form-control" wire:model="data.last_name"
                        id="lastNameInputtext1" aria-describedby="textHelp" placeholder="{{ __('global.your_last_name') }}">
                    <div>@error('data.last_name') {{ $message }} @enderror</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="phoneInputtext1" class="form-label">{{ __('global.phone_number') }}
                    </label>
                    <input type="text" class="form-control" wire:model="data.phone"
                        id="phoneInputtext1" aria-describedby="textHelp" placeholder="09123456789">
                    <div>@error('data.phone') {{ $message }} @enderror</div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">{{ __('global.email') }}
                    </label>
                    <input type="email" autocomplete="username" class="form-control" wire:model="data.email"
                        id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="example@email.com">
                    <div>@error('data.email') {{ $message }} @enderror</div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="titleInputtext1" class="form-label">{{ __('global.title') }}</label>
                    <input type="text" class="form-control" wire:model="data.title"
                        id="titleInputtext1" aria-describedby="textHelp" placeholder="{{ __('global.title') }}">
                    <div>@error('data.title') {{ $message }} @enderror</div>
                </div>
            </div>
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
        </div>
        <div class="d-flex justify-content-center">
            <hr class="w-50 bg-secondary">
            <span class="mt-1 mx-2 text-nowrap">{{ __('global.socials') }}</span>
            <hr class="w-50 bg-secondary">
        </div>
        <div class="row">
            @foreach ($data['socials'] ?? [] as $index => $social)
                <div class="col-md-5 mb-3">
                    <label for="socialsInputtext{{ $index }}" class="form-label">{{ __('global.socials') }}</label>
                    <select id="socials" class="form-control"
                        wire:model.live="data.socials.{{ $index }}.social">
                        <option value="">{{ __('global.select_item') }}</option>
                        @foreach ($socials as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-5 mb-3">
                    <label for="linkInputtext{{ $index }}" class="form-label">{{ __('global.link') }}</label>
                    <input type="text" class="form-control" id="linkInputtext{{ $index }}"
                        wire:model.live="data.socials.{{ $index }}.link">
                </div>
                <div class="col-md-2 pt-3">
                    <button type="button" class="btn btn-danger btn-sm mt-3" wire:click="removeSocial({{ $index }})">
                        <i class="ti ti-trash"></i>
                    </button>
                </div>
            @endforeach
        </div>
    
        <div class="d-flex justify-content-center">
            <button type="button" class="btn btn-primary mt-3" wire:click="addSocial()">
                <i class="fa fa-plus"></i> {{ __('global.add_social') }}
            </button>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="formFile" class="form-label">{{ __('global.avatar') }}
                    </label>
                    <input class="form-control @error('data.avatar') invalid-input @enderror" accept="image/png, image/jpeg"
                        wire:model.live="data.avatar"
                        type="file" id="formFile">
                </div>
                @error('data.avatar')
                    {{ $message }}
                @enderror
            </div>
            @if (isset($data['avatar']))
                @if(method_exists($data['avatar'], 'temporaryUrl'))
                    <div class="col-md-6 px-5 mb-3">
                        <img src="{{ $data['avatar']->temporaryUrl() }}" class="w-100">
                    </div>
                @else
                    <div class="col-md-6 px-5 mb-3">
                        <img src="{{ $data['avatar']->getUrl() }}" class="w-100">
                        <span class="fs-4 position-absolute text-danger cursor-pointer" wire:click="deleteMedia({{ $data['avatar']->id }}, 'avatar')"><i class="ti ti-trash"></i></span>
                    </div>
                @endif
            @endif
        </div>
    </div>

    @if($edit)
        <div class="row">
            <div class="col-md-6">
                <button type="submit"
                    class="btn btn-dark w-100 py-8 fs-4 mb-4 rounded-0">
                    <span class="spinner-border spinner-border-sm"
                    wire:loading></span> {{ __('global.edit') }}
                </button>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-6">
                <button type="submit"
                    class="btn btn-primary w-100 py-8 fs-4 my-4">
                    <span class="spinner-border spinner-border-sm"
                    wire:loading></span> {{ __('global.submit') }}
                </button>
            </div>
        </div>
    @endif
</form>
