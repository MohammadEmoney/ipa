<div class="container-fluid">
    <livewire:admin.components.live-breadcrumb :items="[['title' => 'سفارش ها']]" />
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
                <h5 class="card-title fw-semibold mb-4">سفارش ها</h5>
                <button class="btn btn-sm btn-ac-info" wire:click="create">ایجاد سفارش</button>
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
                            <th scope="col">شماره قرارداد</th>
                            <th scope="col">دانش آموز</th>
                            <th scope="col">نوع سفارش</th>
                            <th scope="col">کتاب یا دوره</th>
                            <th scope="col">نوع پرداخت</th>
                            <th scope="col">روش پرداخت</th>
                            <th scope="col">مبلغ اصلی (تومان)</th>
                            <th scope="col">مبلغ پرداخت شده (تومان)</th>
                            <th scope="col">وضعیت پرداخت</th>
                            <th scope="col">تاریخ ثبت</th>
                            <th scope="col">عملیات</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $key => $order)
                        
                            <tr>
                                <th scope="row">{{  ($orders->currentpage()-1) * $orders->perpage() + $key + 1 }}</th>
                                <td wire:click="edit({{ $order->id }})" class="cursor-pointer text-nowrap">{{ $order->contract_number ?: "_" }}</td>
                                <td wire:click="edit({{ $order->id }})" class="cursor-pointer text-nowrap">{{ $order->user?->full_name }}</td>
                                <td wire:click="edit({{ $order->id }})" class="cursor-pointer">{{ __('admin/enums/EnumOrderType.' . $order->type) }}</td>
                                <td wire:click="edit({{ $order->id }})" class="cursor-pointer">{{ $order->type === 'tuition' ? $order->orderable?->course?->title_with_part : $order->orderable?->title }}</td>
                                <td>{{ $order->payment_type ? __('admin/enums/EnumPaymentTypes.' . $order->payment_type) : "-" }}</td>
                                <td class="text-nowrap">{{ $order->payment_method ? __('admin/enums/EnumPaymentMethods.' . $order->payment_method) : "-" }}</td>
                                <td>{{ number_format($order->order_amount) }}</td>
                                <td>{{ number_format($order->paid_amount) }}</td>
                                <td class="text-nowrap">{{ __('admin/enums/EnumOrderPaymentStatus.' . $order->payment_status) }} <i class="ti {{ $order->payment_status === 'clear' ? "ti-checkbox text-success" : "ti-x text-danger" }}"></i></td>
                                <td class="text-nowrap">{{ \Morilog\Jalali\Jalalian::fromDateTime($order->register_date)->format('Y-m-d') }}</td>
                                <td class="d-flex">
                                    <i class="cursor-pointer ti ti-trash text-danger ms-2" data-bs-toggle="tooltip" data-bs-placement="top" onclick="Custom.deleteItemList({{$order->id}})" title="حذف"></i>
                                    <i class="cursor-pointer ti ti-pencil text-warning ms-2" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="edit({{ $order->id }})" title="ویرایش"></i>
                                    {{-- <i class="cursor-pointer ti ti-eye" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="show({{ $order->id }})" title="نمایش"></i> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $orders->links("pagination::bootstrap-5") }}
            </div>
        </div>
    </div>
</div>
