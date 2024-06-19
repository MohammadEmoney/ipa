<div class="container-fluid">
    <livewire:admin.components.live-breadcrumb :items="[['title' => $title]]" />
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
                <h5 class="card-title fw-semibold mb-4">{{ $title }}</h5>
                <button class="btn btn-sm btn-ac-info" onclick="Custom.deleteAllItems('deleteAll')">{{ __('global.delete_all') }}</button>
            </div>
            <div class="table-responsive">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" class="form-control border-info" wire:model.live.debounce.600="search" placeholder="{{ __('global.search') }} ...">
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('global.full_name') }}</th>
                            <th class="text-nowrap" scope="col">{{ __('global.phone_number') }}</th>
                            <th scope="col">{{ __('global.email') }}</th>
                            <th scope="col">{{ __('global.address') }}</th>
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
                                <td><span class="d-inline-block text-truncate" style="max-width: 100px;" title="{{ $user->userInfo?->address ?: "-" }}">{{ $user->userInfo?->address ?: "-" }}</span></td>
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
                {{ $users->links("pagination::bootstrap-5") }}
            </div>
        </div>
    </div>
</div>

