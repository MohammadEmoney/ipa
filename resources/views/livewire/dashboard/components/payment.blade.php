<h5 class="text-center">{{ __('global.membership_fee') }}</h5>
<form wire:submit.prevent="pay">
    <div class="row">
        <div class="col-md-12 text-center">
            <p>{{ $settings['membership_description'] ?? "" }}</p>
            <h3><i class="bi bi-cash-stack text-warning"></i> {{ number_format($orderAmount ?? 0) }} {{ __('global.toman') }}</h3>
        </div>
    </div>
    <div class="form-group mb-3">
        <select class="form-control" wire:model.live="data.payment_method" id="">
            <option value="">{{ __('global.payment_method') }}</option>
            @foreach ($settings['payment_via'] ?? [] as $paymentMethod)
                <option value="{{ $paymentMethod }}">{{ \App\Enums\EnumPaymentMethods::trans($paymentMethod) }}</option>
            @endforeach
        </select>
    </div>
    @isset($data['payment_method'])
        @if($data['payment_method'] === 'credit_card')
            <p>{!! __('messages.card_to_card_title', ['price' => number_format($orderAmount ?? 0)]) !!}</p>
            <p>{{ __('global.card_number') }}: <span class="fw-bold" dir="ltr">{{ $settings['card_number'] ?? "" }}</span></p>
            <p>{{ __('global.card_owner') }}: <span class="fw-bold">{{ $settings['card_owner'] ?? "" }}</span></p>

            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="mb-3 upload-file">
                        <label for="formFile" class="form-label">{{ __('global.bank_transfer_receipt') }} <i class="bi bi-cloud-arrow-up-fill"></i>
                        </label>
                        <input class="form-control @error('data.bankReceipt') invalid-input @enderror" accept="image/png, image/jpeg"
                            wire:model.live="data.bankReceipt"
                            type="file" id="formFile">
                    </div>
                    @error('data.bankReceipt')
                        {{ $message }}
                    @enderror
                </div>
                @if (isset($data['bankReceipt']))
                    @if(method_exists($data['bankReceipt'], 'temporaryUrl'))
                        <div class="col-md-6 px-5 mb-3">
                            <img src="{{ $data['bankReceipt']->temporaryUrl() }}" class="w-100" style="max-height: 20em">
                        </div>
                    @endif
                @endif
            </div>

            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" >
                        <span class="spinner-border spinner-border-sm" wire:loading></span> {{ __('global.payment_announcement') }}
                    </button>
                </div>
            </div>
        @elseif ($data['payment_method'] ?? "-" === "online")
            <div class="row">
                <div class="col-md-12">
                    <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2" >
                        <span class="spinner-border spinner-border-sm" wire:loading></span> {{ __('global.pay') }}
                    </button>
                </div>
            </div>
        @endif
    @endisset
</form>
