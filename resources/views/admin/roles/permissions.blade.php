@extends('app')

@section('title', env('APP_NAME'))

@section('content')

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2">
            @include('admin.partials.sidebar')
        </div>
        <!-- Sidebar -->

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
                <form action="<?=env('APP_URL').'/roles/update'?>" method="POST" class="form-container">
                    @csrf
                    @method('PUT')
                    
                    <input type="hidden" class="form-control" name="id" value="<?=isset($role->id) ? $role->id : NULL?>">

                    <div class="row mb-3">
                        <label for="role-name" class="col-sm-2 col-form-label">Role</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="<?=isset($role->name) ? $role->name : NULL?>">
                            @error('name')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }} </strong>
                                </div>
                            @enderror                       
                        </div>
                    </div>
                
                    <div class="row mb-3">
                        <label for="role-permissions" class="col-sm-2 col-form-label">Permissions</label>
                        <div class="col-sm-10">
                            <select name="role_permissions[]" multiple="multiple" id="role-permissions">

                                @foreach($permissions as $eachPermission)

                                    <option <?=$eachPermission['roleHasPermission']==true ? 'selected' : ''?>>
                                        {{isset($eachPermission['name']) ? $eachPermission['name'] : ''}}
                                    </option>

                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12 text-end">
                        @can('edit role')
                            <button type="submit" class="btn" style="background-color: #001f3f; border: none; color: white;">Update</button>
                        @endcan
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection('content')