<div>
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden radial-gradient min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body">
                                <h2 class="text-center fs-5 mb-4">ورود به حساب کاربری</h2>
                                {{-- <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="/panel/src/assets/images/logos/dark-logo.svg" width="180" alt="">
                                </a> --}}
                                {{-- <p class="text-center">آموزشگاه برتر</p> --}}
                                @if($step == 'send_code')
                                <form wire:submit.prevent="sendCode">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text rounded-0 bg-ac-primary text-white">لطفا کد ملی خود را وارد نمایید</span>
                                        <input type="text" class="form-control rounded-0"  wire:model.live="national_code" placeholder="مثلا: 0123456789" aria-label="Username">
                                        {{-- <input type="submit" class="btn btn-ac-info form-control rounded-0" value="ثبت"> --}}
                                        <button type="submit" class="btn btn-ac-info form-control rounded-0" @if($disableSend) disabled @endif>
                                            <div class="{{ $disableSend ? "" : "blink_me" }}"><span class="spinner-border spinner-border-sm" wire:loading></span> ثبت</div>
                                        </button>
                                    </div>
                                    <div>@error('national_code') {{ $message }} @enderror</div>
                                    {{-- <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">شماره ملی</label>
                                        <input type="text" class="form-control text-start" wire:model="national_code" id="exampleInputEmail1"
                                            aria-describedby="emailHelp">
                                        <div>@error('national_code') {{ $message }} @enderror</div>
                                    </div> --}}
                                    {{-- <div class="mb-4">
                                        <label for="exampleInputPassword1" class="form-label">پسوورد</label>
                                        <input type="password" class="form-control" id="exampleInputPassword1">
                                    </div> --}}
                                    {{-- <div class="d-flex align-items-center justify-content-between mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input primary" type="checkbox" value=""
                                                id="flexCheckChecked" checked>
                                            <label class="form-check-label text-dark" for="flexCheckChecked">
                                                Remeber this Device
                                            </label>
                                        </div>
                                        <a class="text-primary fw-bold" href="./index.html">فراموشی رمز عبور</a>
                                    </div> --}}

                                    {{-- <a href="./index.html" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">ورود</a> --}}
                                    <div class="d-flex align-items-center justify-content-center">
                                        <p class="fs-4 mb-0 fw-bold">ثبت نام</p>
                                        <a class="text-primary fw-bold ms-2" href="{{ route('register') }}">ایجاد حساب کاربری</a>
                                    </div>
                                </form>
                                @elseif($step == 'verify')
                                    <form wire:submit.prevent="verification">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text rounded-0 bg-ac-primary text-white p-0 px-1 text-wrap" style="width: 35%">لطفا کد ارسالی به تلفن همراه خود را وارد نمایید</span>
                                            <input type="text" class="form-control rounded-0"  wire:model="otp_code" placeholder="مثلا: 1234" aria-label="Username">
                                            <button type="submit" class="btn btn-ac-info form-control rounded-0" @if($disableVerify) disabled @endif>
                                                <div class="{{ $disableVerify ? "" : "blink_me" }}"><span class="spinner-border spinner-border-sm" wire:loading></span> ثبت</div>
                                            </button>
                                        </div>
                                        <div>@error('otp_code') {{ $message }} @enderror</div>
                                        {{-- <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">کد چهار رقمی</label>
                                            <input type="text" class="form-control text-start" wire:model="otp_code" id="exampleInputEmail1"
                                                aria-describedby="emailHelp">
                                            <div>@error('otp_code') {{ $message }} @enderror</div>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">ورود</button> --}}
                                        <div class="d-flex align-items-center justify-content-center">
                                            <p class="fs-4 mb-0 fw-bold">ثبت نام</p>
                                            <a class="text-primary fw-bold ms-2" href="{{ route('register') }}">ایجاد حساب کاربری</a>
                                        </div>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


