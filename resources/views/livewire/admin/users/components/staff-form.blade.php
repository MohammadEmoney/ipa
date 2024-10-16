<form wire:submit.prevent="submit">
    {{-- @if(count($errors->messages()))
        <div class="alert alert-warning" role="alert">
            لطفا گزینه های ستاره دار را تکمیل نمایید تا اطلاعات شما ثبت گردد.
        </div>
        @dd($errors->messages())
    @endif --}}
    <div class="accordion" id="accordionExample">
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingOne" wire:ignore>
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              {{ __('global.user_information') }}
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
                                    <select  id="" class="@error('data.airline_id') invalid-input @enderror form-control" wire:model.live="data.airline_id">
                                        <option value="">{{ __('global.select_item') }}</option>
                                        @foreach ($airlines as $airline )
                                            <option value="{{ $airline->id }}">{{ $airline->title }} ( {{ $airline->title_en }} )</option>
                                        @endforeach
                                    </select>
                                    <div class="text-danger">@error('data.airline_id') {{ $message }} @enderror</div>
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
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour" wire:ignore>
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                    {{ __('global.set_password') }}
              </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample" wire:ignore.self>
                <div class="accordion-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="exampleInputPassword1" class="form-label">{{ __('global.password') }}</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" autocomplete="new-password" wire:model.live="data.password">
                            </div>
                            <div>
                                @error('data.password')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="exampleInputPassword2" class="form-label">{{ __('global.password_confirmation') }}</label>
                                <input type="password" class="form-control" id="exampleInputPassword2" wire:model.live="data.password_confirmation">
                            </div>
                            <div>
                                @error('data.password_confirmation')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @can('role_access')
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingFive" wire:ignore>
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                    {{ __('global.permissions') }}
                    </button>
                </h2>
                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample" wire:ignore.self>
                    <div class="accordion-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="exampleInputtext1"
                                        class="form-label">{{ __('global.user_role') }} *</label>
                                    <select id="" class="form-control"
                                        wire:model.live="data.role">
                                        <option value="">{{ __('global.select_item') }}</option>
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
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="form-label">{{ __('global.is_active') }}</label>
                                    <div class="form-check form-switch d-flex ps-0 {{ app()->getLocale() === "en" ? "" : "flex-row-reverse justify-content-end" }}">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">{{ __('global.inactive') }}</label>
                                        <input class="form-check-input mx-2" type="checkbox" role="switch" id="flexSwitchCheckDefault" wire:model.defer="data.is_active">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">{{ __('global.active') }}</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="d-flex justify-content-between col-12">
                                <h4>{{ __('global.direct_access') }}</h4>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" wire:click="selectAll" id="inlineCheckbox1" wire:model="selectedAll" value="1">
                                    <label class="form-check-label" for="inlineCheckbox1">{{ __('global.select_all') }}</label>
                                </div>
                            </div>
                            @foreach ($permissions as $permission)
                                <div class="col-md-3">
                                    <div class="mb-3">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" wire:model="data.direct_permissions.{{ $permission->id }}"
                                                value="{{ $permission->id }}" id="flexCheckDefault_{{ $permission->id }}">
                                            <label class="form-check-label" for="flexCheckDefault_{{ $permission->id }}">
                                                {{ __('admin/permissions.' . $permission->name) }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endcan
    </div>

    @if($edit)
        <div class="row">
            <div class="col-md-6">
                <button type="submit"
                    class="btn btn-dark w-100 py-8 fs-4 mb-4 rounded-0">
                    <span class="spinner-border spinner-border-sm"
                    wire:loading></span> {{ __('global.edit') }}
                </button>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-md-6">
                <button type="submit"
                    class="btn btn-primary w-100 py-8 fs-4 my-4">
                    <span class="spinner-border spinner-border-sm"
                    wire:loading></span> {{ __('global.submit') }}
                </button>
            </div>
        </div>
    @endif
</form>
