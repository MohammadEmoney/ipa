<div class="container-fluid">
    <livewire:admin.components.live-breadcrumb :items="[['title' => __('global.permissions')]]" />
    <div class="card">
        <div class="card-body">
            <h3 class="">{{ $title }}</h3>
            <div>

                <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6"
                    data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
                    <div class="d-flex align-items-center justify-content-center w-100">
                        <div class="row justify-content-center w-100">
                            <div class="col-md-12">
                                <div class="card mb-3 mt-3">
                                    <form wire:submit.prevent="submit">
                                        <div class="card-body">

                                            {{-- @if (count($errors->messages()))
                                                    <div class="alert alert-warning" role="alert">
                                                        لطفا گزینه های ستاره دار را تکمیل نمایید تا اطلاعات شما ثبت
                                                        گردد.
                                                    </div>
                                                @endif --}}

                                                <div class="accordion" id="accordionExample">
                                                    @foreach ($roles as $role)
                                                        <div class="accordion-item">
                                                            <h2 class="accordion-header" id="heading{{ $role->name }}" wire:ignore>
                                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $role->name }}" aria-expanded="false" aria-controls="collapse{{ $role->name }}">
                                                                {{  __('admin/globals.role_names.' . $role->name) }}
                                                                </button>
                                                            </h2>
                                                            <div id="collapse{{ $role->name }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $role->name }}" data-bs-parent="#accordionExample" wire:ignore.self>
                                                                <div class="accordion-body">
                                                                    <div class="row">
                                                                        <div class="col-12 mb-3">
                                                                            <div class="form-check form-check-inline">
                                                                                <input class="form-check-input" type="checkbox" wire:click="selectAll({{$role->id}})" id="inlineCheckbox1" wire:model="selectedAll.{{ $role->id }}" value="1">
                                                                                <label class="form-check-label" for="inlineCheckbox1">{{ __('global.select_all') }}</label>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        @foreach ($permissions as $permission)
                                                                            <div class="col-md-3">
                                                                                <div class="mb-3">
                                                                                    <div class="form-check">
                                                                                        <input class="form-check-input" type="checkbox" wire:model="selectedPermissions.{{ $role->id }}.{{ $permission->id }}"
                                                                                            value="{{ $permission->id }}" id="flexCheckDefault_{{ $role->id }}_{{ $permission->id }}">
                                                                                        <label class="form-check-label" for="flexCheckDefault_{{ $role->id }}_{{ $permission->id }}">
                                                                                            {{ __('admin/permissions.' . $permission->name) }}
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>

                                                                    {{-- <div class="row">
                                                                        <div class="col-md-6">
                                                                            <div class="mb-3">
                                                                                <label for="exampleInputtext1"
                                                                                    class="form-label">نقش کاربر *</label>
                                                                                <select id="" class="form-control"
                                                                                    wire:model.live="data.role">
                                                                                    <option value="">انتخاب نمایید</option>
                                                                                    @foreach ($roles as $value)
                                                                                        <option value="{{ $value->name }}">{{ __('admin/globals.role_names.' . $value->name) }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                                <div>
                                                                                    @error('data.role')
                                                                                        {{ $message }}
                                                                                    @enderror
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <ul>
                                                                            @foreach ($roles as $role)
                                                                                <li>{{ $role->name }}</li>
                                                                            @endforeach
                                                                        </ul>
                                                                    </div> --}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button type="submit" {{-- @if ($disabledCreate) disabled @endif --}}
                                                    class="btn btn-ac-primary w-100 py-8 fs-4 mb-4 rounded-0 {{ $disabledCreate ? '' : 'blink_me' }}">
                                                    <span class="spinner-border spinner-border-sm" wire:loading></span> ثبت
                                                    نهایی اطلاعات
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
