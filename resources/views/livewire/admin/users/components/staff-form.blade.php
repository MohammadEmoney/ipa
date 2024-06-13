<form wire:submit.prevent="submitStaff">
    {{-- @if(count($errors->messages()))
        <div class="alert alert-warning" role="alert">
            لطفا گزینه های ستاره دار را تکمیل نمایید تا اطلاعات شما ثبت گردد.
        </div>
        @dd($errors->messages())
    @endif --}}
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingOne" wire:ignore>
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              اطلاعات شخصی
            </button>
          </h2>
          <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample" wire:ignore.self>
            <div class="accordion-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputtext1" class="form-label">نام
                                *</label>
                            <input type="text" class="form-control"
                                wire:model.live.debounce.1000ms="data.first_name"
                                id="exampleInputtext1"
                                aria-describedby="textHelp" placeholder="مثال: علی">
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
                                wire:model.live.debounce.1000ms="data.last_name"
                                id="exampleInputtext1"
                                aria-describedby="textHelp" placeholder="مثال: اصغری">
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
                                wire:model.live.debounce.1000ms="data.father_name"
                                id="exampleInputtext1"
                                aria-describedby="textHelp" placeholder="مثال: محمد">
                            <div>
                                @error('data.father_name')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputtext1" class="form-label">کد
                                ملی *</label>
                            <input type="text" class="form-control"
                                wire:model.live.debounce.1000ms="data.national_code"
                                id="exampleInputtext1"
                                aria-describedby="textHelp" placeholder="مثال: 0012345678">
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
                            <label for="staff_birth_date"
                                class="form-label">تاریخ
                                تولد *</label>
                            <input type="text" class="form-control date"
                                wire:model.live="data.birth_date"
                                id="staff_birth_date"
                                aria-describedby="textHelp" autocomplete="new-password"
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
                                wire:model.live.debounce.1000ms="data.landline_phone"
                                id="exampleInputtext1"
                                aria-describedby="textHelp" placeholder="02612345678">
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
                                wire:model.live.debounce.1000ms="data.mobile_1"
                                id="exampleInputtext1"
                                aria-describedby="textHelp" placeholder="09123456789">
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
                                wire:model.live.debounce.1000ms="data.mobile_2"
                                id="exampleInputtext1"
                                aria-describedby="textHelp" placeholder="09123456789">
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
                            <textarea class="form-control" wire:model.live.debounce.1000ms="data.address" id="" cols="10" rows="10"
                                style="height: 60px;" placeholder="مثال: مهرشهر - بلوار ولیعصر - چهارم شرقی - پلاک 1"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputtext1"
                                class="form-label">عنوان شغلی *</label>
                            <input type="text" class="form-control"
                                wire:model.live.debounce.1000ms="data.job" id="exampleInputtext1"
                                aria-describedby="textHelp" placeholder="مثال: مهندس عمران">
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
                                class="form-label">تحصیلات *</label>
                            <select id="" class="form-control"
                                wire:model.live="data.education">
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
                <div class="row">
                    <div class="align-items-center col-md-6 d-flex">
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
                        <div>
                            @error('data.mariage_status')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>
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
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">پست
                                الکترونیکی</label>
                            <input type="email" class="form-control"
                                wire:model.live.debounce.1000ms="data.email"
                                id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="example@gmail.com">
                            <div>
                                @error('data.email')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingTwo" wire:ignore>
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              سوابق شغلی
            </button>
          </h2>
          <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample" wire:ignore.self>
            <div class="accordion-body">
                @include('livewire.admin.users.components.create-jobs')
            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingThree" wire:ignore>
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
              بارگذاری مدارک
            </button>
          </h2>
          <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample" wire:ignore.self>
            <div class="accordion-body">
                @include('livewire.admin.users.components.upload-media')
            </div>
          </div>
        </div>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour" wire:ignore>
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                تعیین رمز
              </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample" wire:ignore.self>
                <div class="accordion-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="exampleInputPassword1" class="form-label">رمز عبور</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" wire:model.live="data.password">
                            </div>
                            <div>
                                @error('data.password')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="exampleInputPassword2" class="form-label">تایید رمز عبور</label>
                                <input type="password" class="form-control" id="exampleInputPassword2" wire:model.live="data.password_confirmation">
                            </div>
                            <div>
                                @error('data.password_confirmation')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @can('role_access')
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFive" wire:ignore>
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    دسترسی ها
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample" wire:ignore.self>
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputtext1"
                                        class="form-label">نقش کاربر *</label>
                                    <select id="" class="form-control"
                                        wire:model.live="data.role">
                                        <option value="">انتخاب نمایید</option>
                                        @foreach ($roles as $value)
                                            <option value="{{ $value->name }}">{{ __('admin/globals.role_names.' . $value->name) }}</option>
                                        @endforeach
                                    </select>
                                    <div>
                                        @error('data.role')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex justify-content-between col-12">
                                <h4>دسترسی مستقیم</h4>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" wire:click="selectAll" id="inlineCheckbox1" wire:model="selectedAll" value="1">
                                    <label class="form-check-label" for="inlineCheckbox1">انتخاب همه</label>
                                </div>
                            </div>
                            @foreach ($permissions as $permission)
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" wire:model="data.direct_permissions.{{ $permission->id }}"
                                                value="{{ $permission->id }}" id="flexCheckDefault_{{ $permission->id }}">
                                            <label class="form-check-label" for="flexCheckDefault_{{ $permission->id }}">
                                                {{ __('admin/permissions.' . $permission->name) }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endcan
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
