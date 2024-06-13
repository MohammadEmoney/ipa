
@push('styles')

    <style>
        :root {
            --prm-color: #0381ff;
            --prm-gray: #b1b1b1;
        }
        

        /* CSS */
        .steps {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            position: relative;
        }

        .step-button {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: none;
            background-color: var(--prm-gray);
            transition: .4s;
        }

        .step-button[aria-expanded="true"] {
            width: 60px;
            height: 60px;
            background-color: var(--prm-color);
            color: #fff;
        }

        .done {
            background-color: var(--prm-color);
            color: #fff;
        }

        .step-item {
            z-index: 10;
            text-align: center;
        }

        #progress {
        -webkit-appearance:none;
            position: absolute;
            width: 95%;
            z-index: 5;
            height: 10px;
            margin-left: 18px;
            margin-bottom: 18px;
        }

        /* to customize progress bar */
        #progress::-webkit-progress-value {
            background-color: var(--prm-color);
            transition: .5s ease;
        }

        #progress::-webkit-progress-bar {
            background-color: var(--prm-gray);

        }

        a {
        background-color: #ffff0047;
        }
    </style>
    
@endpush

<div dir="rtl">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">ویرایش پروفایل</h5>
            
            @if ($type == "student")
                @include('livewire.dashboard.profiles.components.student-profile-form')
            @endif
            @if ($type == "staff")
                @include('livewire.dashboard.profiles.components.staff-profile-form')
            @endif
        </div>
    </div>
</div>

@if($errors->any())

<script wire:key="{{ rand() }}">
    console.log('kljsadhflaiksujhdef');
	let firstInvalidInput = document.querySelctor('.invalid-input');
	if(firstInvalidInput)
		firdstInvalidInput.focus();
</script>
@endif

@if($type == "student")
    @script
        <script>
            $wire.on('persianDate', () => {
                $(document).ready(function () {
                    console.log('loadded');
                    $("#birth_date").pDatepicker({
                        format: 'YYYY-MM-DD',
                        autoClose: true,
                        initialValue : true,
                        initialValueType : 'persian',
                        onSelect: function(unix) {
                            var propertyName = $(this).data('property');
                            @this.set('data.birth_date', new persianDate(unix).format('YYYY-MM-DD'), true);
                        }
                    });
                    $("#register_date").pDatepicker({
                        format: 'YYYY-MM-DD',
                        autoClose: true,
                        initialValue : true,
                        initialValueType : 'persian',
                        onSelect: function(unix) {
                            var propertyName = $(this).data('property');
                            @this.set('data.birth_date', new persianDate(unix).format('YYYY-MM-DD'), true);
                        }
                    });
                });
            });
        </script>
    @endscript
    @push('scripts')
        <script type="text/javascript">
            
            $(document).ready(function() {
                $("#birth_date").pDatepicker({
                    format: 'YYYY-MM-DD',
                    autoClose: true,
                    initialValue : true,
                    initialValueType : 'persian',
                    onSelect: function(unix) {
                        var propertyName = $(this).data('property');
                        @this.set('data.birth_date', new persianDate(unix).format('YYYY-MM-DD'), true);
                    }
                });

                $("#register_date").pDatepicker({
                    format: 'YYYY-MM-DD',
                    autoClose: true,
                    initialValue : true,
                    initialValueType : 'persian',
                    onSelect: function(unix) {
                        var propertyName = $(this).data('property');
                        @this.set('data.birth_date', new persianDate(unix).format('YYYY-MM-DD'), true);
                    }
                });

            });
        </script>
    @endpush
@endif
@if($type == "staff")
@push('scripts')

    <script>
        $(document).ready(function () {
            $("#birth_date").pDatepicker({
                format: 'YYYY-MM-DD',
                autoClose: true,
                initialValue : true,
                initialValueType : 'persian',
                onSelect: function(unix) {
                    var propertyName = $(this).data('property');
                    @this.set('data.birth_date', new persianDate(unix).format('YYYY-MM-DD'), true);
                }
            });
            $(`#date_start`).pDatepicker({
                    format: 'YYYY-MM-DD',
                    autoClose: true,
                    initialValue : true,
                    initialValueType : 'persian',
                    onSelect: function(unix) {
                        var propertyName = $(this).data('property');
                        console.log(propertyName);
                        @this.set(`jobs.date_start`, new persianDate(unix).format('YYYY-MM-DD'), true);
                    }
                });
            $(`#date_end`).pDatepicker({
                format: 'YYYY-MM-DD',
                autoClose: true,
                initialValue : true,
                initialValueType : 'persian',
                onSelect: function(unix) {
                    var propertyName = $(this).data('property');
                    console.log(propertyName);
                    @this.set(`jobs.date_end`, new persianDate(unix).format('YYYY-MM-DD'), true);
                }
            });
        });
    </script>
@endpush

@script
<script>

     $wire.on('persianDate', () => {
        $(document).ready(function () {
            console.log('onChnage Loaded PDate');
            $("#birth_date").pDatepicker({
                format: 'YYYY-MM-DD',
                autoClose: true,
                initialValue : true,
                initialValueType : 'persian',
                onSelect: function(unix) {
                    var propertyName = $(this).data('property');
                    @this.set('data.birth_date', new persianDate(unix).format('YYYY-MM-DD'), true);
                }
            });
            $(`#date_start`).pDatepicker({
                    format: 'YYYY-MM-DD',
                    autoClose: true,
                    initialValue : true,
                    initialValueType : 'persian',
                    onSelect: function(unix) {
                        var propertyName = $(this).data('property');
                        console.log(propertyName);
                        @this.set(`jobs.date_start`, new persianDate(unix).format('YYYY-MM-DD'), true);
                    }
                });
            $(`#date_end`).pDatepicker({
                format: 'YYYY-MM-DD',
                autoClose: true,
                initialValue : true,
                initialValueType : 'persian',
                onSelect: function(unix) {
                    var propertyName = $(this).data('property');
                    console.log(propertyName);
                    @this.set(`jobs.date_end`, new persianDate(unix).format('YYYY-MM-DD'), true);
                }
            });
        });
    });

    $wire.on('selectJobsReference', () => {
        $(document).ready(function () {
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
@endif

@script
<script>
    $wire.on('autoFocus', () => {
        $(document).ready(function () {
            console.log('invalid-input Focus');
            $('.invalid-input').focus()
        });
    })
</script>
@endscript
