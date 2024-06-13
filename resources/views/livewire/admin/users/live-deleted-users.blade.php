<div class="container-fluid">
    <livewire:admin.components.live-breadcrumb :items="[['title' => 'کاربران']]" />
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
                <h5 class="card-title fw-semibold mb-4">کاربران</h5>
                <button class="btn btn-sm btn-ac-info" onclick="Custom.deleteAllItems('deleteAll')">حذف همه</button>
            </div>
            <div class="table-responsive">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" class="form-control border-info" wire:model.live.debounce.600="search" placeholder="جستجو ...">
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">نام و نام خانوادگی</th>
                            <th scope="col">کد ملی</th>
                            <th scope="col">تلفن ثابت</th>
                            <th scope="col">شماره همراه 1</th>
                            <th scope="col">شماره همراه 2</th>
                            <th scope="col">ایمیل</th>
                            <th scope="col">آدرس</th>
                            <th scope="col">نقش کاربر</th>
                            <th scope="col">تاریخ ثبت نام</th>
                            <th scope="col">عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                            <tr>
                                <th scope="row">{{  ($users->currentpage()-1) * $users->perpage() + $key + 1 }}</th>
                                <td class="text-nowrap cursor-pointer" wire:click="edit({{ $user->id }}, {{ $user->type }})">{{ $user->full_name }}</td>
                                <td>{{ $user->national_code }}</td>
                                @can('user_view_phone')
                                    <td>{{ $user->userInfo?->landline_phone ?: "-" }}</td>
                                @else
                                    <td><i class="ti ti-alert-octagon text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="مجاز به دیدن این بخش نمی باشید."></i></td>
                                @endcan
                                @can('user_view_mobile')
                                    <td>{{ $user->userInfo?->mobile_1 ?: "-" }}</td>
                                    <td>{{ $user->userInfo?->mobile_2 ?: "-" }}</td>
                                @else
                                    <td><i class="ti ti-alert-octagon text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="مجاز به دیدن این بخش نمی باشید."></i></td>
                                    <td><i class="ti ti-alert-octagon text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="مجاز به دیدن این بخش نمی باشید."></i></td>
                                @endcan
                                @can('user_view_email')
                                    <td>{{ $user->userInfo?->email ?: "-" }}</td>
                                @else
                                    <td><i class="ti ti-alert-octagon text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="مجاز به دیدن این بخش نمی باشید."></i></td>
                                @endcan
                                @can('user_view_address')
                                    <td><span class="d-inline-block text-truncate" style="max-width: 100px;" title="{{ $user->userInfo?->address ?: "-" }}">{{ $user->userInfo?->address ?: "-" }}</span></td>
                                @else
                                    <td><i class="ti ti-alert-octagon text-danger" data-bs-toggle="tooltip" data-bs-placement="top" title="مجاز به دیدن این بخش نمی باشید."></i></td>
                                @endcan
                                <td class="text-nowrap">{{ $user->getRoleNames()?->first() ? \App\Enums\EnumUserRoles::trans($user->getRoleNames()?->first()) : "-" }}</td>
                                <td class="text-nowrap">{{ \Morilog\Jalali\Jalalian::fromDateTime($user->userInfo->register_date)->format('Y-m-d') }}</td>
                                <td>
                                    <div class="d-flex">
                                        <i class="cursor-pointer ti ti-trash text-danger ms-2" data-bs-toggle="tooltip" data-bs-placement="top" onclick="Custom.deleteItemList({{$user->id}})" title="حذف"></i>
                                        <i class="cursor-pointer ti ti-pencil text-warning ms-2" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="edit({{ $user->id }}, {{ $user->type }})" title="ویرایش"></i>
                                        <i class="cursor-pointer ti ti-eye" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="show({{ $user->id }}, {{ $user->type }})" title="نمایش"></i>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links("pagination::bootstrap-5") }}
            </div>
        </div>
    </div>
</div>

