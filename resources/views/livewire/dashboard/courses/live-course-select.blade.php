<div dir="rtl">
    <div class="row justify-content-center">
        <div class="col-md-10 col-12">
            <div class="card">
                <div class="card-body">
                    <form wire:submit.prevent="submit">
                        <div class="row justify-content-center">
                            <div class="col-12 border bg-ac-secondary text-white">
                                @if(Auth::user()->hasRole('student'))
                                    <p class="p-2 text-center">لطفا از طریق یکی از گزینه های زیر دوره مورد نظر خود را انتخاب و ثبت نام خود را تکمیل نمایید .</p>
                                @else
                                    <p class="p-2 text-center">لطفا از طریق یکی از گزینه های زیر دوره مورد نظر خود را انتخاب نمایید .</p>
                                @endif
                            </div>
                            <div class="col-6 border bg-ac-primary text-white text-center py-2">نام دوره و یا کلاس مورد نظر</div>
                            <div class="col-6 border">
                                <input type="text" class="form-control border-0 text-center" wire:model.live="search" placeholder="مثلا: آیلتس\IELTS">
                            </div>
                            <div class="col-6 border text-center py-2"><span class="text-ac-primary cursor-pointer" wire:click="displayAll">مشاهده دوره ها و شهریه ها</span></div>
                            <div class="col-6 border text-center d-grid gap-2 px-0">
                                <button type="submit" class="btn btn-ac-light @if(!$disableSearchBtn) blink_me @endif rounded-0" @if($disableSearchBtn) disabled @endif>جستجو</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            @if ($display)
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">نام دوره</th>
                                        <th scope="col">دسته بندی والد</th>
                                        <th scope="col">نوع دوره</th>
                                        <th scope="col">رده سنی</th>
                                        <th scope="col">شهریه (ریال)</th>
                                        <th scope="col">عملیات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($courses as $key => $course)
                                        <tr>
                                            <th scope="row">{{  ($courses->currentpage()-1) * $courses->perpage() + $key + 1 }}</th>
                                            <td>{{ $course->title }}</td>
                                            <td>{{ $course->parent?->title ?: "-" }}</td>
                                            <td>{{ \App\Enums\EnumCourseTypes::trans($course->type) }}</td>
                                            <td>{{ \App\Enums\EnumCourseAges::trans($course->age) }}</td>
                                            <td>{{ number_format($course->sale_price ?: $course->price) }} </td>
                                            <td class="d-flex">
                                                <a href="#" class="">جزییات</a>
                                                {{-- <i class="cursor-pointer ti ti-trash text-danger ms-2" data-bs-toggle="tooltip" data-bs-placement="top" onclick="Custom.deleteItemList({{$course->id}})" title="حذف"></i>
                                                <i class="cursor-pointer ti ti-pencil text-warning ms-2" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="edit({{ $course->id }})" title="ویرایش"></i> --}}
                                                {{-- <i class="cursor-pointer ti ti-eye" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="show({{ $course->id }})" title="نمایش"></i> --}}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center"><p> هیچ دوره ای یافت نشد. <i class="ti ti-alert-triangle"></i></p></td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            {{ $courses->links() }}
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
