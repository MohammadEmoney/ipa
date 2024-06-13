<div class="row">
    <div class="col-lg-12 d-flex align-items-stretch">
        <div class="card w-100 shadow">
            <div class="card-body p-4">
                <h5 class="card-title fw-semibold mb-4">لیست دانش آموزان</h5>
                <div class="table-responsive">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <input type="text" class="form-control border-info" wire:model.live.debounce.600="search" placeholder="جستجو براساس نام، کدملی ، شماره تلفن ...">
                        </div>
                    </div>
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-responsive">
                                    <thead>
                                        <tr>
                                            <th rowspan="2" scope="col">#</th>
                                            <th rowspan="2">نام و نام خانوادگی</th>
                                            <th rowspan="2">نام پدر</th>
                                            <th rowspan="2">کد ملی</th>
                                            <th rowspan="2">شماره تلفن</th>
                                            <th rowspan="2" class="text-nowrap">نام دوره (نام استاد)</th>
                                            <th rowspan="2" class="text-nowrap">ساعت برگزاری (روزها)</th>
                                            <th rowspan="2" class="text-nowrap">کلاس</th>
                                            <th colspan="4" class="text-center">شهریه</th>
                                            <th colspan="5" class="text-center">ملاحضات</th>
                                        </tr>
                                        <tr>
                                            <th>کتاب</th>
                                            <th>شماره فیش</th>
                                            <th>شهریه</th>
                                            <th>شماره فیش</th>

                                            <th>نقد</th>
                                            <th>مانده</th>
                                            <th>تاریخ پرداخت</th>
                                            <th>مبلغ</th>
                                            <th>توضیحات</th>
                                        </tr>
                                    </thead>
                                    <tbody id="rows">
                                        @foreach ($users as $key => $user)
                                            <tr>
                                                <th scope="row">{{ $key + 1 }}</th>
                                                <td class="text-nowrap cursor-pointer" wire:click="edit({{ $user->id }}, {{ $user->type }})">{{ $user->full_name }}</td>
                                                <td>{{ $user->userInfo?->father_name ?: "-" }}</td>
                                                <td>{{ $user->national_code }}</td>
                                                <td>
                                                    @can('user_view_phone')
                                                        <a href="tel:{{ $user->userInfo?->landline_phone ?: "-" }}">{{ $user->userInfo?->landline_phone ?: "-" }}</a>
                                                    @else
                                                        <i class="ti ti-alert-octagon text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="مجاز به دیدن این بخش نمی باشید."></i>
                                                    @endcan
                                                    @can('user_view_mobile')
                                                        <a href="tel:{{ $user->userInfo?->mobile_1 ?: "-" }}">{{ $user->userInfo?->mobile_1 ?: "-" }}</a>
                                                        <a href="tel:{{ $user->userInfo?->mobile_2 ?: "-" }}">{{ $user->userInfo?->mobile_1 ?: "-" }}</a>
                                                    @else
                                                        <i class="ti ti-alert-octagon text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="مجاز به دیدن این بخش نمی باشید."></i>
                                                    @endcan
                                                </td>
                                                <td class="text-nowrap">
                                                    @if ($semester = $user->semesters()->where('current', 1)?->first())
                                                        {{ $semester?->course?->title_with_part }} ({{ $semester->teacher?->full_name }})
                                                    @else
                                                        -
                                                    @endif 
                                                </td>
                                                <td class="text-nowrap">
                                                    @if ($semester = $user->semesters()->where('current', 1)?->first())
                                                        {{ $semester?->time_start?->format('H:i') }}-{{ $semester?->time_end?->format('H:i')  }} (
                                                            {{ (isset($semester->week_days['type']) && $semester->week_days['type']) ? __('admin/globals.week_types.' . $semester->week_days['type']) : "-" }}
                                                        )
                                                    @else
                                                        -
                                                    @endif 
                                                </td>
                                                <td>
                                                    @if ($semester = $user->semesters()->where('current', 1)?->first())
                                                    {{ $semester?->class_number }}
                                                @else
                                                    -
                                                @endif </td>
                                                <td>{{ $user->latestOrder('book')?->payment_status ? : "-" }}</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                <td>-</td>
                                                {{-- <td><i class="ti ti-check"></i></td>
                                                <td>123456789</td>
                                                <td><i class="ti ti-x"></i></td>
                                                <td>987654312</td>
                                                <td><i class="ti ti-check"></i></td>
                                                <td>200000</td>
                                                <td class="text-nowrap">{{ \Morilog\Jalali\Jalalian::fromDateTime($user->userInfo->register_date)->format('Y-m-d') }}</td>
                                                <td>300000</td>
                                                <td>تسویه</td> --}}
                                                {{-- <td>
                                                    <div class="d-flex">
                                                        <i class="cursor-pointer ti ti-trash text-danger ms-2" data-bs-toggle="tooltip" data-bs-placement="top" onclick="Custom.deleteItemList({{$user->id}})" title="حذف"></i>
                                                        <i class="cursor-pointer ti ti-pencil text-warning ms-2" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="edit({{ $user->id }}, {{ $user->type }})" title="ویرایش"></i>
                                                        <i class="cursor-pointer ti ti-eye" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="show({{ $user->id }}, {{ $user->type }})" title="نمایش"></i>
                                                    </div>
                                                </td> --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <h5 class="card-title fw-semibold mb-4">لیست کلاس ها</h5>
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <input type="text" class="form-control border-info" wire:model.live.debounce.600="searchSemester" placeholder="جستجو براساس ترم یا استاد...">
                        </div>
                    </div>
                    <div class="container">
                        <div class="accordion" id="accordionExample">
                            @foreach ($semesters as $semester)
                                <div class="accordion-item mb-4">
                                    <h2 class="accordion-header" id="heading{{ $semester->id }}" wire:ignore>
                                        <button class="accordion-button collapsed border p-3" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $semester->id }}" aria-expanded="false" aria-controls="collapse{{ $semester->id }}">
                                            <div class="row w-100">
                                                <div class="text-end mb-2 mb-md-0 col-md-3">
                                                    نام استاد: {{ $semester->teacher?->full_name ?: "-" }}
                                                </div>
                                                <div class="text-end mb-2 mb-md-0 col-md-3">
                                                    نام دوره: {{ $semester->course?->title ?: "-" }} / {{ $semester->class_number }}
                                                </div>
                                                <div class="text-end mb-2 mb-md-0 col-md-2">
                                                    ساعت: {{ $semester->time_start?->format('H:i') ?: "-" }} - {{ $semester->time_end?->format('H:i') ?: "-" }}
                                                </div>
                                                <div class="text-end mb-2 mb-md-0 col-md-4">
                                                    روزها: @if(isset($semester->week_days['type']) && $semester->week_days['type'])
                                                                {{ __('admin/globals.week_types.' . $semester->week_days['type']) }}
                                                            @endif
                                                (@foreach ($semester->week_days['days'] ?? [] as $key => $value)
                                                    @if($value)
                                                        {{ __('admin/globals.week_days.' . $key) }} ،
                                                    @endif
                                                @endforeach)
                                                    
                                                </div>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="collapse{{ $semester->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $semester->id }}" data-bs-parent="#accordionExample" wire:ignore.self>
                                        <div class="accordion-body">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <table class="table table-bordered table-responsive table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th rowspan="2" scope="col">#</th>
                                                                <th rowspan="2">نام و نام خانوادگی</th>
                                                                <th rowspan="2">نام پدر</th>
                                                                <th rowspan="2">کد ملی</th>
                                                                <th rowspan="2">شماره تلفن</th>
                                                                <th rowspan="2" class="text-nowrap">نام دوره (نام استاد)</th>
                                                                <th rowspan="2" class="text-nowrap">ساعت برگزاری (روزها)</th>
                                                                <th colspan="4" class="text-center">شهریه</th>
                                                                <th colspan="5" class="text-center">ملاحضات</th>
                                                            </tr>
                                                            <tr>
                                                                <th>کتاب</th>
                                                                <th>شماره فیش</th>
                                                                <th>شهریه</th>
                                                                <th>شماره فیش</th>
                
                                                                <th>نقد</th>
                                                                <th>مانده</th>
                                                                <th>تاریخ پرداخت</th>
                                                                <th>مبلغ</th>
                                                                <th>توضیحات</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody id="rows">
                                                            @foreach ($semester->students as $key => $user)
                                                                <tr>
                                                                    <th scope="row">{{ $key + 1 }}</th>
                                                                    <td class="text-nowrap cursor-pointer" wire:click="edit({{ $user->id }}, {{ $user->type }})">{{ $user->full_name }}</td>
                                                                    <td>{{ $user->userInfo?->father_name ?: "-" }}</td>
                                                                    <td>{{ $user->national_code }}</td>
                                                                    <td>
                                                                        @can('user_view_phone')
                                                                            <a href="tel:{{ $user->userInfo?->landline_phone ?: "-" }}">{{ $user->userInfo?->landline_phone ?: "-" }}</a>
                                                                        @else
                                                                            <i class="ti ti-alert-octagon text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="مجاز به دیدن این بخش نمی باشید."></i>
                                                                        @endcan
                                                                        @can('user_view_mobile')
                                                                            <a href="tel:{{ $user->userInfo?->mobile_1 ?: "-" }}">{{ $user->userInfo?->mobile_1 ?: "-" }}</a>
                                                                            <a href="tel:{{ $user->userInfo?->mobile_2 ?: "-" }}">{{ $user->userInfo?->mobile_1 ?: "-" }}</a>
                                                                        @else
                                                                            <i class="ti ti-alert-octagon text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="مجاز به دیدن این بخش نمی باشید."></i>
                                                                        @endcan
                                                                    </td>
                                                                    <td class="text-nowrap">
                                                                        @if ($semester = $user->semesters()->where('current', 1)?->first())
                                                                            {{ $semester?->course?->title }} / {{ $semester?->pivot?->class_number  }} ({{ $semester->teacher?->full_name }})
                                                                        @else
                                                                            -
                                                                        @endif 
                                                                    </td>
                                                                    <td class="text-nowrap">
                                                                        @if ($semester = $user->semesters()->where('current', 1)?->first())
                                                                            {{ $semester?->time_start?->format('H:i') }}-{{ $semester?->time_end?->format('H:i')  }} (
                                                                                {{ (isset($semester->week_days['type']) && $semester->week_days['type']) ? __('admin/globals.week_types.' . $semester->week_days['type']) : "-" }}
                                                                            )
                                                                        @else
                                                                            -
                                                                        @endif 
                                                                    </td>
                                                                    <td>-</td>
                                                                    <td>-</td>
                                                                    <td>-</td>
                                                                    <td>-</td>
                                                                    <td>-</td>
                                                                    <td>-</td>
                                                                    <td>-</td>
                                                                    <td>-</td>
                                                                    <td>-</td>
                                                                    {{-- <td><i class="ti ti-check"></i></td>
                                                                    <td>123456789</td>
                                                                    <td><i class="ti ti-x"></i></td>
                                                                    <td>987654312</td>
                                                                    <td><i class="ti ti-check"></i></td>
                                                                    <td>200000</td>
                                                                    <td class="text-nowrap">{{ \Morilog\Jalali\Jalalian::fromDateTime($user->userInfo->register_date)->format('Y-m-d') }}</td>
                                                                    <td>300000</td>
                                                                    <td>تسویه</td> --}}
                                                                    {{-- <td>
                                                                        <div class="d-flex">
                                                                            <i class="cursor-pointer ti ti-trash text-danger ms-2" data-bs-toggle="tooltip" data-bs-placement="top" onclick="Custom.deleteItemList({{$user->id}})" title="حذف"></i>
                                                                            <i class="cursor-pointer ti ti-pencil text-warning ms-2" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="edit({{ $user->id }}, {{ $user->type }})" title="ویرایش"></i>
                                                                            <i class="cursor-pointer ti ti-eye" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="show({{ $user->id }}, {{ $user->type }})" title="نمایش"></i>
                                                                        </div>
                                                                    </td> --}}
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
