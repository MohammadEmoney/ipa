@extends('layouts.admin-panel')

@section('title', __('global.admin_dashboard'))

@section('content')
<div class="container-fluid">
    <livewire:admin.components.live-breadcrumb />
    <livewire:admin.dashboards.live-dashboard-status-card />
  </div>
@endsection
