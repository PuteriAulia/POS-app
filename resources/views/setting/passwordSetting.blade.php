@extends('layouts.mainLayouts')

@section('title','Pengaturan Password | TokoKu')

@section('hero')
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Pengaturan Password
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Password</li>
                    <li class="breadcrumb-item" aria-current="page">
                        <a class="link-fx" href="">Ubah</a>
                    </li>
                </ol>
            </nav>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="content">
        <form action="/pengaturan-password" method="POST">
            @csrf
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <div class="block-options">
                        <button type="submit" class="btn btn-sm btn-primary">
                            Ubah
                        </button>
                    </div>
                </div>
                <div class="block-content">
                    <div class="row justify-content-center py-sm-3 py-md-5">
                        <div class="col-sm-10 col-md-8">
                            @if (Session::has('status')=='failed')
                                <div class="alert alert-success alert-dismissible fade show mt-4" role="alert">
                                    {{ Session::get('message') }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif 

                            <input type="hidden" class="form-control form-control-alt" id="id" name="id" value="{{ $userId }}">

                            <div class="form-group">
                                <label for="block-form1-password">Password</label>
                                <input type="password" class="form-control form-control-alt" id="block-form1-password" name="password" placeholder="Masukkan password baru..." required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection