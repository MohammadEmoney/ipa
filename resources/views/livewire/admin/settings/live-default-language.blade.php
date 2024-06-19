<div class="ms-4">
    <a href="{{ \App\Generators\CustomUrlGenerator::localeRoute('en') }}" class="btn-square text-white me-2 cursor-pointer"><span class="fi fi-gb {{ app()->getLocale() == 'en' ? "border border-1 border-success" : "" }}"></span></a>
    {{-- <a wire:click="setDefaultLang('ar', '{{ url()->current() }}')" class="btn-square text-white me-2 cursor-pointer"><span class="fi fi-sa {{ app()->getLocale() == 'ar' ? "border border-1 border-success" : "" }}"></span></a> --}}
    <a href="{{ \App\Generators\CustomUrlGenerator::localeRoute('fa') }}" class="btn-square text-white me-2 cursor-pointer"><span class="fi fi-ir {{ app()->getLocale() == 'fa' ? "border border-1 border-success" : "" }}"></span></a>
</div>
