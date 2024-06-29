@extends('layouts.front')

@section('content')
<div>
    @include('livewire.front.components.live-breadcrumb', [
        'title' => __('global.payment_success'), 
        'items' => [['title' => __('global.home'), 'route' => route('home')], ['title' => __('global.payment_success')]],
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
                                        <h1 class="text-center"><i class="ti ti-circle-check text-success"></i></h1>
                                        {!! __('messages.payment_success', ['track_number' => $order?->track_number, 'title' => $settings['title'] ?? env('APP_NAME')]) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-10 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4>{{ __('global.order_code') }}: {{ $order?->track_number }}</h4>
                                        <div class="row">
                                            <div class="col-md-9">
                                                {{ __('messages.order_completed') }}
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
                                                    <td>{{ __('global.payment_status') }} : {{ __('global.successfull') }}</td>
                                                    <td>{{ __('global.order_status') }} : {{ __('admin/enums/EnumOrderStatus.' . $order?->status) }}</td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <div class="row justify-content-center">
                                            <div class="col-md-3">
                                                <a href="{{ route('user.orders.index') }}" class="btn btn-info">{{ __('global.orders') }}</a>
                                            </div>
                                        </div>
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
