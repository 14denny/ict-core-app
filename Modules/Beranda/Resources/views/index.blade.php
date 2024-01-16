@extends('master-layout')

@section('title')
    Beranda
@endsection

@section('breadcrumbs')
    <!--begin::Item-->
    <li class="breadcrumb-item text-gray-600 fw-bold lh-1">Beranda</li>
    <!--end::Item-->
@endsection

@section('body')
    <div class="row">
        <div class="col-md-12">
            Role: {{session('rolename')}}
        </div>
    </div>
@endsection

