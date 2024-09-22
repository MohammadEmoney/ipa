<div class="container-fluid">
    <livewire:admin.components.live-breadcrumb :items="[['title' => $title]]" />
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
                <h5 class="card-title fw-semibold mb-4">{{ $title }}</h5>
                <button class="btn btn-sm btn-info" wire:click="create()">{{ __('global.create_user') }}</button>
            </div>
            <div class="table-responsive">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" class="form-control border-info" wire:model.live.debounce.600="search" placeholder="{{ __('global.search') }} ...">
                    </div>
                    <div class="col-md-2">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFilter" wire:ignore>
                                    <button class="accordion-button collapsed p-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter">
                                        {{ __('global.filter') }}:
                                    </button>
                                </h2>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-md-12">
                        <div id="collapseFilter" class="accordion-collapse collapse" aria-labelledby="headingFilter" data-bs-parent="#accordionExample" wire:ignore.self>
                            <div class="accordion-body">
                                <div class="row">
                                    <div class="col-12 mb-3">
                                        <button class="btn btn-info" wire:click="resetFilter()" type="button">{{ __('global.reset_filter') }}</button>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <select  id="" class="form-control" wire:model.live="filters.situation">
                                                <option value="">{{ __('global.job_status') }}</option>
                                                @foreach ($situations as $key => $value )
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('global.full_name') }}</th>
                            <th class="text-nowrap" scope="col">{{ __('global.phone_number') }}</th>
                            <th scope="col">{{ __('global.email') }}</th>
                            <th scope="col">{{ __('global.job_status') }}</th>
                            <th scope="col">{{ __('global.address') }}</th>
                            <th scope="col">{{ __('global.confirm_status') }}</th>
                            <th scope="col">{{ __('global.user_role') }}</th>
                            <th class="text-nowrap" scope="col">{{ __('global.register_date') }}</th>
                            <th scope="col">{{ __('global.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $key => $user)
                            <tr>
                                <th scope="row">{{  ($users->currentpage()-1) * $users->perpage() + $key + 1 }}</th>
                                <td class="text-nowrap cursor-pointer" wire:click="edit({{ $user->id }}, {{ $user->type }})">{{ $user->full_name }}</td>
                                <td>{{ $user->phone }}</td>
                                <td class="text-nowrap">{{ $user->email ?: "-" }}</td>
                                <td class="text-nowrap">
                                    {{ App\Enums\EnumUserSituation::trans($user->userInfo?->situation) ?: "-" }} 
                                    @if ($user->userInfo?->situation)
                                        ({{ $user->userInfo?->situation === App\Enums\EnumUserSituation::STUDENT ? $user->userInfo?->university : ($user->userInfo?->situation === App\Enums\EnumUserSituation::EMPLOYED ? $user->userInfo?->company_name : "-") }})
                                    @endif
                                </td>
                                <td><span class="d-inline-block text-truncate" style="max-width: 100px;" title="{{ $user->userInfo?->address ?: "-" }}">{{ $user->userInfo?->address ?: "-" }}</span></td>
                                <td class="text-nowrap text-center">
                                    <div class="form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" @checked($user->is_active) wire:click="changeActiveStatus({{ $user->id }})">
                                    </div>
                                </td>
                                <td class="text-nowrap">{{ $user->getRoleNames()?->first() ? \App\Enums\EnumUserRoles::trans($user->getRoleNames()?->first()) : "-" }}</td>
                                <td class="text-nowrap">{{ \Morilog\Jalali\Jalalian::fromDateTime($user->userInfo?->register_date)->format('Y-m-d') }}</td>
                                <td>
                                    <div class="d-flex">
                                        <i class="cursor-pointer ti ti-trash text-danger ms-2" data-bs-toggle="tooltip" data-bs-placement="top" onclick="Custom.deleteItemList({{$user->id}})" title="{{ __('global.delete') }}"></i>
                                        <i class="cursor-pointer ti ti-pencil text-warning ms-2" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="edit({{ $user->id }}, {{ $user->type }})" title="{{ __('global.edit') }}"></i>
                                        {{-- <i class="cursor-pointer ti ti-eye" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="show({{ $user->id }}, {{ $user->type }})" title="{{ __('global.show') }}"></i> --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>