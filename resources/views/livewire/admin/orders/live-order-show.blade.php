<div class="container-fluid">
    <livewire:admin.components.live-breadcrumb :items="[['title' => __('global.orders'), 'route' => route('admin.orders.index')], ['title' => $title]]" />
    <div class="card">
        <div class="img-placeholder"></div>
        <div class="card-body">
            <div class="d-flex justify-content-between mb-4">
                <h5 class="card-title fw-semibold">{{ $title }}</h5>
                <div class="d-flex">
                    <select id="" class="form-control @error('status') invalid-input @enderror"
                        wire:model.live="status">
                        <option value="">{{ __('global.status') }}</option>
                        @foreach ($statuses as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-sm btn-ac-info me-2" wire:click="confirm()">{{ __('global.confirm') }}</button>
                    <button class="btn btn-sm btn-warning me-2" wire:click="disprove()">{{ __('global.disprove') }}</button>
                </div>
            </div>
            <div>
                <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
                            data-sidebar-position="fixed" data-header-position="fixed">
                    <div class="card">
                        <div class="card-body">
                            <div class="row mb-3">
                                @if ($user)
                                    <div class="col-md-3 col-6 mb-3 text-center">
                                        {{ __('global.first_name') }}: <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}">{{ $user->first_name }}</a>
                                    </div>
                                    <div class="col-md-3 col-6 mb-3 text-center">
                                        {{ __('global.last_name') }}: <a href="{{ route('admin.users.edit', ['user' => $user->id]) }}">{{ $user->last_name }}</a>
                                    </div>
                                    <div class="col-md-3 col-6 mb-3 text-center">
                                        {{ __('global.phone_number') }}: <span @cannot('user_view_mobile') class="phone-number" @endcannot dir="ltr">{{ $user->phone }}</span>
                                    </div>
                                @endif
                            </div>
    
                            {{-- <div class="row">
                                <div class="col-md-10 col-12 mb-3 table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center" scope="col">ویرایش اطلاعات</th>
                                                <th class="text-center" scope="col">مشاهده کارنامه</th>
                                                <th class="text-center" scope="col">مشاهده سایر دوره ها</th>
                                                <th class="text-center" scope="col">مشاهده امور مالی</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center"><i class="cursor-pointer ti ti-click ms-2" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="edit({{ $user->id }}, {{ $user->type }})" title="ویرایش"></i></td>
                                                <td class="text-center"><i class="cursor-pointer ti ti-click ms-2" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="reportCard({{ $user->id }}, {{ $user->type }})" title="کارنامه"></i></td>
                                                <td class="text-center"><i class="cursor-pointer ti ti-click ms-2" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="courses({{ $user->id }}, {{ $user->type }})" title="سایر دوره ها"></i></td>
                                                <td class="text-center"><i class="cursor-pointer ti ti-click ms-2" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="finances({{ $user->id }}, {{ $user->type }})" title="امور مالی"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col text-center">
                                    <img src="{{ $user->getFirstMediaUrl('personal_image') }}" alt="" class="img-fluid" style="max-height: 110px">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 mb-3 table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center" scope="col">نام ترم جاری</th>
                                                <th class="text-center" scope="col">نام استاد</th>
                                                <th class="text-center" scope="col">ارسال اطلاعات</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">{{ $user->current_semester_title }}</td>
                                                <td class="text-center">{{ $user->current_semester_teacher }}</td>
                                                <td class="text-center"><i class="cursor-pointer ti ti-click ms-2" data-bs-toggle="tooltip" data-bs-placement="top" wire:click="sendMessagesModal({{ $user->id }}, {{ $user->type }})" title="ویرایش"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div> --}}
                            <div class="row g-0">
                                <div class="col-md-3 text-center align-content-center border">
                                    {{ __('global.order_status') }}
                                </div>
                                <div class="border col-md-9 table-responsive p-4">
                                    <table class="mb-0 table table-bordered">
                                        <tbody>
                                            <tr class="{{ $order->status === 'completed' ? "bg-success" : "bg-danger"}}">
                                                <td class="text-center p-1 text-white">{{ __('admin/enums/EnumOrderStatus.' . $order->status) }}</td>
                                                <td class="text-center p-1"><i class="ti {{ $order->status === 'completed' ? "ti-checkbox" : "ti-x" }}"></i></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row g-0">
                                <div class="col-md-3 text-center align-content-center border">
                                    {{ __('global.order_amount') }}
                                </div>
                                <div class="col-md-9 table-responsive">
                                    <table class="mb-0 table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    {{ number_format($order->order_amount ?: 0) }} {{ __('global.toman') }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row g-0">
                                <div class="col-md-3 text-center align-content-center border">
                                    {{ __('global.payable_amount') }}
                                </div>
                                <div class="col-md-9 table-responsive">
                                    <table class="mb-0 table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    {{ number_format($order->payable_amount ?: 0) }} {{ __('global.toman') }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row g-0">
                                <div class="col-md-3 text-center align-content-center border">
                                    {{ __('global.tracking_code') }}
                                </div>
                                <div class="col-md-9 table-responsive">
                                    <table class="mb-0 table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    {{ $order->track_number ?: "-" }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row g-0">
                                <div class="col-md-3 text-center align-content-center border">
                                    {{ __('global.payment_method') }}
                                </div>
                                <div class="col-md-9 table-responsive">
                                    <table class="mb-0 table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    {{ $order->payment_method ? __("admin/enums/EnumPaymentMethods." . $order->payment_method) : "-" }}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="row g-0">
                                <div class="col-md-3 text-center align-content-center border">
                                    {{ __('global.bank_transfer_receipt') }}
                                </div>
                                <div class="col-md-9 table-responsive">
                                    <table class="mb-0 table table-bordered">
                                        <tbody>
                                            <tr>
                                                <td>
                                                    @if ($order->getFirstMediaUrl('bankReceipt'))
                                                        <img src="{{ $order->getFirstMediaUrl('bankReceipt') }}" alt="Thumbnail" class="img-thumbnail" id="img-thumbnail">
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="img-modal" class="img-modal">
        <span class="close-btn" id="close-btn">&times;</span>
        <img class="img-modal-content" id="img01">
    </div>
</div>


@push('scripts')
    <script>
        $(document).ready(function() {
            $('.phone-number').each(function() {
                var phoneNumber = $(this).text();
                var hiddenNumber = phoneNumber.substring(0, 4) + '*****' + phoneNumber.substring(9);
                $(this).text(hiddenNumber);

                $(this).on('click', function() {
                    window.location.href = 'tel:' + phoneNumber;
                });
            });
            $('.national-code').each(function() {
                var nationalCode = $(this).text();
                var hiddenNumber = nationalCode.substring(0, 4) + '*****' + nationalCode.substring(8);
                $(this).text(hiddenNumber);
            });
        });
    </script>
@endpush
