<div class="container-fluid">
    <livewire:admin.components.live-breadcrumb :items="[['title' => $title]]" />
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
                <h5 class="card-title fw-semibold mb-4">{{ $title }}</h5>
                <button class="btn btn-sm btn-info" wire:click="create">{{ __('global.create_airline') }}</button>
            </div>
            <div class="table-responsive">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" class="form-control btn-info" wire:model.live.debounce.600="search" placeholder="{{ __('global.search') }} ...">
                    </div>
                </div>

                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">{{ __('global.title') }}</th>
                            <th scope="col">{{ __('global.title_en') }}</th>
                            <th scope="col">{{ __('global.active') }}</th>
                            <th scope="col">{{ __('global.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($airlines as $key => $airline)
                        
                            <tr>
                                <th scope="row">{{  ($airlines->currentPage()-1) * $airlines->perPage() + $key + 1 }}</th>
                                <td wire:click="edit({{ $airline->id }})" class="cursor-pointer text-nowrap">{{ $airline->title ?: "_" }}</td>
                                <td wire:click="edit({{ $airline->id }})" class="cursor-pointer text-nowrap">{{ $airline->title_en }}</td>
                                <td class="text-nowrap float-end">
                                    <div class="form-check form-switch">
                                        <input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" @checked($airline->is_active) wire:click="changeActiveStatus({{ $airline->id }})">
                                    </div>
                                </td>
                                <td class="text-nowrap">
                                    <i class="cursor-pointer ti ti-trash text-danger ms-2" data-bs-toggle="tooltip" data-bs-placement="top" onclick="Custom.deleteItemList({{$airline->id}})" title="{{ __('global.delete') }}"></i>
                                    <i class="cursor-pointer ti ti-pencil text-warning ms-2" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="edit({{ $airline->id }})" title="{{ __('global.edit') }}"></i>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $airlines->links() }}
            </div>
        </div>
    </div>
</div>
