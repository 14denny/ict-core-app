@extends('master-layout')

@section('title')
    Beranda
@endsection

@section('body')
    <div class="row">
        <div class="col-md-12">
            Role: {{session('rolename')}}
        </div>
    </div>
@endsection

