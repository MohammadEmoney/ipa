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
                                @if($step == "register")
                                {{-- <a href="./index.html" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="../assets/images/logos/dark-logo.svg" width="180" alt="">
                                </a> --}}
                                {{-- <p class="text-center">ثبت نام دانش آموزان</p> --}}
                                {{-- @dd($disabledCreate) --}}
                                <ul class="nav nav-tabs justify-content-center register-nav-header" role="tablist">
                                    <li class="nav-item" role="presentation" wire:click="setCuurentTab('student')">
                                        <a class="nav-link active bg-ac-primary text-white rounded-0 text-center" id="simple-tab-0" data-bs-toggle="tab" wire:ignore.self
                                            href="#simple-tabpanel-0" role="tab" aria-controls="simple-tabpanel-0"
                                            aria-selected="true">دانش آموز هستم</a>
                                    </li>
                                    <li class="nav-item" role="presentation" wire:click="setCuurentTab('staff')">
                                        <a class="nav-link bg-black text-white rounded-0 text-center" id="simple-tab-1" data-bs-toggle="tab" wire:ignore.self
                                            href="#simple-tabpanel-1" role="tab" aria-controls="simple-tabpanel-1"
                                            aria-selected="false">کادر اداری و آموزشی هستم</a>
                                    </li>
                                </ul>
                                <div class="tab-content pt-3" id="tab-content">
                                    <div class="tab-pane active" wire:ignore.self id="simple-tabpanel-0" role="tabpanel" aria-labelledby="simple-tab-0">
                                        <h3 class="text-center mb-3">ثبت نام دانش آموزان</h3>
                                        @if(count($errors->messages()))
                                            <div class="alert alert-warning" role="alert">
                                                لطفا گزینه های ستاره دار را تکمیل نمایید تا اطلاعات شما ثبت گردد.
                                            </div>
                                        @endif
                                        @include('livewire.dashboard.components.student-form')
                                    </div>
                                    <div class="tab-pane" id="simple-tabpanel-1" wire:ignore.self role="tabpanel" aria-labelledby="simple-tab-1">
                                        <h3 class="text-center mb-3">ثبت نام کادر اداری</h3>
                                        @if(count($errors->messages()))
                                            <div class="alert alert-warning" role="alert">
                                                لطفا گزینه های ستاره دار را تکمیل نمایید تا اطلاعات شما ثبت گردد.
                                            </div>
                                        @endif
                                        @include('livewire.dashboard.components.staff-form')
                                    </div>
                                </div>
                                <div class="text-center">قبلا ثبت نام کرده ام. <a href="{{ route('login') }}">وارد</a> شوید</div>
                                @elseif($step == 'verify')
                                    <h3 class="fs-5 mb-3 text-center">تایید شماره تلفن</h3>
                                    <form wire:submit.prevent="verification">
                                        <div class="input-group mb-3">
                                            <span class="input-group-text rounded-0 bg-ac-primary text-white p-0 px-1 text-wrap" style="width: 35%">لطفا کد ارسالی به تلفن همراه خود را وارد نمایید</span>
                                            <input type="text" class="form-control rounded-0"  wire:model.live="otp_code" placeholder="مثلا: 1234" aria-label="Username">
                                            <button type="submit" class="btn btn-ac-info form-control rounded-0" @if($disableVerify) disabled @endif>
                                                <div class="{{ $disableVerify ? "" : "blink_me" }}"><span class="spinner-border spinner-border-sm" wire:loading></span> ثبت</div>
                                            </button>
                                        </div>
                                        <div>@error('otp_code') {{ $message }} @enderror</div>
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

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {
        $(".birth_date").pDatepicker({
            format: 'YYYY-MM-DD',
            autoClose: true,
            onSelect: function(unix){
                var propertyName = $(this).data('property');
                @this.set('data.birth_date', new persianDate(unix).format('YYYY-MM-DD'), true);
            }
        });
        $("#register_date").pDatepicker({
            format: 'YYYY-MM-DD',
            autoClose: true,
            onSelect: function(unix){
                var propertyName = $(this).data('property');
                console.log(propertyName);
                @this.set('data.register_date', new persianDate(unix).format('YYYY-MM-DD'), true);
            }
        });
    });
</script>
@endpush

@script
<script>

    $wire.on('selectJobsReference', () => {
        $(document).ready(function () {
            $(`#date_start`).pDatepicker({
                format: 'YYYY-MM-DD',
                autoClose: true,
                onSelect: function(unix) {
                    var propertyName = $(this).data('property');
                    console.log(propertyName);
                    @this.set(`jobs.date_start`, new persianDate(unix).format('YYYY-MM-DD'), true);
                }
            });
            $(`#date_end`).pDatepicker({
                format: 'YYYY-MM-DD',
                autoClose: true,
                onSelect: function(unix) {
                    @this.set(`jobs.date_end`, new persianDate(unix).format('YYYY-MM-DD'), true);
                }
            });
        });
    })
</script>
@endscript
