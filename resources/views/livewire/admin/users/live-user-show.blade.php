<div class="card">
    <div class="card-body">
        <div class="d-flex justify-content-between mb-4">
            <h5 class="card-title fw-semibold">اطلاعات کاربر {{ $user->full_name }}</h5>
            <button class="btn btn-sm btn-ac-info" wire:click="edit()">ویرایش</button>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="row mb-5">
                    <div class="col-md-3 col-6 mb-3 text-center">
                        نام: {{ $user->first_name }}
                    </div>
                    <div class="col-md-3 col-6 mb-3 text-center">
                        نام خانوادگی: {{ $user->last_name }}
                    </div>
                    <div class="col-md-3 col-6 mb-3 text-center">
                        نام پدر: {{ $user->userInfo->father_name }}
                    </div>
                    <div class="col-md-3 col-6 mb-3 text-center">
                        شماره همراه: <span @cannot('user_view_mobile') class="phone-number" @endcannot dir="ltr">{{ $user->userInfo->mobile_1 }}</span>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-10 col-12 mb-3 table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">ویرایش اطلاعات</th>
                                    <th class="text-center" scope="col">مشاهده کارنامه</th>
                                    <th class="text-center" scope="col">مشاهده سایر دوره ها</th>
                                    <th class="text-center" scope="col">مشاهده امور مالی</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center"><i class="cursor-pointer ti ti-click ms-2" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="edit({{ $user->id }}, {{ $user->type }})" title="ویرایش"></i></td>
                                    <td class="text-center"><i class="cursor-pointer ti ti-click ms-2" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="reportCard({{ $user->id }}, {{ $user->type }})" title="کارنامه"></i></td>
                                    <td class="text-center"><i class="cursor-pointer ti ti-click ms-2" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="courses({{ $user->id }}, {{ $user->type }})" title="سایر دوره ها"></i></td>
                                    <td class="text-center"><i class="cursor-pointer ti ti-click ms-2" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="finances({{ $user->id }}, {{ $user->type }})" title="امور مالی"></i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col text-center">
                        <img src="{{ $user->getFirstMediaUrl('personal_image') }}" alt="" class="img-fluid" style="max-height: 110px">
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 mb-3 table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">نام ترم جاری</th>
                                    <th class="text-center" scope="col">نام استاد</th>
                                    <th class="text-center" scope="col">ارسال اطلاعات</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">{{ $user->current_semester_title }}</td>
                                    <td class="text-center">{{ $user->current_semester_teacher }}</td>
                                    <td class="text-center"><i class="cursor-pointer ti ti-click ms-2" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="sendMessagesModal({{ $user->id }}, {{ $user->type }})" title="ویرایش"></i></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row g-0">
                    <div class="col-md-3 text-center align-content-center border">
                        وضعیت شهریه
                    </div>
                    <div class="border col-md-9 table-responsive p-4">
                        <table class="mb-0 table table-bordered">
                            <tbody>
                                @forelse ($tuitions as $tuition)
                                    <tr>
                                        <td class="text-center p-1">{{ __('admin/enums/EnumOrderPaymentStatus.' . $tuition->payment_status) }}</td>
                                        <td class="text-center p-1"><i class="ti {{ $tuition->payment_status === 'clear' ? "ti-checkbox text-success" : "ti-x text-danger" }}"></i></td>
                                        <td class="text-center p-1">جهت مشاهده جزئیات کلیک نمایید</td>
                                    </tr>
                                @empty
                                    <tr><td class="text-center p-1">در حال حاضر اطلاعاتی ثبت نشده است.</td></tr>
                                @endforelse
                                {{-- <tr>
                                    <td class="text-center p-1">تسویه</td>
                                    <td class="text-center p-1"><i class="cursor-pointer ti ti-check" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="edit({{ $user->id }}, {{ $user->type }})" title="ویرایش"></i></td>
                                    <td class="text-center p-1">بدهکار می باشد</td>
                                </tr>
                                <tr>
                                    <td class="text-center p-1">بدهکار</td>
                                    <td class="text-center p-1"><i class="cursor-pointer ti ti-x" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="edit({{ $user->id }}, {{ $user->type }})" title="ویرایش"></i></td>
                                    <td class="text-center p-1">جهت مشاهده بدهی کلیک نمایید</td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row g-0">
                    <div class="col-md-3 text-center align-content-center border">
                        وضعیت کتاب
                    </div>
                    <div class="border col-md-9 table-responsive p-4">
                        <table class="mb-0 table table-bordered">
                            <tbody>
                                @forelse ($books as $book)
                                    <tr>
                                        <td class="text-center p-1">{{ __('admin/enums/EnumOrderPaymentStatus.' . $book->payment_status) }}</td>
                                        <td class="text-center p-1"><i class="ti {{ $tuition->payment_status === 'clear' ? "ti-checkbox text-success" : "ti-x text-danger" }}"></i></td>
                                        <td class="text-center p-1 cursor-pointer">جهت مشاهده جزئیات کلیک نمایید</td>
                                    </tr>
                                @empty
                                    <tr><td class="text-center p-1">در حال حاضر اطلاعاتی ثبت نشده است.</td></tr>
                                @endforelse
                                {{-- <tr>
                                    <td class="text-center p-1">بدهکار</td>
                                    <td class="text-center p-1"><i class="cursor-pointer ti ti-x" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="edit({{ $user->id }}, {{ $user->type }})" title="ویرایش"></i></td>
                                    <td class="text-center p-1">جهت مشاهده بدهی کلیک نمایید</td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row g-0">
                    <div class="col-md-3 text-center align-content-center border">
                        برنامه هفتگی
                    </div>
                    <div class="border col-md-9 table-responsive p-4">
                        <table class="mb-0 table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center" scope="col">روز</th>
                                    <th class="text-center" scope="col">نام دوره</th>
                                    <th class="text-center" scope="col">شماره کلاس</th>
                                    <th class="text-center" scope="col">ساعت</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center p-1">شنبه</td>
                                    <td class="text-center p-1">Fil 1/a</td>
                                    <td class="text-center p-1">A</td>
                                    <td class="text-center p-1">18 – 19:30</td>
                                </tr>
                                <tr>
                                    <td class="text-center p-1">یکشنبه</td>
                                    <td class="text-center p-1">Fil 1/a</td>
                                    <td class="text-center p-1">A</td>
                                    <td class="text-center p-1">18 – 19:30</td>
                                </tr>
                                <tr>
                                    <td class="text-center p-1">دوشنبه</td>
                                    <td class="text-center p-1">Fil 1/a</td>
                                    <td class="text-center p-1">A</td>
                                    <td class="text-center p-1">18 – 19:30</td>
                                </tr>
                                <tr>
                                    <td class="text-center p-1">سه شنبه</td>
                                    <td class="text-center p-1">Fil 1/a</td>
                                    <td class="text-center p-1">A</td>
                                    <td class="text-center p-1">18 – 19:30</td>
                                </tr>
                                <tr>
                                    <td class="text-center p-1">چهار شنبه</td>
                                    <td class="text-center p-1">Fil 1/a</td>
                                    <td class="text-center p-1">A</td>
                                    <td class="text-center p-1">18 – 19:30</td>
                                </tr>
                                <tr>
                                    <td class="text-center p-1">پنج شنبه</td>
                                    <td class="text-center p-1">Fil 1/a</td>
                                    <td class="text-center p-1">A</td>
                                    <td class="text-center p-1">18 – 19:30</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        @if (false)
        <div class="accordion" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                        اطلاعات شخصی کاربر
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <tbody>
                                    <tr>
                                        <td>نام و نام خانوادگی</td>
                                        <td>{{ $user->full_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>نام پدر</td>
                                        <td>{{ $user->userInfo->father_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>جنسیت</td>
                                        <td>{{ __( 'admin/enums/EnumGender.' . $user->userInfo->gender) }}</td>
                                    </tr>
                                    <tr>
                                        <td>عنوان شغلی</td>
                                        <td>{{ $user->userInfo->job }}</td>
                                    </tr>
                                    <tr>
                                        <td>تحصیلات</td>
                                        <td>{{ __('admin/enums/EnumEducationTypes.' . $user->userInfo->education) }}</td>
                                    </tr>
                                    @if($user->userInfo->gender == "male")
                                        <tr>
                                            <td>وضعیت نظام وظیفه</td>
                                            <td>{{ __( 'admin/enums/EnumMilitaryStatus.' . $user->userInfo->military_status) }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <td>وضعیت تاهل</td>
                                        <td>{{ $user->userInfo->mariage_status ? "متاهل" : "مجرد" }}</td>
                                    </tr>
                                    <tr>
                                        <td>کد ملی</td>
                                        <td><span @cannot('user_view_national_code') class="national-code" @endcannot dir="ltr">{{ $user->national_code }}</span></td>
                                    </tr>
                                    <tr>
                                        <td>تلفن ثابت</td>
                                        <td><span @cannot('user_view_phone') class="phone-number" @endcannot dir="ltr">{{ $user->userInfo->landline_phone }}</span></td>
                                    </tr>
                                    <tr>
                                        <td>شماره موبایل 1</td>
                                        <td><span @cannot('user_view_mobile') class="phone-number" @endcannot dir="ltr">{{ $user->userInfo->mobile_1 }}</span></td>
                                    </tr>
                                    <tr>
                                        <td>شماره موبایل 2</td>
                                        <td><span @cannot('user_view_mobile') class="phone-number" @endcannot dir="ltr">{{ $user->userInfo->mobile_2 }}</span></td>
                                    </tr>
                                    <tr>
                                        <td>پست الکترونیکی</td>
                                        <td><span @cannot('user_view_email') class="d-inline-block text-truncate" style="max-width: 50px;"@endcannot dir="ltr">{{ $user->userInfo->email }}</span></td>
                                    </tr>
                                    <tr>
                                        <td>تاریخ تولد</td>
                                        <td><span dir="ltr">{{ \Morilog\Jalali\Jalalian::fromDateTime($user->userInfo->birth_date)->format('Y-m-d') }}</span></td>
                                    </tr>
                                    <tr>
                                        <td>آدرس منزل</td>
                                        <td><span @cannot('user_view_address') class="d-inline-block text-truncate" style="max-width: 50px;"@endcannot>{{ $user->userInfo->address }} </span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @if($user->type == "staff")
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            سوابق شغلی
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">نام شرکت</th>
                                        <th scope="col">عنوان شغلی</th>
                                        <th scope="col">شروع کار</th>
                                        <th scope="col">پایان کار</th>
                                        <th scope="col">توضیحات</th>
                                        <th scope="col">عملیات</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user->jobReferences as $job)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $job->company_name }}</td>
                                                <td>{{ $job->role }}</td>
                                                <td>{{ \Morilog\Jalali\Jalalian::fromDateTime($job->date_start)->format('Y-m-d') }}</td>
                                                <td>{{ \Morilog\Jalali\Jalalian::fromDateTime($job->date_end)->format('Y-m-d') }}</td>
                                                <td>{{ $job->description }}</td>
                                                <td>
                                                    @can('user_job_delete')
                                                        <i class="cursor-pointer ti ti-trash text-danger ms-2" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="deleteJob({{ $job->id }})" title="حذف"></i>
                                                    @endcan
                                                    @can('user_job_edit')
                                                        {{-- <i class="cursor-pointer ti ti-pencil text-warning ms-2" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="editJob({{ $job->id }})" title="ویرایش"></i> --}}
                                                    @endcan
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingThree">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                        data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                        مدارک
                    </button>
                </h2>
                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                    data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <h4 class="fs-3">تصویر کارت ملی</h4>
                                <div class="px-5">
                                    <img src="{{ $user->getFirstMediaUrl('national_card') }}" alt="" class="img-fluid">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h4 class="fs-3">تصویر عکس پرسنلی</h4>
                                <div class="px-5">
                                    <img src="{{ $user->getFirstMediaUrl('personal_image') }}" alt="" class="img-fluid">
                                </div>
                            </div>
                            @if($user->type == "staff")
                                <div class="col-md-6 mb-3">
                                    <h4 class="fs-3">تصویر شناسنامه ص 1</h4>
                                    <div class="px-5">
                                        <img src="{{ $user->getFirstMediaUrl('id_first_page') }}" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h4 class="fs-3">تصویر شناسنامه ص 2</h4>
                                    <div class="px-5">
                                        <img src="{{ $user->getFirstMediaUrl('id_second_page') }}" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h4 class="fs-3">تصویر مدارک 1</h4>
                                    <div class="px-5">
                                        <img src="{{ $user->getFirstMediaUrl('document_1') }}" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h4 class="fs-3">تصویر مدارک 2</h4>
                                    <div class="px-5">
                                        <img src="{{ $user->getFirstMediaUrl('document_2') }}" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h4 class="fs-3">تصویر مدارک 3</h4>
                                    <div class="px-5">
                                        <img src="{{ $user->getFirstMediaUrl('document_3') }}" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h4 class="fs-3">تصویر مدارک 4</h4>
                                    <div class="px-5">
                                        <img src="{{ $user->getFirstMediaUrl('document_4') }}" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h4 class="fs-3">تصویر مدارک 5</h4>
                                    <div class="px-5">
                                        <img src="{{ $user->getFirstMediaUrl('document_5') }}" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h4 class="fs-3">تصویر مدارک 6</h4>
                                    <div class="px-5">
                                        <img src="{{ $user->getFirstMediaUrl('document_6') }}" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h4 class="fs-3">تصویر مدارک 7</h4>
                                    <div class="px-5">
                                        <img src="{{ $user->getFirstMediaUrl('document_7') }}" alt="" class="img-fluid">
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h4 class="fs-3">تصویر مدارک 8</h4>
                                    <div class="px-5">
                                        <img src="{{ $user->getFirstMediaUrl('document_8') }}" alt="" class="img-fluid">
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @if($user->type == "staff")
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            نقش و دسترسی ها
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                        data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            <div class="row mb-3">
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <td>نقش کاربر</td>
                                                <td>{{ __('admin/globals.role_names.' . $user->getRoleNames()->first()) }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="row">
                                <h1 class="fs-4 mb-3">دسترسی ها مستقیم</h1>
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
            @endif
        </div>
        @endif
    </div>
</div>


@push('scripts')
    <script>
        $(document).ready(function() {
            $('.phone-number').each(function() {
                var phoneNumber = $(this).text();
                var hiddenNumber = phoneNumber.substring(0, 4) + '*****' + phoneNumber.substring(9);
                $(this).text(hiddenNumber);

                $(this).on('click', function() {
                    window.location.href = 'tel:' + phoneNumber;
                });
            });
            $('.national-code').each(function() {
                var nationalCode = $(this).text();
                var hiddenNumber = nationalCode.substring(0, 4) + '*****' + nationalCode.substring(8);
                $(this).text(hiddenNumber);
            });
        });
    </script>
@endpush
