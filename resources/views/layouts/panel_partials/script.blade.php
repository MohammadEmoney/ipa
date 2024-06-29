<script src="/panel/src/assets/libs/jquery/dist/jquery.min.js"></script>
<script src="/panel/src/assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="/panel/src/assets/js/sidebarmenu.js"></script>
<script src="/panel/src/assets/js/app.min.js"></script>
<script src="/panel/src/assets/libs/apexcharts/dist/apexcharts.min.js"></script>
<script src="/panel/src/assets/libs/simplebar/dist/simplebar.js"></script>
<script src="/panel/src/assets/libs/persiandate/persian-date.min.js"></script>
<script src="/panel/src/assets/js/dashboard.js"></script>
<script src="/panel/src/assets/libs/sweetalert/sweetalert2.all.js"></script>
<script src="/panel/src/assets/libs/select2/select2.full.min.js"></script>

<script src="https://unpkg.com/persian-datepicker@latest/dist/js/persian-datepicker.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/tableexport.jquery.plugin@1.28.0/tableExport.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.3/dist/bootstrap-table.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.3/dist/bootstrap-table-locale-all.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-table@1.22.3/dist/extensions/export/bootstrap-table-export.min.js"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<script src="/panel/src/assets/js/num2persion.js" type="text/javascript"></script>
@if (App::isLocale('en'))
    <script src="/panel/src/assets/js/alert-en.js"></script>
    <script src="/panel/src/assets/js/custom-en.js"></script>
@else
    <script src="/panel/src/assets/js/alert.js"></script>
    <script src="/panel/src/assets/js/custom.js"></script>
@endif

<script>
    $(document).ready(function () {
        var dir = "{{ App::isLocale('en') ? "ltr" : "rtl" }}";
        $('.select2').select2({
            placeholder: "{{ __('global.select_item') }}",
            dir: dir,
            containerCssClass: 'select-sm',
            allowClear: !0
        });
    });
</script>

@livewireScripts

@stack('scripts')
