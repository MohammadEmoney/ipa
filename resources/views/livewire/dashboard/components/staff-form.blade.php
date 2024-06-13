<form wire:submit.prevent="submitStaff">
    {{-- @dd($errors->messages()) --}}
    @include('livewire.dashboard.components.register-form')
    {{-- @include('livewire.dashboard.components.personal-info') --}}
    {{-- <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="exampleInputtext1" class="form-label">عنوان شغلی *</label>
                <input type="text" class="form-control" wire:model.live="data.job"
                    id="exampleInputtext1" aria-describedby="textHelp">
                <div>@error('data.job') {{ $message }} @enderror</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="exampleInputtext1"
                    class="form-label">تحصیلات *</label>
                <select  id="" class="form-control" wire:model.live="data.education">
                    <option value="">انتخاب نمایید</option>
                    @foreach ($educations as $key => $value )
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
                <div>@error('data.education') {{ $message }} @enderror</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="align-items-center col-md-6">
            <div class="mb-3">
                <label for="exampleInputtext1"
                    class="form-label">وضعیت تاهل</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio"
                        name="mariage_status" id="inlineRadio1"
                        wire:model.live="data.mariage_status"
                        value="1">
                    <label class="form-check-label"
                        for="inlineRadio1">متاهل</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio"
                        name="mariage_status" id="inlineRadio2"
                        wire:model.live="data.mariage_status"
                        value="0">
                    <label class="form-check-label"
                        for="inlineRadio2">مجرد</label>
                </div>
            </div>
            <div class="mb-3">
                @error('data.mariage_status')
                    {{ $message }}
                @enderror
            </div>
        </div>
        <div class="align-items-center col-md-6">
            <div class="mb-3">
                <label for="exampleInputtext1"
                    class="form-label">جنسیت</label>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio"
                        name="gender" id="inlineRadio1"
                        wire:model.live="data.gender"
                        value="{{ \App\Enums\EnumUserGender::MALE }}">
                    <label class="form-check-label"
                        for="inlineRadio1">آقا</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio"
                        name="gender" id="inlineRadio2"
                        wire:model.live="data.gender"
                        value="{{ \App\Enums\EnumUserGender::FEMALE }}">
                    <label class="form-check-label"
                        for="inlineRadio2">خانم</label>
                </div>
            </div>
            <div class="mb-3">
                @error('data.gender')
                    {{ $message }}
                @enderror
            </div>
        </div>
        @if(isset($data['gender']) && $data['gender'] == \App\Enums\EnumUserGender::MALE)
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleInputtext1"
                        class="form-label">وضعیت نظام وظیفه</label>
                    <select id="" class="form-control"
                        wire:model.live="data.military_status">
                        <option value="">انتخاب نمایید</option>
                        @foreach ($militaryStatuses as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    <div>
                        @error('data.military_status')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
        @endif
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">پست
                    الکترونیکی *</label>
                <input type="email" class="form-control" wire:model.live="data.email"
                    id="exampleInputEmail1" aria-describedby="emailHelp">
                <div>@error('data.email') {{ $message }} @enderror</div>
            </div>
        </div>
    </div>
    @include('livewire.admin.users.components.upload-media') --}}

    {{-- <div class="row">
        <div class="col-md-12">
            <h3>سوابق کاری مرتبط</h3>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputtext1" class="form-label">نام شرکت *</label>
                                <input type="text" class="form-control" wire:model.live="data.company_name"
                                    id="exampleInputtext1" aria-describedby="textHelp">
                                <div>@error('data.company_name') {{ $message }} @enderror</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputtext1" class="form-label">عنوان شغلی *</label>
                                <input type="text" class="form-control" wire:model.live="data.role"
                                    id="exampleInputtext1" aria-describedby="textHelp">
                                <div>@error('data.role') {{ $message }} @enderror</div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputtext1" class="form-label">نام شرکت *</label>
                                <input type="text" class="form-control" wire:model.live="data.date_start"
                                    id="exampleInputtext1" aria-describedby="textHelp">
                                <div>@error('data.date_start') {{ $message }} @enderror</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputtext1" class="form-label">عنوان شغلی *</label>
                                <input type="text" class="form-control" wire:model.live="data.date_end"
                                    id="exampleInputtext1" aria-describedby="textHelp">
                                <div>@error('data.date_end') {{ $message }} @enderror</div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" wire:model.live="data.still_working" id="inlineCheckbox1" value="1">
                                <label class="form-check-label" for="inlineCheckbox1">هنوز مشغول کار هستم</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="exampleInputtext1" class="form-label">توضیحات</label>
                                <textarea  class="form-control" wire:model.live="data.description" id="" cols="10" rows="10" style="height: 60px;"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}

    {{-- @include('livewire.admin.users.components.create-jobs') --}}

    <div class="row">
        <div class="col-md-6">
            <button type="submit" @if($disabledCreate) disabled @endif
                class="btn btn-ac-primary w-100 py-8 fs-4 mb-4 rounded-0 {{ $disabledCreate ? "" : "blink_me" }}">
                <span class="spinner-border spinner-border-sm" wire:loading></span> ثبت نهایی اطلاعات
            </button>
        </div>
    </div>
</form>
