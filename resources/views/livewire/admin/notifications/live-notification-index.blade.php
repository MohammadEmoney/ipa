<div class="container-fluid">
    <livewire:admin.components.live-breadcrumb :items="[['title' => $title]]" />
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
                <h5 class="card-title fw-semibold mb-4">{{ $title }}</h5>
                <button class="btn btn-sm btn-info" wire:click="create">{{ __('global.create_notification') }}</button>
            </div>
            <div class="table-responsive">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" class="form-control btn-info" wire:model.live.debounce.600="search" placeholder="{{ __('global.search') }} ...">
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
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('global.title') }}</th>
                            <th scope="col">{{ __('global.slug') }}</th>
                            {{-- <th scope="col">{{ __('global.lang') }}</th> --}}
                            <th scope="col">{{ __('global.created_by') }}</th>
                            <th scope="col">{{ __('global.created_at') }}</th>
                            <th scope="col">{{ __('global.active') }}</th>
                            <th scope="col">{{ __('global.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($notifications as $key => $notification)
                        
                            <tr>
                                <th scope="row">{{  ($notifications->currentPage()-1) * $notifications->perPage() + $key + 1 }}</th>
                                <td wire:click="edit({{ $notification->id }})" class="cursor-pointer text-nowrap">{{ $notification->notifiable_type ?: "_" }}</td>
                                <td class="text-nowrap">{{ \Morilog\Jalali\Jalalian::fromDateTime($notification->created_at)->format('Y-m-d') }}</td>
                                <td>{{ json_decode($notification->data, true)['username'] }}</td>
                                <td class="text-nowrap">
                                    <i class="cursor-pointer ti ti-trash text-danger ms-2" data-bs-toggle="tooltip" data-bs-placement="top" onclick="Custom.deleteItemList({{$notification->id}})" title="{{ __('global.delete') }}"></i>
                                    <i class="cursor-pointer ti ti-pencil text-warning ms-2" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="edit({{ $notification->id }})" title="{{ __('global.edit') }}"></i>
                                    <i class="cursor-pointer ti ti-cloud-download" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="download({{ $notification->id }})" title="{{ __('global.download') }}"></i>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $notifications->links() }}
            </div>
        </div>
    </div>
</div>
