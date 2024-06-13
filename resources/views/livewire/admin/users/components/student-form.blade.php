<form wire:submit.prevent="submitStudent">
    {{-- @dd($errors->messages()) --}}
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="exampleInputtext1" class="form-label">نام
                    *</label>
                <input type="text" class="form-control"
                    wire:model.live="data.first_name"
                    id="exampleInputtext1" aria-describedby="textHelp"
                    placeholder="مثال: علی">
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
                <input type="text" class="form-control"
                    wire:model.live="data.last_name"
                    id="exampleInputtext1" aria-describedby="textHelp"
                    placeholder="مثال: نمازی">
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
                <input type="text" class="form-control"
                    wire:model.live="data.father_name"
                    id="exampleInputtext1" aria-describedby="textHelp"
                    placeholder="مثال: حسین">
                <div>
                    @error('data.father_name')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="exampleInputtext1" class="form-label">کد ملی
                    *</label>
                <input type="text" class="form-control"
                    wire:model.live="data.national_code"
                    id="exampleInputtext1" aria-describedby="textHelp"
                    placeholder="مثال: 0012345678">
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
                <input type="text" class="form-control date"
                    wire:model.live="data.birth_date"
                    id="student_birth_date" aria-describedby="textHelp"
                    autocomplete="new-password"
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
                <label for="exampleInputtext1"
                    class="form-label">شماره
                    تلفن ثابت</label>
                <input type="text" class="form-control"
                    wire:model.live="data.landline_phone"
                    id="exampleInputtext1" aria-describedby="textHelp"
                    placeholder="02612345678">
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
                <label for="exampleInputtext1"
                    class="form-label">شماره همراه
                    1 *</label>
                <input type="text" class="form-control"
                    wire:model.live="data.mobile_1"
                    id="exampleInputtext1" aria-describedby="textHelp"
                    placeholder="09123456789">
                <div>
                    @error('data.mobile_1')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="exampleInputtext1"
                    class="form-label">شماره همراه
                    2 *</label>
                <input type="text" class="form-control"
                    wire:model.live="data.mobile_2"
                    id="exampleInputtext1" aria-describedby="textHelp"
                    placeholder="09123456789">
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
                <textarea class="form-control" wire:model.live="data.address" id="student-address" cols="10" rows="10"
                    style="height: 60px;" placeholder="مثال: مهرشهر - بلوار ولیعصر - چهارم شرقی - پلاک 1"></textarea>
                <div>
                    @error('data.address')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="align-items-center col-md-6 d-flex">
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
            <div>
                @error('data.gender')
                    {{ $message }}
                @enderror
            </div>
        </div>
        {{-- @if(isset($data['gender']) && $data['gender'] == \App\Enums\EnumUserGender::MALE)
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
        @endif --}}
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="exampleInputtext1"
                    class="form-label">شغل</label>
                <input type="text" class="form-control"
                    wire:model.live="data.job" id="exampleInputtext1"
                    aria-describedby="textHelp"
                    placeholder="مثال: مهندس عمران">
                <div>
                    @error('data.job')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="mb-3">
                <label for="exampleInputtext1"
                    class="form-label">تحصیلات</label>
                <select id="" class="form-control"
                    wire:model.live="data.education">
                    <option value="">انتخاب نمایید</option>
                    @foreach ($educations as $key => $value)
                        <option value="{{ $key }}">
                            {{ $value }}</option>
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
                <input type="text" class="form-control date"
                    wire:model.live="data.register_date"
                    onchange="livewireDatePicker('data.register_date', this)"
                    id="register_date" aria-describedby="textHelp"
                    autocomplete="new-password"
                    data-date="{{ $data['register_date'] ?? "" }}" value="{{ $data['register_date'] ?? "" }}">
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
                    الکترونیکی</label>
                <input type="email" class="form-control"
                    wire:model.live="data.email"
                    id="exampleInputEmail1"
                    aria-describedby="emailHelp"
                    placeholder="example@gmail.com">
                <div>
                    @error('data.email')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="mb-3">
                <label for="formFile" class="form-label">آپلود کارت
                    ملی *</label>
                <input class="form-control"
                    wire:model.live="data.national_card_image"
                    type="file" id="formFile">
            </div>
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
                <input class="form-control"
                    wire:model.live="data.personal_image"
                    type="file" id="formFile">
            </div>
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
        <div class="col-md-4">
            <div class="mb-3">
                <label for="exampleInputtext1" class="form-label">نام
                    معرف</label>
                <input type="text" class="form-control"
                    wire:model.live="data.refferal_name"
                    id="exampleInputtext1" aria-describedby="textHelp"
                    placeholder="مثال: مریم سعادت">
                <div>
                    @error('data.refferal_name')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="exampleInputtext1"
                    class="form-label">شماره ملی معرف</label>
                <input type="text" class="form-control"
                    wire:model.live="data.refferal_national_code"
                    id="exampleInputtext1" aria-describedby="textHelp"
                    placeholder="مثال: 0023456789">
                <div>
                    @error('data.refferal_national_code')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="mb-3">
                <label for="exampleInputtext1"
                    class="form-label">شماره تماس معرف</label>
                <input type="text" class="form-control"
                    wire:model.live="data.refferal_phone"
                    id="exampleInputtext1" aria-describedby="textHelp"
                    placeholder="مثال: 09123456789">
                <div>
                    @error('data.refferal_phone')
                        {{ $message }}
                    @enderror
                </div>
            </div>
        </div>
    </div>
    @if($edit)
        <div class="row">
            <div class="col-md-6">
                <button type="submit"
                    class="btn btn-dark w-100 py-8 fs-4 mb-4 rounded-0">
                    <span class="spinner-border spinner-border-sm"
                    wire:loading></span> ویرایش اطلاعات
                </button>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-6">
                <button type="submit"
                    @if ($disabledCreate) disabled @endif
                    class="btn btn-ac-primary w-100 py-8 fs-4 mb-4 rounded-0 {{ $disabledCreate ? '' : 'blink_me' }}">
                    <span class="spinner-border spinner-border-sm"
                        wire:loading></span> ثبت نهایی اطلاعات
                </button>
            </div>
        </div>
    @endif
</form>
