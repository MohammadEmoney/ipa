{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script> --}}
<script src="/Impact/assets/vendor/jquery/jquery-3.7.1.min.js"></script>
<script src="/Impact/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="/Impact/assets/vendor/aos/aos.js"></script>
<script src="/Impact/assets/vendor/glightbox/js/glightbox.min.js"></script>
<script src="/Impact/assets/vendor/purecounter/purecounter_vanilla.js"></script>
<script src="/Impact/assets/vendor/swiper/swiper-bundle.min.js"></script>
<script src="/Impact/assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
<script src="/Impact/assets/vendor/php-email-form/validate.js"></script>
<script src="/panel/src/assets/libs/sweetalert/sweetalert2.all.js"></script>

@if (App::isLocale('en'))
    <script src="/panel/src/assets/js/alert-en.js"></script>
    <script src="/panel/src/assets/js/custom-en.js"></script>
@else
    <script src="/panel/src/assets/js/alert.js"></script>
    <script src="/panel/src/assets/js/custom.js"></script>
@endif

<!-- Template Main JS File -->
<script src="/Impact/assets/js/main.js"></script>
<script src="/Impact/assets/js/custom.js"></script>
@livewireScripts
