@extends('layouts.front')

@section('content')
<div>
    @include('livewire.front.components.live-breadcrumb', [
        'title' => __('global.payment_failed'), 
        'items' => [['title' => __('global.home'), 'route' => route('home')], ['title' => __('global.payment_failed')]],
        'background' => '',
        'subTitle' => '',
    ])


    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full" data-sidebar-position="fixed" data-header-position="fixed">
        <div class="position-relative overflow-hidden radial-gradient min-vh-100 align-items-center justify-content-center">
            <div class="align-items-center justify-content-center w-100">
                <section class="">
                    <div class="container mb-4">
                        <div class="row justify-content-center">
                            <div class="col-md-10 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h1 class="text-center"><i class="ti ti-alert-triangle text-ac-primary"></i></h1>
                                        <p class="alert alert-danger">{{ $error }}</p>
                                        <p>
                                            {!! __('messages.payment_failed', ['track_number' => $order?->track_number]) !!}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4>{{ __('global.order_code') }}: {{ $order?->track_number }}</h4>
                                        <div class="row">
                                            <div class="col-md-9">
                                                {{ __('messages.order_created') }}
                                            </div>
                                            <div class="col-md-3">
                                                <a href="#" class="btn btn-ac-info">{{ __('global.order_tracking') }}</a>
                                            </div>
                                        </div>
            
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th scope="col">{{ __('global.user_name') }}: {{ Auth::user()->full_name }}</th>
                                                    <th scope="col">{{ __('global.phone_number') }} : {{ Auth::user()->phone }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>{{ __('global.total_amount') }} : {{ number_format($order?->order_amount) }} {{ __('global.toman') }}</td>
                                                </tr>
                                                <tr>
                                                    <td>{{ __('global.payment_status') }} : {{ __('global.unsuccessful') }}</td>
                                                    <td>{{ __('global.order_status') }} : {{ __('admin/enums/EnumOrderStatus.' . $order?->status) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
    
@endsection
