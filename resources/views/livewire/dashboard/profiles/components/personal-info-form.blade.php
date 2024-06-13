<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="exampleInputtext1" class="form-label">نام *</label>
            <input type="text" class="form-control @error('data.first_name') invalid-input @enderror" wire:model.live="data.first_name" id="exampleInputtext1"
                aria-describedby="textHelp">
            <div>
                @error('data.first_name')
                    {{ $message }}
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="exampleInputtext1" class="form-label">نام
                خانوادگی *</label>
            <input type="text" class="form-control @error('data.last_name') invalid-input @enderror" wire:model.live="data.last_name" id="exampleInputtext1"
                aria-describedby="textHelp">
            <div>
                @error('data.last_name')
                    {{ $message }}
                @enderror
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="exampleInputtext1" class="form-label">نام
                پدر *</label>
            <input type="text" class="form-control @error('data.father_name') invalid-input @enderror" wire:model.live="data.father_name" id="exampleInputtext1"
                aria-describedby="textHelp">
            <div>
                @error('data.father_name')
                    {{ $message }}
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="exampleInputtext1" class="form-label">کد ملی *</label>
            <input type="text" class="form-control @error('data.national_code') invalid-input @enderror" wire:model.live="data.national_code"
                id="exampleInputtext1" aria-describedby="textHelp">
            <div>
                @error('data.national_code')
                    {{ $message }}
                @enderror
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="exampleInputtext1" class="form-label">تاریخ
                تولد *</label>
            <input type="text" class="form-control @error('data.birth_date') invalid-input @enderror" wire:model.live="data.birth_date" id="birth_date"
                onchange="livewireDatePicker('data.birth_date', this)"
                aria-describedby="textHelp"
                data-date="{{ $data['birth_date'] ?? "" }}" value="{{ $data['birth_date'] ?? "" }}">
            <div>
                @error('data.birth_date')
                    {{ $message }}
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="exampleInputtext1" class="form-label">شماره
                تلفن</label>
            <input type="text" class="form-control @error('data.landline_phone') invalid-input @enderror" wire:model.live="data.landline_phone"
                id="exampleInputtext1" aria-describedby="textHelp">
            <div>
                @error('data.landline_phone')
                    {{ $message }}
                @enderror
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="exampleInputtext1" class="form-label">شماره همراه
                1 *</label>
            <input type="text" class="form-control @error('data.mobile_1') invalid-input @enderror" wire:model.live="data.mobile_1" id="exampleInputtext1"
                aria-describedby="textHelp">
            <div>
                @error('data.mobile_1')
                    {{ $message }}
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="exampleInputtext1" class="form-label">شماره همراه
                2 *</label>
            <input type="text" class="form-control @error('data.mobile_2') invalid-input @enderror" wire:model.live="data.mobile_2" id="exampleInputtext1"
                aria-describedby="textHelp">
            <div>
                @error('data.mobile_2')
                    {{ $message }}
                @enderror
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <label for="exampleInputtext1" class="form-label">آدرس
                منزل *</label>
            <textarea class="form-control @error('data.address') invalid-input @enderror" wire:model.live="data.address" id="" cols="10" rows="10"
                style="height: 60px;"></textarea>
            <div>
                @error('data.address')
                    {{ $message }}
                @enderror
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="mb-3">
            <label for="exampleInputtext1" class="form-label">شغل</label>
            <input type="text" class="form-control @error('data.job') invalid-input @enderror" wire:model.live="data.job" id="exampleInputtext1"
                aria-describedby="textHelp">
            <div>
                @error('data.job')
                    {{ $message }}
                @enderror
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="mb-3">
            <label for="exampleInputtext1" class="form-label">تحصیلات</label>
            <select id="" class="form-control @error('data.education') invalid-input @enderror" wire:model.live="data.education">
                <option value="">انتخاب نمایید</option>
                @foreach ($educations as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
            </select>
            <div>
                @error('data.education')
                    {{ $message }}
                @enderror
            </div>
        </div>
    </div>
</div>