<div class="container-fluid">
    <livewire:dashboard.components.live-breadcrumb :items="[['title' => $title]]" />
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
                <h5 class="card-title fw-semibold mb-4">{{ $title }}</h5>
            </div>
            <div class="">
                <div class="row">
                    <div class="col-md-4">
                        <input type="text" class="form-control btn-info" wire:model.live.debounce.600="search" placeholder="{{ __('global.search') }} ...">
                    </div>
                    {{-- <div class="col-md-2">
                        <div class="accordion" id="accordionExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFilter" wire:ignore>
                                    <button class="accordion-button collapsed p-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter">
                                        {{ __('global.filter') }}:
                                    </button>
                                </h2>
                            </div>
                        </div>
                    </div> --}}
                </div>
                <div class="row my-3">
                    <div class="col-md-12">
                        <div id="collapseFilter" class="accordion-collapse collapse" aria-labelledby="headingFilter" data-bs-parent="#accordionExample" wire:ignore.self>
                            <div class="accordion-body">
                                {{-- <div class="row">
                                    <div class="col-12 mb-3">
                                        <button class="btn btn-info" wire:click="resetFilter()" type="button">{{ __('global.reset_filter') }}</button>
                                    </div>
                                </div> --}}
                                {{-- <div class="row p-3">
                                    <div class="bdocument col-md-6 px-0 py-2 text-center">
                                        <span>نوع سفارش:</span>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model.live="filter.document_type" name="documentType" id="inlineRadio1" value="tuition">
                                            <label class="form-check-label" for="inlineRadio1">نمایش شهریه ها</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model.live="filter.document_type" name="documentType" id="inlineRadio2" value="book">
                                            <label class="form-check-label" for="inlineRadio2">نمایش کتاب ها</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model.live="filter.document_type" name="documentType" id="inlineRadio3" value="">
                                            <label class="form-check-label" for="inlineRadio3">نمایش همه</label>
                                        </div>
                                    </div>
                                    <div class="bdocument col-md-6 p-2 text-center">
                                        <span>نوع پرداخت:</span>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model.live="filter.payment_type" name="paymentType" id="paymentType1" value="installment">
                                            <label class="form-check-label" for="paymentType1">نمایش اقساطی</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model.live="filter.payment_type" name="paymentType" id="paymentType2" value="full">
                                            <label class="form-check-label" for="paymentType2">نمایش یکجا</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model.live="filter.payment_type" name="paymentType" id="paymentType3" value="">
                                            <label class="form-check-label" for="paymentType3">نمایش همه</label>
                                        </div>
                                    </div>
                                    <div class="bdocument col-md-6 px-0 py-2 text-center">
                                        <span>وضعیت پرداخت:</span>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model.live="filter.payment_status" name="paymentStatus" id="paymentStatus1" value="debt">
                                            <label class="form-check-label" for="paymentStatus1">نمایش بدهکار</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model.live="filter.payment_status" name="paymentStatus" id="paymentStatus2" value="clear">
                                            <label class="form-check-label" for="paymentStatus2">نمایش تسویه</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" wire:model.live="filter.payment_status" name="paymentStatus" id="paymentStatus3" value="">
                                            <label class="form-check-label" for="paymentStatus3">نمایش همه</label>
                                        </div>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <section>
                    <div class="text-center container py-5 document">
                        <div class="row gy-4">
                            @foreach ($posts as $post)
                                <div class="col-xl-3 col-md-6">
                                    <article class="document-card">
                        
                                        <div class="post-img">
                                            <img src="{{ $post->getFirstMediaUrl('mainImage') ?: "/general/img/document.png" }}" alt="{{ $post->title }}" class="img-fluid">
                                        </div>
                                        @if ($post->is_private)
                                            <div class="label-top shadow-sm">
                                                {{ __('global.exclusive') }}
                                            </div>
                                        @endif
                        
                                        <p class="post-category">{{ $post->mainCategory?->first()?->title }}</p>
                            
                                        <h4 class="title fs-4">
                                            <a href="{{ route('user.news.show', ['post' => $post->slug]) }}">{{ $post->title }}</a>
                                        </h4>
                            
                                        {{-- <div class="d-flex align-items-center">
                                            <button class="btn btn-primary w-100">{{ __('global.download') }}</button>
                                        </div> --}}
                        
                                    </article>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</div>
