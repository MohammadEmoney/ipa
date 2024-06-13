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
                            <form wire:submit.prevent="submitStudentPersonalInfo">
                                @include('livewire.dashboard.profiles.components.personal-info-form')
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
            @if($step === "furtherInfo")
                <div class="card">
                    <div id="collapseTwo">
                        <div class="card-body">
                            <form wire:submit.prevent="submitFurtherInfo()">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="exampleInputtext1" class="form-label">دوره
                                                مورد
                                                نیاز *</label>
                                            <select id="" class="form-control"
                                                wire:model.live="data.preferd_course">
                                                <option value="">انتخاب نمایید</option>
                                                @foreach ($courses as $value)
                                                    <option value="{{ $value->id }}">
                                                        {{ $value->title }} ({{ \App\Enums\EnumCourseTypes::trans($value->type) }} / {{ \App\Enums\EnumCourseAges::trans($value->age) }})</option>
                                                @endforeach
                                            </select>
                                            <div>
                                                @error('data.preferd_course')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="exampleInputtext1"
                                                class="form-label">تعیین سطح
                                                اولیه *</label>
                                            <select id="" class="form-control"
                                                wire:model.live="data.initial_level">
                                                <option value="">انتخاب نمایید</option>
                                                @foreach ($initialLevels as $key => $value)
                                                    <option value="{{ $key }}">
                                                        {{ $value }}</option>
                                                @endforeach
                                            </select>
                                            <div>
                                                @error('data.initial_level')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="register_date" class="form-label">تاریخ
                                                عضویت *</label>
                                            <input type="text" class="form-control date" wire:model.live="data.register_date"
                                                onchange="livewireDatePicker('data.register_date', this)" id="register_date"
                                                aria-describedby="textHelp">
                                            <div>
                                                @error('data.register_date')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">پست
                                                الکترونیکی(ایمیل)</label>
                                            <input type="email" class="form-control" wire:model.live="data.email" id="exampleInputEmail1"
                                                aria-describedby="emailHelp">
                                            <div>
                                                @error('data.email')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="align-items-center col-md-12">
                                        <div class="mb-3">
                                            <label for="exampleInputtext1"
                                                class="form-label">جنسیت*</label>
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
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="exampleInputtext1" class="form-label">نام معرف</label>
                                            <input type="text" class="form-control" wire:model.live="data.refferal_name"
                                                id="exampleInputtext1" aria-describedby="textHelp">
                                            <div>
                                                @error('data.refferal_name')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="exampleInputtext1" class="form-label">شماره ملی معرف</label>
                                            <input type="text" class="form-control" wire:model.live="data.refferal_national_code"
                                                id="exampleInputtext1" aria-describedby="textHelp">
                                            <div>
                                                @error('data.refferal_national_code')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="exampleInputtext1" class="form-label">شماره تماس معرف</label>
                                            <input type="text" class="form-control" wire:model.live="data.refferal_phone"
                                                id="exampleInputtext1" aria-describedby="textHelp">
                                            <div>
                                                @error('data.refferal_phone')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="button" wire:click="setStep('personalInfo', 1)"
                                            class="btn btn-ac-primary w-100 py-8 fs-4 mb-4 rounded-0">
                                            </span> قبلی
                                        </button>
                                    </div>
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
            @if ($step === "uploadMedia")
                <div class="card">
                    <div id="collapseThree">
                        <div class="card-body">
                            <form wire:submit.prevent="submitStudent()">
                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label for="formFile" class="form-label">آپلود کارت
                                                ملی *</label>
                                            <input class="form-control" accept="image/png, image/jpeg"
                                                wire:model.live="data.national_card_image" wire:loading.attr="disabled"
                                                type="file" id="formFile">
                                        </div>
                                        @error('data.national_card_image')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                    @if (isset($data['national_card_image']))
                                        {{-- @dd($data['national_card_image'], method_exists($data['national_card_image'], 'temporaryUrl')) --}}
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
                                            <input class="form-control" accept="image/png, image/jpeg"
                                                wire:model.live="data.personal_image" wire:loading.attr="disabled" wire:target="updatedDataNationalCardImage"
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
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <button type="button" wire:click="setStep('furtherInfo', 2)"
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
                                        <p class="text-danger" wire:loading wire:target="submitStudent">لطفا منتظر بمانید تصاویر در حال ذخیره سازی می باشند.</p>
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
