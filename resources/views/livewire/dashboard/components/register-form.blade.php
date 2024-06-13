<div class="text-center d-flex align-items-center mb-3">
    <span class="form-group-title"></span>
    <h2 class="mb-0 pb-0 px-3 text-ac-info fs-4 text-nowrap">اطلاعات شخصی</h2>
    <span class="form-group-title"></span>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="exampleInputtext1" class="form-label">نام *</label>
            <input type="text" class="form-control" wire:model.live="data.first_name"
                id="exampleInputtext1" aria-describedby="textHelp" placeholder="مثال: علی">
            <div>@error('data.first_name') {{ $message }} @enderror</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="exampleInputtext1" class="form-label">نام
                خانوادگی *</label>
            <input type="text" class="form-control" wire:model.live="data.last_name"
                id="exampleInputtext1" aria-describedby="textHelp" placeholder="مثال: نمازی">
            <div>@error('data.last_name') {{ $message }} @enderror</div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <label for="exampleInputtext1" class="form-label">کد ملی *</label>
            <input type="text" class="form-control" wire:model.live="data.national_code"
                id="exampleInputtext1" aria-describedby="textHelp" placeholder="مثال: 0012345678">
            <div>@error('data.national_code') {{ $message }} @enderror</div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="mb-3">
            <label for="exampleInputtext1" class="form-label">شماره همراه
                *</label>
            <input type="text" class="form-control" wire:model.live="data.mobile_1"
                id="exampleInputtext1" aria-describedby="textHelp" placeholder="09123456789">
            <div>@error('data.mobile_1') {{ $message }} @enderror</div>
        </div>
    </div>
</div>
