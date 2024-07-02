<div class="container-fluid">
    <livewire:admin.components.live-breadcrumb :items="[]" />
        <div class="card mb-4">
            <div class="card-body">
                <h3 class="">{{ __('global.welcome') }}</h3>
                <div>
                    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
                        data-sidebar-position="fixed" data-header-position="fixed">
                        <div class="d-flex align-items-center justify-content-center w-100">
                            <div class="row">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @can('active_user')
            <div class="card mb-4">
                <div class="card-body document">
                    <div class="d-flex justify-content-between">
                        <h4>{{ __('global.documents') }}</h4>
                        <a href="{{ route('user.documents.index') }}">{{ __('global.more') }} <i class="ti ti-arrow-{{ App::isLocale('fa') ? "left" : "right" }}"></i></a>
                    </div>
                    <section>
                        <div class="row gy-4">
                            @foreach ($documents as $document)
                                <div class="col-xl-3 col-md-6">
                                    <article class="document-card">
                        
                                        <div class="post-img">
                                            <img src="{{ $document->getFirstMediaUrl('mainImage') ?: "/general/img/document.png" }}" alt="{{ $document->title }}" class="img-fluid">
                                        </div>
                        
                                        <p class="post-category">{{ $document->mainCategory?->first()?->title }}</p>
                            
                                        <h4 class="title">
                                            <a href="{{ route('user.documents.show', ['document' => $document->slug]) }}">{{ $document->title }}</a>
                                        </h4>
                            
                                        <div class="d-flex align-items-center">
                                            <button class="btn btn-primary w-100">{{ __('global.download') }}</button>
                                        </div>
                        
                                    </article>
                                </div>
                            @endforeach
                        </div>
                    </section>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-body document">
                    <div class="d-flex justify-content-between">
                        <h4>{{ __('global.circulars') }}</h4>
                        <a href="{{ route('user.circulars.index') }}">{{ __('global.more') }} <i class="ti ti-arrow-{{ App::isLocale('fa') ? "left" : "right" }}"></i></a>
                    </div>
                    <section>
                        <div class="row gy-4">
                            @foreach ($circulars as $circular)
                                <div class="col-xl-3 col-md-6">
                                    <article class="document-card">
                        
                                        <div class="post-img">
                                            <img src="{{ $circular->getFirstMediaUrl('mainImage') ?: "/general/img/document.png" }}" alt="{{ $circular->title }}" class="img-fluid">
                                        </div>
                        
                                        <p class="post-category">{{ $circular->mainCategory?->first()?->title }}</p>
                            
                                        <h4 class="title">
                                            <a href="{{ route('user.circulars.show', ['circular' => $circular->slug]) }}">{{ $circular->title }}</a>
                                        </h4>
                            
                                        <div class="d-flex align-items-center">
                                            <button class="btn btn-primary w-100" wire:click="download()">{{ __('global.download') }}</button>
                                        </div>
                                    </article>
                                </div>
                            @endforeach
                        </div>
                    </section>
                </div>
            </div>
        @endcan
</div>


