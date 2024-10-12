<div class="container-fluid">
    <livewire:admin.components.live-breadcrumb :items="[['title' => $title]]" />
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
                <h5 class="card-title fw-semibold mb-4">{{ $title }}</h5>
                <button class="btn btn-sm btn-ac-info" wire:click="create">{{ __('global.create_order') }}</button>
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
                                            <label for="exampleInputtext1" class="form-label"></label>
                                            <select id="" class="form-control @error('filters.payment_method') invalid-input @enderror"
                                                wire:model.live="filters.payment_method">
                                                <option value="">{{ __('global.payment_method') }}</option>
                                                @foreach ($paymentMethods as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                            <div>
                                                @error('filters.payment_method')
                                                    {{ $message }}
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="mb-3">
                                            <label for="exampleInputtext1" class="form-label"></label>
                                            <select id="" class="form-control @error('filters.status') invalid-input @enderror"
                                                wire:model.live="filters.status">
                                                <option value="">{{ __('global.status') }}</option>
                                                @foreach ($statuses as $key => $value)
                                                    <option value="{{ $key }}">{{ $value }}</option>
                                                @endforeach
                                            </select>
                                            <div>
                                                @error('filters.status')
                                                    {{ $message }}
                                                @enderror
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
                            <th scope="col">{{ __('global.tracking_code') }}</th>
                            <th scope="col">{{ __('global.user_name') }}</th>
                            <th scope="col">{{ __('global.payment_method') }}</th>
                            <th scope="col">{{ __('global.order_amount') }} ({{ __('global.toman') }})</th>
                            {{-- <th scope="col">{{ __('global.payable_amount') }} ({{ __('global.toman') }})</th> --}}
                            <th scope="col">{{ __('global.order_status') }}</th>
                            <th scope="col">{{ __('global.date_registerd') }}</th>
                            <th scope="col">{{ __('global.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $key => $order)
                            <tr>
                                <th scope="row">{{  ($orders->currentpage()-1) * $orders->perpage() + $key + 1 }}</th>
                                <td wire:click="show({{ $order->id }})" class="cursor-pointer text-nowrap">{{ $order->track_number ?: "_" }}</td>
                                <td wire:click="editUser({{ $order->user?->id }})" class="cursor-pointer text-nowrap">{{ $order->user?->full_name }}</td>
                                <td class="text-nowrap">{{ $order->payment_method ? __('admin/enums/EnumPaymentMethods.' . $order->payment_method) : "-" }}</td>
                                <td>{{ number_format($order->order_amount) }}</td>
                                {{-- <td>{{ number_format($order->payable_amount) }}</td> --}}
                                <td class="text-nowrap">{{ __('admin/enums/EnumOrderStatus.' . $order->status) }} <i class="ti {{ $order->status === 'completed' ? "ti-checkbox text-success" : "ti-x text-danger" }}"></i></td>
                                <td class="text-nowrap">{{ \Morilog\Jalali\Jalalian::fromDateTime($order->register_date)->format('Y-m-d') }}</td>
                                <td class="text-nowrap">
                                    <i class="cursor-pointer ti ti-trash text-danger ms-2" data-bs-toggle="tooltip" data-bs-placement="top" onclick="Custom.deleteItemList({{$order->id}})" title="حذف"></i>
                                    {{-- <i class="cursor-pointer ti ti-pencil text-warning ms-2" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="edit({{ $order->id }})" title="ویرایش"></i> --}}
                                    <i class="cursor-pointer ti ti-eye text-primary" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="show({{ $order->id }})" title="نمایش"></i>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
