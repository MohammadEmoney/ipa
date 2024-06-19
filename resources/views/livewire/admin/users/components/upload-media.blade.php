<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="mb-3">
            <label for="formFile" class="form-label">{{ __('global.upload_image') }}
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
