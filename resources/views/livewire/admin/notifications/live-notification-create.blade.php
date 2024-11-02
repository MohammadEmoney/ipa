<div class="container-fluid">
    <livewire:admin.components.live-breadcrumb :items="[['title' => __('global.notifications'), 'route' => route('admin.notifications.index')], ['title' => $title]]" />
    <div class="card">
        <div class="card-body">
            <h3 class="">{{ $title }}</h3>
            <div>
                <form wire:submit.prevent="submit">
                    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
                        data-sidebar-position="fixed" data-header-position="fixed">
                        <div class="d-flex align-items-center justify-content-center w-100">
                            <div class="row justify-content-center w-100">
                                <div class="col-md-12">
                                    <div class="card mb-3 mt-3">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6 mb-3">
                                                    <div wire:ignore>
                                                        <label for="exampleInputtext1" class="form-label">{{ __('global.roles') }}</label>
                                                        <select id="roles" class="form-control select2"
                                                            onchange="livewireSelect2Multi('data.roles', this)"
                                                            wire:model.live="data.roles" multiple>
                                                            <option value="">{{ __('global.select_item') }}</option>
                                                            @foreach ($roles as $key => $value)
                                                                <option value="{{ $key }}">{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="text-danger">
                                                        @error('data.roles')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mb-3">
                                                    <div wire:ignore>
                                                        <label for="send_via" class="form-label">{{ __('global.send_via') }}</label>
                                                        <select id="send_via" class="form-control select2"
                                                            onchange="livewireSelect2Multi('data.send_via', this)"
                                                            wire:model.live="data.send_via" multiple>
                                                            <option value="">{{ __('global.select_item') }}</option>
                                                            @foreach ($sendMethods as $key => $value)
                                                                <option value="{{ $key }}">{{ $value }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="text-danger">
                                                        @error('data.send_via')
                                                            {{ $message }}
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center w-100">
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="exampleInputtext1" class="form-label">{{ __('global.from') }}*</label>
                                <input type="text" class="form-control"
                                    wire:model="data.from" id="exampleInputtext1" disabled
                                    aria-describedby="textHelp" placeholder="{{ __('global.from') }}">
                                <div class="text-danger">
                                    @error('data.from')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="exampleInputtext1" class="form-label">{{ __('global.emails') }}*</label>
                                <small>ایمیل های بیش از یک مورد را با "," جدا نمایید. مثال: example1@email.com, example2@email.com</small>
                                <input type="text" class="form-control"
                                    wire:model="data.emails" id="exampleInputtext1"
                                    aria-describedby="textHelp" placeholder="{{ __('global.emails') }}">
                                <div class="text-danger">
                                    @error('data.emails')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="exampleInputtext1" class="form-label">{{ __('global.send_to') }}</label>
                            <button class="btn btn-primary btn-sm" type="button" wire:click="selectAll">{{ __('global.select_all') }}</button>
                            <select id="users" class="form-control select2"
                                onchange="livewireSelect2Multi('data.users', this)"
                                wire:model.live="data.users" multiple>
                                <option value="">{{ __('global.select_item') }}</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->full_name }}</option>
                                @endforeach
                            </select>
                            <div class="text-danger">
                                @error('data.users')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-3">
                                <label for="exampleInputtext1" class="form-label">{{ __('global.subject') }}*</label>
                                <input type="text" class="form-control"
                                    wire:model="data.subject" id="exampleInputtext1"
                                    aria-describedby="textHelp" placeholder="{{ __('global.subject') }}">
                                <div class="text-danger">
                                    @error('data.subject')
                                        {{ $message }}
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 mb-3">     
                            <div wire:ignore>
                                <label for="message" class="form-label">{{ __('global.message') }}</label>
                                <textarea id="message" class="form-control" cols="30" rows="10" wire:model.live="data.message">{!! $data['message'] ?? "" !!}</textarea>
                            </div>
                            <div class="text-danger">
                                @error('data.message')
                                    {{ $message }}
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <button type="submit"
                                    class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-0">
                                    <span class="spinner-border spinner-border-sm"
                                        wire:loading></span> {{ __('global.send') }}
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    @include('admin.components.ckeditor', ['selectorIds' => [
        'message' => 'message'
    ]])
    <script>
        // $(document).on("keypress",".select2",function(event){
        //     if (event.ctrlKey || event.metaKey) {
        //         var id =$(this).parents("div[class='select2-container']").attr("id").replace("s2id_","");
        //         var element =$("#"+id);
        //         if (event.which == 97){
        //             var selected = [];
        //             element.find("option").each(function(i,e){
        //                 selected[selected.length]=$(e).attr("value");
        //             });
        //             element.select2("val", selected);
        //         } else if (event.which == 100){
        //             element.select2("val", "");
        //         }
        //     }
        // });

        function livewireSelect2Multi(component, event) {
            var selectedValues = [];
            $(event).find('option:selected').each(function () {
                selectedValues.push($(this).val());
            });
            @this.set(component, selectedValues)
        }

        var data = [];
        var categoryIds = {!! json_encode($data['payment_via']?? []) !!};
        $.each(categoryIds, function (key, value) {
            data.push(value);
        });

        $('#payment_via').val(data).trigger('change');


        function formatCardNumber(input) {
            // Remove all non-digit characters
            let value = input.value.replace(/\D/g, '');

            // Format the value with hyphens after every 4 digits
            let formattedValue = '';
            for (let i = 0; i < value.length; i += 4) {
                if (i > 0) {
                    formattedValue += '-';
                }
                formattedValue += value.substring(i, i + 4);
            }

            input.value = formattedValue;
        }
    </script>
@endpush

@script
<script>

    $wire.on('loadJs', () => {
        $(document).ready(function () {
            $('.select2').select2({
                placeholder: 'انتخاب کنید',
                dir: 'rtl',
                containerCssClass: 'select-sm',
                allowClear: !0
            });
        });
        
        function livewireSelect2Multi(component, event) {
            var selectedValues = [];
            $(event).find('option:selected').each(function () {
                selectedValues.push($(this).val());
            });
            @this.set(component, selectedValues)
        }
    })
</script>
@endscript