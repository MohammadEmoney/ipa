<section>
    <div class="container">
        <div class="accordion" id="accordionExample">
            <div class="steps">
                <progress id="progress" value={{ $progressValue }} max=100 ></progress>
                <div class="step-item" 
                {{-- wire:click="setStep('personalInfo', 1)" --}}
                >
                    <button class="step-button text-center {{ $stepNumber >= 1 ? "done" : "" }}" type="button" data-toggle="collapse"
                        data-target="#collapseOne" aria-expanded="{{ $step === "personalInfo" ? "true" : "false" }}" aria-controls="collapseOne">
                        1
                    </button>
                    <div class="step-title">
                        اطلاعات شخصی
                    </div>
                </div>
                <div class="step-item" 
                {{-- wire:click="setStep('furtherInfo', 2)" --}}
                >
                    <button class="step-button text-center {{ $stepNumber >= 2 ? "done" : "" }}" type="button" data-toggle="collapse"
                        data-target="#collapseTwo" aria-expanded="{{ $step === "furtherInfo" ? "true" : "false" }}" aria-controls="collapseTwo">
                        2
                    </button>
                    <div class="step-title">
                        اطلاعات تکمیلی
                    </div>
                </div>
                <div class="step-item" 
                {{-- wire:click="setStep('uploadMedia', 3)" --}}
                >
                    <button class="step-button text-center {{ $stepNumber >= 3 ? "done" : "" }}" type="button" data-toggle="collapse"
                        data-target="#collapseThree" aria-expanded="{{ $step === "uploadMedia" ? "true" : "false" }}" aria-controls="collapseThree">
                        3
                    </button>
                    <div class="step-title">
                        بارگذاری مدارک و تایید نهایی
                    </div>
                </div>
            </div>

            @if ($step === "personalInfo")
                <div class="card">
                    <div id="collapseOne">
                        <div class="card-body">
                            <form wire:submit.prevent="submitStaffPersonalInfo">
                                @include('livewire.dashboard.profiles.components.personal-info-form')
                                <div class="row mt-3">
                                    <div class="align-items-center col-md-6">
                                        <div class="mb-3">
                                            <label for="exampleInputtext1"
                                                class="form-label">وضعیت تاهل*</label>
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
                                                الکترونیکی (ایمیل)</label>
                                            <input type="email" class="form-control" wire:model.live="data.email"
                                                id="exampleInputEmail1" aria-describedby="emailHelp">
                                            <div>@error('data.email') {{ $message }} @enderror</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6"></div>
                                    <div class="col-md-6">
                                        <button type="submit"
                                            class="btn btn-dark w-100 py-8 fs-4 mb-4 rounded-0">
                                            <span class="spinner-border spinner-border-sm"
                                            wire:loading></span> بعدی
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif

            @if ($step === "jobReferences")
                <div class="card">
                    <div id="collapseTwo">
                        <div class="card-body">
                            @include('livewire.admin.users.components.create-jobs')
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="button" wire:click="setStep('personalInfo', 1)"
                                        class="btn btn-ac-primary w-100 py-8 fs-4 mb-4 rounded-0">
                                        </span> قبلی
                                    </button>
                                </div>
                                <div class="col-md-6">
                                    <button type="button" wire:click="submitJobReferences()"
                                        class="btn btn-dark w-100 py-8 fs-4 mb-4 rounded-0">
                                        <span class="spinner-border spinner-border-sm"
                                        wire:loading></span> بعدی
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if ($step === "uploadMedia")
                <div class="card">
                    <div id="collapseThree">
                        <div class="card-body">
                            <form wire:submit.prevent="submitStaff()">
                                @include('livewire.admin.users.components.upload-media')
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="button" wire:click="setStep('jobReferences', 2)"
                                            class="btn btn-ac-primary w-100 py-8 fs-4 mb-4 rounded-0">
                                            قبلی
                                        </button>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="submit"
                                            class="btn btn-dark w-100 py-8 fs-4 mb-4 rounded-0">
                                            <span class="spinner-border spinner-border-sm"
                                            wire:loading></span> ثبت نهایی اطلاعات
                                        </button>
                                        <p class="text-danger" wire:loading wire:target="submitStaff">لطفا منتظر بمانید تصاویر در حال ذخیره سازی می باشند.</p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</section>

@if (false)
<form wire:submit.prevent="submitStaff">
    {{-- @dd($errors->messages()) --}}
    @include('livewire.dashboard.components.personal-info')
    <div class="row">
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
    @include('livewire.admin.users.components.upload-media')

    <div class="row">
        <div class="col-md-6">
            <button type="submit"
                class="btn btn-dark w-100 py-8 fs-4 mb-4 rounded-0">
                <span class="spinner-border spinner-border-sm"
                wire:loading></span> ویرایش اطلاعات
            </button>
        </div>
    </div>
</form>
@endif
