<div class="container-fluid">
    <livewire:admin.components.live-breadcrumb :items="[['title' => 'لیست سفارش ها', 'route' => route('admin.orders.index')], ['title' => 'ویرایش سفارش']]" />
    <div class="card">
        <div class="card-body">
            <h3 class="">ویرایش سفارش</h3>
            <div>
                <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
                    data-sidebar-position="fixed" data-header-position="fixed">
                    <div class="d-flex align-items-center justify-content-center w-100">
                        <div class="row justify-content-center w-100">
                            <div class="col-md-12">
                                <div class="card mb-3 mt-3">
                                    <div class="card-body">

                                        {{-- @if (count($errors->messages()))
                                            <div class="alert alert-warning" role="alert">
                                                لطفا گزینه های ستاره دار را تکمیل نمایید تا اطلاعات شما ثبت
                                                گردد.
                                            </div>
                                        @endif --}}
                                        <form wire:submit.prevent="submit" autocomplete="off">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="exampleInputtext1" class="form-label">نوع سفارش*</label>
                                                        <select id="" class="form-control"
                                                            disabled="true"
                                                            wire:model.live="type">
                                                            <option value="">انتخاب نمایید</option>
                                                            @foreach ($types as $key => $value)
                                                                <option value="{{ $key }}">
                                                                    {{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                        <div>
                                                            @error('type')
                                                                {{ $message }}
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="register_date"
                                                            class="form-label">تاریخ ثبت سفارش
                                                            *</label>
                                                        <input type="text"
                                                            class="form-control"
                                                            wire:model.live="data.register_date"
                                                            id="register_date"
                                                            autocomplete="new-password"
                                                            aria-describedby="textHelp"
                                                            data-date="{{ $data['register_date'] ?? "" }}" value="{{ $data['register_date'] ?? "" }}">
                                                        <div>
                                                            @error('data.register_date')
                                                                {{ $message }}
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <div class="" wire:ignore>
                                                        <label for="exampleInputtext1" class="form-label">انتخاب دانش آموز</label>
                                                        <select id="students" class="form-control select2" disabled
                                                            onchange="livewireSelect2('data.student_id', this)">
                                                            <option value="">انتخاب نمایید</option>
                                                            @foreach ($students as $key => $value)
                                                                <option value="{{ $value->id }}">
                                                                    {{ $value->full_name }} ({{  $value->national_code  }})</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div>
                                                        @error('data.student_id')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>
                                                @if ($type === 'tuition')
                                                    <div class="col-md-6 mb-3">
                                                        <div class="" wire:ignore>
                                                            <label for="exampleInputtext1" class="form-label">انتخاب کلاس</label>
                                                            <select id="tuitions" class="form-control select2" disabled
                                                                onchange="livewireSelect2('data.semester_id', this)">
                                                                <option value="">انتخاب نمایید</option>
                                                                @foreach ($semesters as $key => $value)
                                                                    <option value="{{ $value->id }}">
                                                                        {{ $value->course?->title_with_part }} ({{  $value->teacher?->full_name  }})</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div>
                                                            @error('data.semester_id')
                                                                {{ $message }}
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @endif
                                                @if ($type === 'book')
                                                    <div class="col-md-6 mb-3">
                                                        <div class="" wire:ignore>
                                                            <label for="exampleInputtext1" class="form-label">انتخاب کتاب</label>
                                                            <select id="books" class="form-control select2" disabled
                                                                onchange="livewireSelect2('data.book_id', this)">
                                                                <option value="">انتخاب نمایید</option>
                                                                @foreach ($books as $key => $value)
                                                                    <option value="{{ $value->id }}">
                                                                        {{ $value->title }} ({{ __('admin/enums/EnumCourseAges.' . $value->age) }})</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div>
                                                            @error('data.book_id')
                                                                {{ $message }}
                                                            @enderror
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                            
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="exampleInputtext1" class="form-label">مبلغ {{ $type === "tuition" ? "شهریه" : "کتاب" }}( به تومان )
                                                            *</label>
                                                        <input type="number" class="form-control"
                                                            wire:model.live.debounce.800ms="data.order_amount" id="exampleInputtext1"
                                                            aria-describedby="textHelp" placeholder="">
                                                        <div>
                                                            @error('data.order_amount')
                                                                {{ $message }}
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="exampleInputtext1" class="form-label">مبلغ پرداخت شده( به تومان )
                                                            *</label>
                                                        <input type="number" class="form-control"
                                                            wire:model.live.debounce.800ms="data.paid_amount" id="exampleInputtext1"
                                                            aria-describedby="textHelp" placeholder="">
                                                        <div>
                                                            @error('data.paid_amount')
                                                                {{ $message }}
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                @if ($type === 'tuition')
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="exampleInputtext1" class="form-label">شماره قرارداد
                                                                *</label>
                                                            <input type="text" class="form-control" disabled
                                                                wire:model.live.debounce.800ms="data.contract_number" id="exampleInputtext1" min="1"
                                                                aria-describedby="textHelp" placeholder="">
                                                            <div>
                                                                @error('data.contract_number')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                            @if ($type === 'tuition')
                                                <div class="row">
                                                    <div class="align-items-center col-md-12">
                                                        <div class="mb-3">
                                                            <label for="exampleInputtext1"
                                                                class="form-label">نوع قرارداد*</label>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="contract_type" id="inlineRadio1"
                                                                    wire:model.live="data.contract_type"
                                                                    value="{{ \App\Enums\EnumContractTypes::NEW_TERM }}">
                                                                <label class="form-check-label"
                                                                    for="inlineRadio1">{{ __('admin/enums/EnumContractTypes.new_term') }}</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="contract_type" id="inlineRadio2"
                                                                    wire:model.live="data.contract_type"
                                                                    value="{{ \App\Enums\EnumContractTypes::NEW_COURSE }}">
                                                                <label class="form-check-label"
                                                                    for="inlineRadio2">{{ __('admin/enums/EnumContractTypes.new_course') }}</label>
                                                            </div>
                                                        </div>
                                                        <div class="mb-3">
                                                            @error('data.contract_type')
                                                                {{ $message }}
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="exampleInputtext1" class="form-label">نوع پرداخت*</label>
                                                        <select id="" class="form-control"
                                                            wire:model.live="data.payment_type">
                                                            <option value="">انتخاب نمایید</option>
                                                            @foreach ($paymentTypes as $key => $value)
                                                                <option value="{{ $key }}">
                                                                    {{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                        <div>
                                                            @error('data.payment_type')
                                                                {{ $message }}
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                @if (isset($data['payment_type']) && $data['payment_type'] === \App\Enums\EnumPaymentTypes::FULL)
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="exampleInputtext1" class="form-label">نحوه پرداخت*</label>
                                                            <select id="" class="form-control"
                                                                wire:model.live="data.payment_method">
                                                                <option value="">انتخاب نمایید</option>
                                                                @foreach ($paymentMethods as $key => $value)
                                                                    <option value="{{ $key }}">
                                                                        {{ $value }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div>
                                                                @error('data.payment_method')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="exampleInputtext1" class="form-label">وضعیت پرداخت*</label>
                                                        <select id="" class="form-control"
                                                            wire:model.live="data.payment_status">
                                                            <option value="">انتخاب نمایید</option>
                                                            @foreach ($paymentStatuses as $key => $value)
                                                                <option value="{{ $key }}">
                                                                    {{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                        <div>
                                                            @error('data.payment_status')
                                                                {{ $message }}
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                @if (isset($data['payment_type']) && $data['payment_type'] === \App\Enums\EnumPaymentTypes::FULL)
                                                <div class="col-md-6">
                                                    <div class="mb-3">
                                                        <label for="formFile" class="form-label">بارگذاری
                                                            مدارک</label>
                                                        <input class="form-control @error('data.documents') invalid-input @enderror" accept="image/png, image/jpeg"
                                                            wire:model.live="data.documents"
                                                            type="file" id="formFile">
                                                    </div>
                                                    @error('data.documents')
                                                        {{ $message }}
                                                    @enderror
                                                    @if (isset($data['documents']))
                                                        @if(method_exists($data['documents'], 'temporaryUrl'))
                                                            <div class="col-md-12 px-5 mb-3">
                                                                <img src="{{ $data['documents']->temporaryUrl() }}" class="w-100">
                                                            </div>
                                                        @else
                                                            <div class="col-md-12 px-5 mb-3">
                                                                <img src="{{ $data['documents']->getUrl() }}" class="w-100">
                                                                <span class="fs-4 position-absolute text-danger cursor-pointer" wire:click="deleteMedia({{ $data['document_image_1']->id }}, 'document_image_1')"><i class="ti ti-trash"></i></span>
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                                @endif
                                                @if (isset($data['payment_type']) && $data['payment_type'] === \App\Enums\EnumPaymentTypes::INSTALLMENT)
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="installment_date"
                                                                class="form-label">تاریخ موعد هر قسط
                                                                *</label>
                                                            <input type="text"
                                                                class="form-control"
                                                                wire:model.live="data.installment_date"
                                                                id="installment_date"
                                                                autocomplete="new-password"
                                                                aria-describedby="textHelp"
                                                                data-date="{{ $data['installment_date'] ?? "" }}" value="{{ $data['installment_date'] ?? "" }}">
                                                            <div>
                                                                @error('data.installment_date')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="exampleInputtext1" class="form-label">تعداد کل اقساط
                                                                *</label>
                                                            <input type="number" class="form-control"
                                                                wire:model.live.debounce.800ms="data.total_installments" id="exampleInputtext1"
                                                                aria-describedby="textHelp" placeholder="">
                                                            <div>
                                                                @error('data.total_installments')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="mb-3">
                                                            <label for="exampleInputtext1" class="form-label">مبلغ هر قسط
                                                                *</label>
                                                            <input type="number" class="form-control"
                                                                wire:model.live.debounce.800ms="data.installment_amount" id="exampleInputtext1"
                                                                aria-describedby="textHelp" placeholder="">
                                                            <div>
                                                                @error('data.installment_amount')
                                                                    {{ $message }}
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="row">
                                                @includeWhen(isset($data['payment_type']) && $data['payment_type'] === \App\Enums\EnumPaymentTypes::INSTALLMENT ,'livewire.admin.orders.partials.installments-form')
                                            </div>

                                            <div class="row">
                                                <div class="col-md-6">
                                                    <button type="submit"
                                                        class="btn btn-ac-primary w-100 py-8 fs-4 mb-4 rounded-0">
                                                        <span class="spinner-border spinner-border-sm"
                                                            wire:loading></span> ثبت نهایی اطلاعات
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@push('scripts')
    <script>
        $(document).ready(function () {

            $(`#register_date`).pDatepicker({
                format: 'YYYY-MM-DD',
                autoClose: true,
                initialValue : true,
                initialValueType : 'persian',
                onSelect: function(unix) {
                    var propertyName = $(this).data('property');
                    console.log(propertyName);
                    @this.set(`data.register_date`, new persianDate(unix).format('YYYY-MM-DD'), true);
                }
            });

            $('.select2').select2({
                placeholder: 'انتخاب کنید',
                dir: 'rtl',
                containerCssClass: 'select-sm',
                allowClear: !0
            });

            $('#books').val("{{ $data['book_id'] }}").trigger('change');
            $('#tuitions').val("{{ $data['tuition_id'] }}").trigger('change');
            $('#students').val("{{ $data['student_id'] }}").trigger('change');
        });

        function livewireSelect2(component, event) {
            @this.set(component, $(event).val())
        }

        // function livewireSelect2Multi(component, event) {
        //     var selectedValues = [];
        //     $(event).find('option:selected').each(function () {
        //         selectedValues.push($(this).val());
        //     });
        //     @this.set(component, selectedValues)
        // }
    </script>
@endpush

@script
<script>

    $wire.on('select2Initiation', () => {
        console.log('upper section');
        $(document).ready(function () {
            console.log('hit the spot');
            $('#books').select2({
                placeholder: 'انتخاب کنید',
                dir: 'rtl',
                containerCssClass: 'select-sm',
                allowClear: !0
            });
            $('#tuitions').select2({
                placeholder: 'انتخاب کنید',
                dir: 'rtl',
                containerCssClass: 'select-sm',
                allowClear: !0
            });
        });
    })
</script>
@endscript