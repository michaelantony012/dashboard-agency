@extends('admin.main-layout')

@section('content-header')
<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
        <h1 class="m-0">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        </div><!-- /.col -->
    </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
@endsection

@section('body')
<!-- Main row -->
<div class="row">
    <div class="col-12">
        @if (session('error'))
            <div class="text-danger text-center">{{ session('error') }}</div>
        @endif
        @if (session('success'))
            <div class="text-success text-center">{{ session('success') }}</div>
        @endif
        {{-- <div class="container-fluid">Dashboard</div> --}}
    </div>
</div>
<!-- /.row (main row) -->
@endsection