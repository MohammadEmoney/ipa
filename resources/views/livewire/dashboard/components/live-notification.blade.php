<li class="nav-item dropdown">
    <a class="nav-link nav-icon-hover" href="javascript:void(0)" id="drop"
        data-bs-toggle="dropdown" aria-expanded="false">
        <i class=" {{ $count > 0 ? "text-danger ti ti-bell-ringing" : "ti ti-bell" }}"></i>
    </a>
    <div wire:ignore.self class="dropdown-menu {{ app()->getLocale() === 'en' ? "dropdown-menu-end" : "" }} dropdown-menu-animate-up" aria-labelledby="drop2">
        <div class="message-body">
            <a wire:poll wire:click="readNotification()" href="javascript:void(0)" class="d-flex align-items-center gap-2 dropdown-item">
                <i class="ti ti-license fs-6"></i>
                <p class="mb-0 fs-3"> {{ __('global.new_circular') }} {{ $count }}</p>
            </a>
        </div>
    </div>
</li>

