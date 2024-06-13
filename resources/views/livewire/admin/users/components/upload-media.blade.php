<div class="text-center d-flex align-items-center mb-3">
    <span class="form-group-title"></span>
    <h2 class="mb-0 pb-0 px-3 text-ac-info fs-4 text-nowrap">بارگذاری مدارک</h2>
    <span class="form-group-title"></span>
</div>
<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="mb-3">
            <label for="formFile" class="form-label">آپلود کارت
                ملی *</label>
            <input class="form-control @error('data.national_card_image') invalid-input @enderror" accept="image/png, image/jpeg"
                wire:model.live="data.national_card_image"
                type="file" id="formFile">
        </div>
        @error('data.national_card_image')
            {{ $message }}
        @enderror
    </div>
    @if (isset($data['national_card_image']))
        @if(method_exists($data['national_card_image'], 'temporaryUrl'))
            <div class="col-md-6 px-5 mb-3">
                <img src="{{ $data['national_card_image']->temporaryUrl() }}" class="w-100">
            </div>
        @else
            <div class="col-md-6 px-5 mb-3">
                <img src="{{ $data['national_card_image']->getUrl() }}" class="w-100">
                <span class="fs-4 position-absolute text-danger cursor-pointer" wire:click="deleteMedia({{ $data['national_card_image']->id }}, 'national_card_image')"><i class="ti ti-trash"></i></span>
            </div>
        @endif
    @endif
    <div class="col-md-12">
        <div class="mb-3">
            <label for="formFile" class="form-label">آپلود عکس
                *</label>
            <input class="form-control @error('data.personal_image') invalid-input @enderror" accept="image/png, image/jpeg"
                wire:model.live="data.personal_image"
                type="file" id="formFile">
        </div>
        @error('data.personal_image')
            {{ $message }}
        @enderror
    </div>
    @if (isset($data['personal_image']))
        @if(method_exists($data['personal_image'], 'temporaryUrl'))
            <div class="col-md-6 px-5 mb-3">
                <img src="{{ $data['personal_image']->temporaryUrl() }}" class="w-100">
            </div>
        @else
            <div class="col-md-6 px-5 mb-3">
                <img src="{{ $data['personal_image']->getUrl() }}" class="w-100">
                <span class="fs-4 position-absolute text-danger cursor-pointer" wire:click="deleteMedia({{ $data['personal_image']->id }}, 'personal_image')"><i class="ti ti-trash"></i></span>
            </div>
        @endif
    @endif
    <div class="col-md-12">
        <div class="mb-3">
            <label for="formFile" class="form-label">بارگذاری
                شناسنامه ص 1 *</label>
            <input class="form-control @error('data.id_first_page_image') invalid-input @enderror" accept="image/png, image/jpeg"
                wire:model.live="data.id_first_page_image"
                type="file" id="formFile">
        </div>
        @error('data.id_first_page_image')
            {{ $message }}
        @enderror
    </div>
    @if (isset($data['id_first_page_image']))
        @if(method_exists($data['id_first_page_image'], 'temporaryUrl'))
            <div class="col-md-6 px-5 mb-3">
                <img src="{{ $data['id_first_page_image']->temporaryUrl() }}" class="w-100">
            </div>
        @else
            <div class="col-md-6 px-5 mb-3">
                <img src="{{ $data['id_first_page_image']->getUrl() }}" class="w-100">
                <span class="fs-4 position-absolute text-danger cursor-pointer" wire:click="deleteMedia({{ $data['id_first_page_image']->id }}, 'id_first_page_image')"><i class="ti ti-trash"></i></span>
            </div>
        @endif
    @endif
    <div class="col-md-12">
        <div class="mb-3">
            <label for="formFile" class="form-label">بارگذاری
                شناسنامه ص 2 *</label>
            <input class="form-control @error('data.id_second_page_image') invalid-input @enderror" accept="image/png, image/jpeg"
                wire:model.live="data.id_second_page_image"
                type="file" id="formFile">
        </div>
        @error('data.id_second_page_image')
            {{ $message }}
        @enderror
    </div>
    @if (isset($data['id_second_page_image']))
        @if(method_exists($data['id_second_page_image'], 'temporaryUrl'))
            <div class="col-md-6 px-5 mb-3">
                <img src="{{ $data['id_second_page_image']->temporaryUrl() }}" class="w-100">
            </div>
        @else
            <div class="col-md-6 px-5 mb-3">
                <img src="{{ $data['id_second_page_image']->getUrl() }}" class="w-100">
                <span class="fs-4 position-absolute text-danger cursor-pointer" wire:click="deleteMedia({{ $data['id_second_page_image']->id }}, 'id_second_page_image')"><i class="ti ti-trash"></i></span>
            </div>
        @endif
    @endif
    <div class="col-md-12">
        <div class="mb-3">
            <label for="formFile" class="form-label">بارگذاری
                مدارک 1 *</label>
            <input class="form-control @error('data.document_image_1') invalid-input @enderror" accept="image/png, image/jpeg"
                wire:model.live="data.document_image_1"
                type="file" id="formFile">
        </div>
        @error('data.document_image_1')
            {{ $message }}
        @enderror
    </div>
    @if (isset($data['document_image_1']))
        @if(method_exists($data['document_image_1'], 'temporaryUrl'))
            <div class="col-md-6 px-5 mb-3">
                <img src="{{ $data['document_image_1']->temporaryUrl() }}" class="w-100">
            </div>
        @else
            <div class="col-md-6 px-5 mb-3">
                <img src="{{ $data['document_image_1']->getUrl() }}" class="w-100">
                <span class="fs-4 position-absolute text-danger cursor-pointer" wire:click="deleteMedia({{ $data['document_image_1']->id }}, 'document_image_1')"><i class="ti ti-trash"></i></span>
            </div>
        @endif
    @endif
    <div class="col-md-12">
        <div class="mb-3">
            <label for="formFile" class="form-label">بارگذاری
                مدارک 2 *</label>
            <input class="form-control @error('data.document_image_2') invalid-input @enderror" accept="image/png, image/jpeg"
                wire:model.live="data.document_image_2"
                type="file" id="formFile">
        </div>
        @error('data.document_image_2')
            {{ $message }}
        @enderror
    </div>
    @if (isset($data['document_image_2']))
        @if(method_exists($data['document_image_2'], 'temporaryUrl'))
            <div class="col-md-6 px-5 mb-3">
                <img src="{{ $data['document_image_2']->temporaryUrl() }}" class="w-100">
            </div>
        @else
            <div class="col-md-6 px-5 mb-3">
                <img src="{{ $data['document_image_2']->getUrl() }}" class="w-100">
                <span class="fs-4 position-absolute text-danger cursor-pointer" wire:click="deleteMedia({{ $data['document_image_2']->id }}, 'document_image_2')"><i class="ti ti-trash"></i></span>
            </div>
        @endif
    @endif
    <div class="col-md-12">
        <div class="mb-3">
            <label for="formFile" class="form-label">بارگذاری
                مدارک 3 *</label>
            <input class="form-control @error('data.document_image_3') invalid-input @enderror" accept="image/png, image/jpeg"
                wire:model.live="data.document_image_3"
                type="file" id="formFile">
        </div>
        @error('data.document_image_3')
            {{ $message }}
        @enderror
    </div>
    @if (isset($data['document_image_3']))
        @if(method_exists($data['document_image_3'], 'temporaryUrl'))
            <div class="col-md-6 px-5 mb-3">
                <img src="{{ $data['document_image_3']->temporaryUrl() }}" class="w-100">
            </div>
        @else
            <div class="col-md-6 px-5 mb-3">
                <img src="{{ $data['document_image_3']->getUrl() }}" class="w-100">
                <span class="fs-4 position-absolute text-danger cursor-pointer" wire:click="deleteMedia({{ $data['document_image_3']->id }}, 'document_image_3')"><i class="ti ti-trash"></i></span>
            </div>
        @endif
    @endif
    <div class="col-md-12">
        <div class="mb-3">
            <label for="formFile" class="form-label">بارگذاری
                مدارک 4</label>
            <input class="form-control @error('data.document_image_4') invalid-input @enderror" accept="image/png, image/jpeg"
                wire:model.live="data.document_image_4"
                type="file" id="formFile">
        </div>
        @error('data.document_image_4')
            {{ $message }}
        @enderror
    </div>
    @if (isset($data['document_image_4']))
        @if(method_exists($data['document_image_4'], 'temporaryUrl'))
            <div class="col-md-6 px-5 mb-3">
                <img src="{{ $data['document_image_4']->temporaryUrl() }}" class="w-100">
            </div>
        @else
            <div class="col-md-6 px-5 mb-3">
                <img src="{{ $data['document_image_4']->getUrl() }}" class="w-100">
                <span class="fs-4 position-absolute text-danger cursor-pointer" wire:click="deleteMedia({{ $data['document_image_4']->id }}, 'document_image_4')"><i class="ti ti-trash"></i></span>
            </div>
        @endif
    @endif
    <div class="col-md-12">
        <div class="mb-3">
            <label for="formFile" class="form-label">بارگذاری
                مدارک 5</label>
            <input class="form-control @error('data.document_image_5') invalid-input @enderror" accept="image/png, image/jpeg"
                wire:model.live="data.document_image_5"
                type="file" id="formFile">
        </div>
        @error('data.document_image_5')
            {{ $message }}
        @enderror
    </div>
    @if (isset($data['document_image_5']))
        @if(method_exists($data['document_image_5'], 'temporaryUrl'))
            <div class="col-md-6 px-5 mb-3">
                <img src="{{ $data['document_image_5']->temporaryUrl() }}" class="w-100">
            </div>
        @else
            <div class="col-md-6 px-5 mb-3">
                <img src="{{ $data['document_image_5']->getUrl() }}" class="w-100">
                <span class="fs-4 position-absolute text-danger cursor-pointer" wire:click="deleteMedia({{ $data['document_image_5']->id }}, 'document_image_5')"><i class="ti ti-trash"></i></span>
            </div>
        @endif
    @endif
    <div class="col-md-12">
        <div class="mb-3">
            <label for="formFile" class="form-label">بارگذاری
                مدارک 6</label>
            <input class="form-control @error('data.document_image_6') invalid-input @enderror" accept="image/png, image/jpeg"
                wire:model.live="data.document_image_6"
                type="file" id="formFile">
        </div>
        @error('data.document_image_6')
            {{ $message }}
        @enderror
    </div>
    @if (isset($data['document_image_6']))
        @if(method_exists($data['document_image_6'], 'temporaryUrl'))
            <div class="col-md-6 px-5 mb-3">
                <img src="{{ $data['document_image_6']->temporaryUrl() }}" class="w-100">
            </div>
        @else
            <div class="col-md-6 px-5 mb-3">
                <img src="{{ $data['document_image_6']->getUrl() }}" class="w-100">
                <span class="fs-4 position-absolute text-danger cursor-pointer" wire:click="deleteMedia({{ $data['document_image_6']->id }}, 'document_image_6')"><i class="ti ti-trash"></i></span>
            </div>
        @endif
    @endif
    <div class="col-md-12">
        <div class="mb-3">
            <label for="formFile" class="form-label">بارگذاری
                مدارک 7</label>
            <input class="form-control @error('data.document_image_7') invalid-input @enderror" accept="image/png, image/jpeg"
                wire:model.live="data.document_image_7"
                type="file" id="formFile">
        </div>
        @error('data.document_image_7')
            {{ $message }}
        @enderror
    </div>
    @if (isset($data['document_image_7']))
        @if(method_exists($data['document_image_7'], 'temporaryUrl'))
            <div class="col-md-6 px-5 mb-3">
                <img src="{{ $data['document_image_7']->temporaryUrl() }}" class="w-100">
            </div>
        @else
            <div class="col-md-6 px-5 mb-3">
                <img src="{{ $data['document_image_7']->getUrl() }}" class="w-100">
                <span class="fs-4 position-absolute text-danger cursor-pointer" wire:click="deleteMedia({{ $data['document_image_7']->id }}, 'document_image_7')"><i class="ti ti-trash"></i></span>
            </div>
        @endif
    @endif
    <div class="col-md-12">
        <div class="mb-3">
            <label for="formFile" class="form-label">بارگذاری
                مدارک 8</label>
            <input class="form-control @error('data.document_image_8') invalid-input @enderror" accept="image/png, image/jpeg"
                wire:model.live="data.document_image_8"
                type="file" id="formFile">
        </div>
        @error('data.document_image_8')
            {{ $message }}
        @enderror
    </div>
    @if (isset($data['document_image_8']))
        @if(method_exists($data['document_image_8'], 'temporaryUrl'))
            <div class="col-md-6 px-5 mb-3">
                <img src="{{ $data['document_image_8']->temporaryUrl() }}" class="w-100">
            </div>
        @else
            <div class="col-md-6 px-5 mb-3">
                <img src="{{ $data['document_image_8']->getUrl() }}" class="w-100">
                <span class="fs-4 position-absolute text-danger cursor-pointer" wire:click="deleteMedia({{ $data['document_image_8']->id }}, 'document_image_8')"><i class="ti ti-trash"></i></span>
            </div>
        @endif
    @endif
</div>
