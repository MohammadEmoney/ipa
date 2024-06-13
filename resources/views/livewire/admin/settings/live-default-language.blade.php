<div class="ms-4">
    <a wire:click="setDefaultLang('en', '{{ Route::current()->getName() }}')" class="btn-square text-white me-2 cursor-pointer"><span class="fi fi-gb {{ app()->getLocale() == 'en' ? "border border-1 border-success" : "" }}"></span></a>
    <a wire:click="setDefaultLang('ar', '{{ Route::current()->getName() }}')" class="btn-square text-white me-2 cursor-pointer"><span class="fi fi-sa {{ app()->getLocale() == 'ar' ? "border border-1 border-success" : "" }}"></span></a>
    <a wire:click="setDefaultLang('fa', '{{ Route::current()->getName() }}')" class="btn-square text-white me-2 cursor-pointer"><span class="fi fi-ir {{ app()->getLocale() == 'fa' ? "border border-1 border-success" : "" }}"></span></a>
</div>
