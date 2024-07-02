<div class="container-fluid">
    <livewire:dashboard.components.live-breadcrumb :items="[['title' => $title]]" />
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
                <h5 class="card-title fw-semibold mb-4">{{ $title }}</h5>
                <time datetime="2022-01-01"><span class=""><i class="ti ti-user"></i> {{ $circular->createdBy->first_name }}</span> <i class="ti ti-calendar"></i> {{ $circular->updated_at?->format('Y-m-d') }}</time>
            </div>
            <div class="">
                <section>                  
                    <div class="row gy-4">
                        <div class="col-lg-8 col-md-8 col-12">
                            {!! $circular->description !!}
                        </div>
                        <div class="col-lg-4 col-md-8 col-12">
                            <div class="d-flex justify-content-center mb-3">
                                <i class="ti ti-file fs-8"></i> <span class="mt-1">{{ $circular->getFirstMedia('attachment')->human_readable_size }}</span>
                            </div>
                            <div class="d-flex">
                                <button class="btn btn-primary w-100" wire:click="download()">{{ __('global.download') }}</button>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
