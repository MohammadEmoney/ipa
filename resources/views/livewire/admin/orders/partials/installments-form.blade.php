<div class="card">
    <div class="card-header bg-transparent">
        <h3>اقساط</h3>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 mb-3">
                <div class="form-check form-check-inline">
                    <input class="form-check-input"
                        type="checkbox"
                        wire:model.live="installments.pre_paid"
                        wire:click="loadDatePicker"
                        id="inlineCheckbox1"
                        value="1">
                    <label class="form-check-label"
                        for="inlineCheckbox1">پیش پرداخت</label>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleInputtext1"
                        class="form-label">عنوان قسط
                        *</label>
                    <input type="text"
                        class="form-control"
                        wire:model.live="installments.title"
                        id="exampleInputtext1"
                        aria-describedby="textHelp">
                    <div>
                        @error('installments.title')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleInputtext1"
                        class="form-label">شماره قسط
                        *</label>
                    <input type="text"
                        class="form-control"
                        @if (!isset($installments['pre_paid']) || !$installments['pre_paid'])
                        wire:model.live="installments.installment_number"
                        @else
                        disabled="true"
                        @endif
                        id="exampleInputtext1"
                        aria-describedby="textHelp">
                    <div>
                        @error('installments.installment_number')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="date_paid"
                        class="form-label">تاریخ پرداخت
                        *</label>
                    <input type="text"
                        class="form-control"
                        wire:model.live="installments.date_paid"
                        id="date_paid"
                        aria-describedby="textHelp"
                        data-date="{{ $installments['date_paid'] ?? "" }}" value="{{ $installments['date_paid'] ?? "" }}">
                    <div>
                        @error('installments.date_paid')
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
                        wire:model.live.debounce.800ms="installments.amount" id="exampleInputtext1"
                        aria-describedby="textHelp" placeholder="">
                    <div>
                        @error('installments.amount')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleInputtext1" class="form-label">نحوه پرداخت*</label>
                    <select id="" class="form-control"
                        wire:model.live="installments.payment_method">
                        <option value="">انتخاب نمایید</option>
                        @foreach ($paymentMethods as $key => $value)
                            <option value="{{ $key }}">
                                {{ $value }}</option>
                        @endforeach
                    </select>
                    <div>
                        @error('installments.payment_method')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="exampleInputtext1" class="form-label">وضعیت پرداخت*</label>
                    <select id="" class="form-control"
                        wire:model.live="installments.payment_status">
                        <option value="">انتخاب نمایید</option>
                        @foreach ($paymentStatuses as $key => $value)
                            <option value="{{ $key }}">
                                {{ $value }}</option>
                        @endforeach
                    </select>
                    <div>
                        @error('installments.payment_status')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="formFile" class="form-label">بارگذاری
                        مدارک</label>
                    <input class="form-control @error('installments.documents') invalid-input @enderror" accept="image/png, image/jpeg"
                        wire:model.live="installments.documents"
                        type="file" id="formFile">
                </div>
                @error('installments.documents')
                    {{ $message }}
                @enderror
                @if (isset($installments['documents']))
                    @if(method_exists($installments['documents'], 'temporaryUrl'))
                        <div class="col-md-6 m-auto mb-3 px-5">
                            <img src="{{ $installments['documents']->temporaryUrl() }}" class="w-100">
                        </div>
                    @else
                        <div class="col-md-6 m-auto mb-3 px-5">
                            <img src="{{ $installments['documents']->getUrl() }}" class="w-100">
                            <span class="fs-4 position-absolute text-danger cursor-pointer" wire:click="deleteMedia({{ $installments['document_image_1']->id }}, 'document_image_1')"><i class="ti ti-trash"></i></span>
                        </div>
                    @endif
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="mb-3">
                    <label for="exampleInputtext1"
                        class="form-label">توضیحات</label>
                    <textarea class="form-control" wire:model.live="installments.description" id="" cols="10" rows="10"
                        style="height: 60px;"></textarea>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                @if (!is_null($editingInstallmentId))
                    <button type="button" wire:click="updateInstallment"
                        class="btn btn-dark w-100 py-8 fs-4 mb-4 rounded-0">
                        ویرایش قسط
                    </button>
                @else
                    <button type="button" wire:click="addInstallment"
                        class="btn btn-dark w-100 py-8 fs-4 mb-4 rounded-0">
                        ثبت موقت قسط
                    </button>
                @endif
            </div>
        </div>
    </div>
        @include('livewire.admin.orders.partials.installments-list')
</div>

@push('scripts')
    <script>
        $(`#date_paid`).pDatepicker({
            format: 'YYYY-MM-DD',
            autoClose: true,
            onSelect: function(unix) {
                var propertyName = $(this).data('property');
                console.log(propertyName);
                @this.set(`installments.date_paid`, new persianDate(unix).format('YYYY-MM-DD'), true);
            }
        });
    </script>
@endpush
