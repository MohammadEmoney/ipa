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
    <div class="col-md-6">
        <div class="mb-3">
            <label for="exampleInputtext1" class="form-label">نام
                پدر *</label>
            <input type="text" class="form-control" wire:model.live="data.father_name"
                id="exampleInputtext1" aria-describedby="textHelp" placeholder="مثال: حسین">
            <div>@error('data.father_name') {{ $message }} @enderror</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="exampleInputtext1" class="form-label">کد ملی *</label>
            <input type="text" class="form-control" wire:model.live="data.national_code"
                id="exampleInputtext1" aria-describedby="textHelp" placeholder="مثال: 0012345678">
            <div>@error('data.national_code') {{ $message }} @enderror</div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="exampleInputtext1" class="form-label">تاریخ
                تولد *</label>
            <input type="text" class="form-control birth_date" wire:model.live="data.birth_date"
                id="birth_date" aria-describedby="textHelp" autocomplete="new-password"
                data-date="{{ $data['birth_date'] ?? "" }}" value="{{ $data['birth_date'] ?? "" }}">
            <div>@error('data.birth_date') {{ $message }} @enderror</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="exampleInputtext1" class="form-label">شماره
                تلفن</label>
            <input type="text" class="form-control" wire:model.live="data.landline_phone"
                id="exampleInputtext1" aria-describedby="textHelp" placeholder="02612345678">
            <div>@error('data.landline_phone') {{ $message }} @enderror</div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="exampleInputtext1" class="form-label">شماره همراه
                1 *</label>
            <input type="text" class="form-control" wire:model.live="data.mobile_1"
                id="exampleInputtext1" aria-describedby="textHelp" placeholder="09123456789">
            <div>@error('data.mobile_1') {{ $message }} @enderror</div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="exampleInputtext1" class="form-label">شماره همراه
                2 *</label>
            <input type="text" class="form-control" wire:model.live="data.mobile_2"
                id="exampleInputtext1" aria-describedby="textHelp" placeholder="09123456789">
            <div>@error('data.mobile_2') {{ $message }} @enderror</div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <label for="exampleInputtext1" class="form-label">آدرس
                منزل *</label>
            <textarea  class="form-control" wire:model.live="data.address"
                id="student-address" cols="10" rows="10" style="height: 60px;" placeholder="مثال: مهرشهر - بلوار ولیعصر - چهارم شرقی - پلاک 1"></textarea>
            <div>@error('data.address') {{ $message }} @enderror</div>
        </div>
    </div>
</div>
