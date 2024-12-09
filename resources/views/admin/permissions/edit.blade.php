@extends('app')

@section('title', env('APP_NAME'))

@section('content')

<div class="container-fluid">

    <div class="row">
        <div class="col-md-2">
            @include('admin.partials.sidebar')
        </div>
        <div class="col-md-10">

            @include('admin.partials.navbar')

            @if (session('status'))
                <div class="row mt-2 mb-2">
                    <div class="col-8"></div>

                    <div class="col-4">
                        <div class="toast align-items-center text-bg-success border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="d-flex">
                                <div class="toast-body text-center">
                                    {{ session('status') }}
                                </div>
                                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row mt-3">

                <form action="<?=route('permissions.update')?>" method="POST" class="form-container">
                    @csrf
                    @method('PUT')

                    <input name="id" type="hidden" value="{{ isset($permission->id) ? $permission->id : NULL }}">

                    <div class="row mb-3">
                        <label for="permission-name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input name="permission" type="text" value="{{ isset($permission->name) ? $permission->name : '' }}" class="form-control @error('permission') is-invalid @enderror" id="permission-name">
                            @error('permission')
                            <div class="invalid-feedback">
                                <strong>{{ $message }} </strong>
                            </div>
                            @enderror
                        </div>
                    </div>

                    <hr>
                    <div class="row">
                        <div class="col-sm-12 text-end">
                            @can('edit permission')
                                <button type="submit" class="btn" style="background-color: #001f3f; border: none; color: white;">Update</button>
                            @endcan
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
@endsection