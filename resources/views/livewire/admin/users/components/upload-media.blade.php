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
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="mb-3">
            <label for="formFile" class="form-label">{{ __('global.national_card') }}
            </label>
            <input class="form-control @error('data.nationalCard') invalid-input @enderror" accept="image/png, image/jpeg"
                wire:model.live="data.nationalCard"
                type="file" id="formFile">
        </div>
        @error('data.nationalCard')
            {{ $message }}
        @enderror
    </div>
    @if (isset($data['nationalCard']))
        @if(method_exists($data['nationalCard'], 'temporaryUrl'))
            <div class="col-md-6 px-5 mb-3">
                <img src="{{ $data['nationalCard']->temporaryUrl() }}" class="w-100">
            </div>
        @else
            <div class="col-md-6 px-5 mb-3">
                <img src="{{ $data['nationalCard']->getUrl() }}" class="w-100">
                <span class="fs-4 position-absolute text-danger cursor-pointer" wire:click="deleteMedia({{ $data['nationalCard']->id }}, 'nationalCard')"><i class="ti ti-trash"></i></span>
            </div>
        @endif
    @endif
</div>
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="mb-3">
            <label for="formFile" class="form-label">{{ __('global.pilot_license') }}
            </label>
            <input class="form-control @error('data.license') invalid-input @enderror" accept="image/png, image/jpeg"
                wire:model.live="data.license"
                type="file" id="formFile">
        </div>
        @error('data.license')
            {{ $message }}
        @enderror
    </div>
    @if (isset($data['license']))
        @if(method_exists($data['license'], 'temporaryUrl'))
            <div class="col-md-6 px-5 mb-3">
                <img src="{{ $data['license']->temporaryUrl() }}" class="w-100">
            </div>
        @else
            <div class="col-md-6 px-5 mb-3">
                <img src="{{ $data['license']->getUrl() }}" class="w-100">
                <span class="fs-4 position-absolute text-danger cursor-pointer" wire:click="deleteMedia({{ $data['license']->id }}, 'license')"><i class="ti ti-trash"></i></span>
            </div>
        @endif
    @endif
</div>
