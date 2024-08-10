<h5 class="text-center">{{ __('global.upload_image') }}</h5>
<form wire:submit.prevent="submitUpload">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="mb-3 upload-file">
                <label for="formFile" class="form-label">{{ __('global.national_card') }} <i class="bi bi-cloud-arrow-up-fill"></i>
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
                    <img src="{{ $data['nationalCard']->temporaryUrl() }}" class="w-100" style="max-height: 20em">
                </div>
            @else
                <div class="col-md-6 px-5 mb-3">
                    <img src="{{ $data['nationalCard']->getUrl() }}" class="w-100" style="max-height: 20em">
                    <span class="fs-4 position-absolute text-danger cursor-pointer" wire:click="deleteMedia({{ $data['nationalCard']->id }}, 'nationalCard')"><i class="ti ti-trash"></i></span>
                </div>
            @endif
        @endif
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="mb-3 upload-file">
                <label for="formFile" class="form-label">{{ __('global.pilot_license') }} <i class="bi bi-cloud-arrow-up-fill"></i>
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
                    <img src="{{ $data['license']->temporaryUrl() }}" class="w-100" style="max-height: 20em">
                </div>
            @else
                <div class="col-md-6 px-5 mb-3">
                    <img src="{{ $data['license']->getUrl() }}" class="w-100" style="max-height: 20em">
                    <span class="fs-4 position-absolute text-danger cursor-pointer" wire:click="deleteMedia({{ $data['license']->id }}, 'license')"><i class="ti ti-trash"></i></span>
                </div>
            @endif
        @endif
    </div>
    
    <div class="row">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" >
                <span class="spinner-border spinner-border-sm" wire:loading></span> {{ __('global.continue') }}
            </button>
        </div>
    </div>
</form>