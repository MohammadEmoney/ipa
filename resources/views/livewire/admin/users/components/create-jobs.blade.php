<div>
    {{-- <div class="text-center d-flex align-items-center mb-3">
        <span class="form-group-title"></span>
        <h2 class="mb-0 pb-0 px-3 text-ac-info fs-4 text-nowrap">سوابق شغلی</h2>
        <span class="form-group-title"></span>
    </div> --}}
    @if(!$editPage)
    <div class="row">
        <div class="col-12 mb-3">
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" wire:click="loadDatePicker" id="inlineCheckbox1" wire:model.live="haveJobReference" value="1">
                <label class="form-check-label" for="inlineCheckbox1">دارای سابقه شغلی هستم</label>
            </div>
        </div>
    </div>
    @endif

    <div class="row @if(!$haveJobReference) d-none @endif">
        <div class="col-md-12">
            <h3>سوابق کاری مرتبط</h3>
            <div class="card mb-3">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputtext1"
                                    class="form-label">نام شرکت
                                    *</label>
                                <input type="text"
                                    class="form-control"
                                    wire:model.live="jobs.company_name"
                                    id="exampleInputtext1"
                                    aria-describedby="textHelp">
                                <div>
                                    @error('jobs.company_name')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputtext1"
                                    class="form-label">عنوان شغلی
                                    *</label>
                                <input type="text"
                                    class="form-control"
                                    wire:model.live="jobs.role"
                                    id="exampleInputtext1"
                                    aria-describedby="textHelp">
                                <div>
                                    @error('jobs.role')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="date_start"
                                    class="form-label">شروع کار
                                    *</label>
                                <input type="text"
                                    class="form-control"
                                    wire:model.live="jobs.date_start"
                                    id="date_start"
                                    aria-describedby="textHelp"
                                    data-date="{{ $data['date_start'] ?? "" }}" value="{{ $data['date_start'] ?? "" }}">
                                <div>
                                    @error('jobs.date_start')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            @if (!isset($jobs['still_working']) || !$jobs['still_working'])
                                <div class="mb-3">
                                    <label for="date_end"
                                        class="form-label">پایان کار
                                        *</label>
                                    <input type="text"
                                        class="form-control"
                                        wire:model.live="jobs.date_end"
                                        id="date_end"
                                        aria-describedby="textHelp"
                                        data-date="{{ $data['date_end'] ?? "" }}" value="{{ $data['date_end'] ?? "" }}">
                                    <div>
                                        @error('jobs.date_end')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-12 mb-3">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input"
                                    type="checkbox"
                                    wire:model.live="jobs.still_working"
                                    wire:click="loadDatePicker"
                                    id="inlineCheckbox1"
                                    value="1">
                                <label class="form-check-label"
                                    for="inlineCheckbox1">هنوز مشغول
                                    کار هستم</label>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputtext1"
                                    class="form-label">شماره تلفن محل کار
                                    </label>
                                <input type="text"
                                    class="form-control"
                                    wire:model.live="jobs.work_phone"
                                    id="exampleInputtext1"
                                    aria-describedby="textHelp">
                                <div>
                                    @error('jobs.work_phone')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="exampleInputtext1"
                                    class="form-label">آدرس محل کار
                                    </label>
                                <input type="text"
                                    class="form-control"
                                    wire:model.live="jobs.work_address"
                                    id="exampleInputtext1"
                                    aria-describedby="textHelp">
                                <div>
                                    @error('jobs.work_address')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="exampleInputtext1"
                                    class="form-label">توضیحات</label>
                                <textarea class="form-control" wire:model.live="jobs.description" id="" cols="10" rows="10"
                                    style="height: 60px;"></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            @if (!is_null($editingJobId))
                                <button type="button" wire:click="updateJob"
                                    class="btn btn-dark w-100 py-8 fs-4 mb-4 rounded-0">
                                    ویرایش سابقه شغلی
                                </button>
                            @else
                                <button type="button" wire:click="addJobReference"
                                    class="btn btn-dark w-100 py-8 fs-4 mb-4 rounded-0">
                                    ثبت موقت سابقه شغلی
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row @if(!$haveJobReference) d-none @endif">
        <div class="col-md-12 table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">نام شرکت</th>
                    <th scope="col">عنوان شغلی</th>
                    <th scope="col">شروع کار</th>
                    <th scope="col">پایان کار</th>
                    <th scope="col">توضیحات</th>
                    <th scope="col">شماره تلفن</th>
                    <th scope="col">آدرس</th>
                    <th scope="col">عملیات</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($tempJobs as $key => $job)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $job['company_name'] }}</td>
                            <td>{{ $job['role'] }}</td>
                            <td>{{ $job['date_start'] }}</td>
                            <td>{{ (isset($job['still_working']) && $job['still_working']) ? "مشغول به کار هستم" : ($job['date_end'] ?? null) }}</td>
                            <td>{{ $job['work_phone'] ?? "" }}</td>
                            <td>{{ $job['work_address'] ?? "" }}</td>
                            <td>{{ $job['description'] ?? "" }}</td>
                            <td>
                                <i class="cursor-pointer ti ti-trash text-danger ms-2" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="deleteJob({{ $key }})" title="حذف"></i>
                                <i class="cursor-pointer ti ti-pencil text-warning ms-2" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="editJob({{ $key }})" title="ویرایش"></i>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>

