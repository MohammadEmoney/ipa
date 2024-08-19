<div class="card">
    <div class="card-body">
        <h3 class="">{{ $title }}</h3>
        <div>
            <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
                data-sidebar-position="fixed" data-header-position="fixed">
                <div class="d-flex align-items-center justify-content-center w-100">
                    <div class="row justify-content-center w-100">
                        <div class="col-md-12">
                            <div class="card mb-3 mt-3">
                                <div class="card-body">
                                    <form wire:submit.prevent="submit">
                                        <div class="accordion" id="accordionExample">
                                            <div class="accordion-item">
                                              <h2 class="accordion-header" id="headingOne" wire:ignore>
                                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                  {{ __('global.profile') }}
                                                </button>
                                              </h2>
                                              <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample" wire:ignore.self>
                                                <div class="accordion-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="firstNameInputtext1" class="form-label">{{ __('global.first_name') }} *</label>
                                                                <input type="text" class="form-control" wire:model="data.first_name"
                                                                    id="firstNameInputtext1" aria-describedby="textHelp" placeholder="{{ __('global.your_first_name') }}">
                                                                <div>@error('data.first_name') {{ $message }} @enderror</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="lastNameInputtext1" class="form-label">{{ __('global.last_name') }} *</label>
                                                                <input type="text" class="form-control" wire:model="data.last_name"
                                                                    id="lastNameInputtext1" aria-describedby="textHelp" placeholder="{{ __('global.your_last_name') }}">
                                                                <div>@error('data.last_name') {{ $message }} @enderror</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="phoneInputtext1" class="form-label">{{ __('global.phone_number') }}
                                                                    *</label>
                                                                <input type="text" class="form-control" wire:model="data.phone"
                                                                    id="phoneInputtext1" aria-describedby="textHelp" placeholder="09123456789">
                                                                <div>@error('data.phone') {{ $message }} @enderror</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="exampleInputEmail1" class="form-label">{{ __('global.email') }} *</label>
                                                                <input type="email" autocomplete="username" class="form-control" wire:model="data.email"
                                                                    id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="example@email.com">
                                                                <div>@error('data.email') {{ $message }} @enderror</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="mb-3">
                                                                <label for="exampleInputtext1"
                                                                    class="form-label">{{ __('global.job_status') }} *</label>
                                                                <select  id="" class="form-control" wire:model.live="data.situation">
                                                                    <option value="">{{ __('global.select_item') }}</option>
                                                                    @foreach ($situations as $key => $value )
                                                                        <option value="{{ $key }}">{{ $value }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <div>@error('data.situation') {{ $message }} @enderror</div>
                                                            </div>
                                                        </div>
                                                        @if(isset($data['situation']) && $data['situation'] === "student")
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="university" class="form-label">{{ __('global.university_name') }}
                                                                        *</label>
                                                                    <input type="text" class="form-control" wire:model="data.university"
                                                                        id="university" aria-describedby="textHelp" placeholder="{{ __('global.example') }}: {{ __('global.university_of_tehran') }}">
                                                                    <div>@error('data.university') {{ $message }} @enderror</div>
                                                                </div>
                                                            </div>
                                                        @elseif (isset($data['situation']) && $data['situation'] === "employed")
                                                            <div class="col-md-6">
                                                                <div class="mb-3">
                                                                    <label for="company" class="form-label">{{ __('global.company_name') }}
                                                                        *</label>
                                                                    <input type="text" class="form-control" wire:model="data.company_name"
                                                                        id="company" aria-describedby="textHelp" placeholder="{{ __('global.company_name') }}">
                                                                    <div>@error('data.company_name') {{ $message }} @enderror</div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                              </div>
                                            </div>
                                            <div class="accordion-item">
                                              <h2 class="accordion-header" id="headingThree" wire:ignore>
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                                    {{ __('global.upload_profile_image') }}
                                                </button>
                                              </h2>
                                              <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample" wire:ignore.self>
                                                <div class="accordion-body">
                                                    @include('livewire.admin.users.components.upload-media')
                                                </div>
                                              </div>
                                            </div>
                                        </div>
                                    
                                        <div class="row">
                                            <div class="col-md-6">
                                                <button type="submit"
                                                    class="btn btn-dark w-100 py-8 fs-4 mb-4 rounded-0">
                                                    <span class="spinner-border spinner-border-sm"
                                                    wire:loading></span> {{ __('global.edit') }}
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
