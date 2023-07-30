@extends('layouts.mainLayouts')

@section('title','Pengaturan Akun | TokoKu')

@section('hero')
<div class="bg-body-light">
    <div class="content content-full">
        <div class="d-flex flex-column flex-sm-row justify-content-sm-between align-items-sm-center">
            <h1 class="flex-sm-fill h3 my-2">
                Pengaturan Akun
            </h1>
            <nav class="flex-sm-00-auto ml-sm-3" aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-alt">
                    <li class="breadcrumb-item">Akun</li>
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
    @foreach ($account as $data)
    <div class="content">
        <form action="/pengaturan-akun" method="POST">
            @csrf
            <div class="block block-rounded">
                <div class="block-header block-header-default">
                    <div class="block-options">
                        <button type="submit" class="btn btn-sm btn-primary">
                            ubah
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

                            <input type="hidden" class="form-control form-control-alt" id="id" name="id" value="{{ $data->id }}">

                            <div class="form-group">
                                <label for="block-form1-name">Nama user</label>
                                <input type="text" class="form-control form-control-alt" id="block-form1-name" name="name" value="{{ $data->name }}" required>
                            </div>

                            <div class="form-group">
                                <label for="block-form1-email">Alamat email</label>
                                <input type="email" class="form-control form-control-alt" id="block-form1-email" name="email" value="{{ $data->email }}" required>
                            </div>

                            <div class="form-group">
                                <label for="block-form1-phone">Nomor telepon</label>
                                <input type="text" class="form-control form-control-alt" id="block-form1-phone" name="phone" value="{{ $data->phone }}" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @endforeach
@endsection