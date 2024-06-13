<div class="card">
    <div class="card-body">
        <h3 class="">ثبت نام {{ $type == "student" ? "دانش آموز" : "کادر اداری"}}</h3>
        <div>
            <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
                data-sidebar-position="fixed" data-header-position="fixed">
                <div class="d-flex align-items-center justify-content-center w-100">
                    <div class="row justify-content-center w-100">
                        <div class="col-md-12">
                            <div class="card mb-3 mt-3">
                                <div class="card-body">
                                    @if ($type == "student")
                                        @include('livewire.admin.users.components.student-form')
                                    @endif
                                    @if($type == "staff")
                                        @include('livewire.admin.users.components.staff-form')
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@if($type == "student")
    @push('scripts')
        <script type="text/javascript">
            $(document).ready(function() {
                $("#student_birth_date").pDatepicker({
                    format: 'YYYY-MM-DD',
                    autoClose: true,
                    onSelect: function(unix) {
                        var propertyName = $(this).data('property');
                        @this.set('data.birth_date', new persianDate(unix).format('YYYY-MM-DD'), true);
                    }
                });
            });

            $("#register_date").pDatepicker({
                format: 'YYYY-MM-DD',
                autoClose: true,
                onSelect: function(unix) {
                    var propertyName = $(this).data('property');
                    @this.set('data.register_date', new persianDate(unix).format('YYYY-MM-DD'), true);
                }
            });
        </script>
    @endpush
@endif
@if($type == "staff")
@push('scripts')
    <script>
        $(document).ready(function () {
            $("#student_birth_date").pDatepicker({
                format: 'YYYY-MM-DD',
                autoClose: true,
                onSelect: function(unix) {
                    var propertyName = $(this).data('property');
                    @this.set('data.birth_date', new persianDate(unix).format('YYYY-MM-DD'), true);
                }
            });
            $("#staff_birth_date").pDatepicker({
                format: 'YYYY-MM-DD',
                autoClose: true,
                onSelect: function(unix) {
                    var propertyName = $(this).data('property');
                    @this.set('data.birth_date', new persianDate(unix).format('YYYY-MM-DD'), true);
                }
            });

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
                    var propertyName = $(this).data('property');
                    console.log(propertyName);
                    @this.set(`jobs.date_end`, new persianDate(unix).format('YYYY-MM-DD'), true);
                }
            });
        });
    </script>
@endpush
@endif
