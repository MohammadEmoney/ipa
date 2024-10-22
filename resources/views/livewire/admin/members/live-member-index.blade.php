<div class="container-fluid">
    <livewire:admin.components.live-breadcrumb :items="[['title' => $title]]" />
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
                <h5 class="card-title fw-semibold mb-4">{{ $title }}</h5>
                <button class="btn btn-sm btn-info" wire:click="create()">{{ __('global.create_member') }}</button>
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
                                    {{-- <div class="col-md-4">
                                        <div class="mb-3">
                                            <input type="text" class="form-control" wire:model="filters.title">
                                        </div>
                                    </div> --}}
                                    <div class="d-flex justify-content-between col-md-4">
                                        <div class="d-flex form-group justify-content-around mb-3">
                                            <label class="form-label ms-3">{{ __('global.is_active') }}</label>
                                            <div class="form-check form-switch d-flex ps-0 {{ app()->getLocale() === "en" ? "" : "flex-row-reverse justify-content-end" }}">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">{{ __('global.inactive') }}</label>
                                                <input class="form-check-input mx-2" type="checkbox" role="switch" id="flexSwitchCheckDefault" wire:model.live="filters.active">
                                                <label class="form-check-label" for="flexSwitchCheckDefault">{{ __('global.active') }}</label>
                                            </div>
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
                            <th scope="col">{{ __('global.title') }}</th>
                            <th scope="col">{{ __('global.is_active') }}</th>
                            <th scope="col">{{ __('global.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($members as $key => $member)
                            <tr>
                                <th scope="row">{{  ($members->currentpage()-1) * $members->perpage() + $key + 1 }}</th>
                                <td class="text-nowrap cursor-pointer" wire:click="edit({{ $member->id }}, {{ $member->type }})">{{ $member->full_name }}</td>
                                <td>{{ $member->phone }}</td>
                                <td class="text-nowrap">{{ $member->email ?: "-" }}</td>
                                <td class="text-nowrap">{{ $member->title ?: "-" }}</td>
                                <td class="text-nowrap text-center">
                                    <div class="form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" @checked($member->is_active) wire:click="changeActiveStatus({{ $member->id }})">
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex">
                                        <i class="cursor-pointer ti ti-trash text-danger ms-2" data-bs-toggle="tooltip" data-bs-placement="top" onclick="Custom.deleteItemList({{$member->id}})" title="{{ __('global.delete') }}"></i>
                                        <i class="cursor-pointer ti ti-pencil text-warning ms-2" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="edit({{ $member->id }}, {{ $member->type }})" title="{{ __('global.edit') }}"></i>
                                        {{-- <i class="cursor-pointer ti ti-eye" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="show({{ $member->id }}, {{ $member->type }})" title="{{ __('global.show') }}"></i> --}}
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $members->links() }}
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(`#register_start`).pDatepicker({
            format: 'YYYY-MM-DD',
            autoClose: true,
            onSelect: function(unix) {
                var propertyName = $(this).data('property');
                console.log(propertyName);
                @this.set(`filters.register_start`, new persianDate(unix).format('YYYY-MM-DD'), true);
            }
        });
        $(`#register_end`).pDatepicker({
            format: 'YYYY-MM-DD',
            autoClose: true,
            onSelect: function(unix) {
                var propertyName = $(this).data('property');
                console.log(propertyName);
                @this.set(`filters.register_end`, new persianDate(unix).format('YYYY-MM-DD'), true);
            }
        });
    </script>
@endpush