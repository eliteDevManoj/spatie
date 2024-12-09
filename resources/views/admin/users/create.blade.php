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
            <form action="<?=route('users.store')?>" method="POST" class="form-container" enctype="multipart/form-data">
                @csrf

                <div class="row mb-3">
                    <div class="col-sm-6">
                        <label for="user-name" class="col-form-label">Name</label>
                        <input name="name" type="text" class="form-control" id="user-name">
                    </div>

                     <!-- Second Column: Email -->
                     <div class="col-sm-6">
                        <label for="user-email" class="col-form-label">Email</label>
                        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="user-email">
                        @error('email')
                        <div class="invalid-feedback">
                            <strong>{{ $message }} </strong>
                        </div>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <!-- First Column: Role -->
                    <div class="col-sm-6">
                        <label for="role" class="col-form-label">Role</label>
                        <select name="role" class="form-select @error('role') is-invalid @enderror">
                            <option value="" selected>select role</option>
                            @foreach($roles as $eachRole)
                                <option value="{{$eachRole->name}}">
                                    {{$eachRole->name}}
                                </option>
                            @endforeach
                            <option value="custom"> custom</option>
                        </select>
                        @error('role')
                        <div class="invalid-feedback">
                            <strong>{{ $message }} </strong>
                        </div>
                        @enderror
                    </div>

                    <div class="col-sm-6">
                    </div>
                </div>

                <div class="row mb-3">
                   
                    <div class="col-sm-6">
                        <label for="role" class="col-form-label">Profile Image</label>

                        <div class="card preview-profile-card" id="profile-image-card">
                            <div class="card-body">
                                <img id="profile-image-preview" src="" alt="Image Preview">
                            </div>
                        </div>
                        <input 
                            type="file" 
                            class="form-control @error('profile_image') is-invalid @enderror" 
                            id="profile-image" 
                            name="profile_image" 
                            accept=".png, .jpg, .jpeg"
                        />
                        @error('profile_image')
                        <div class="invalid-feedback">
                            <strong>{{ $message }} </strong>
                        </div>
                        @enderror
                    </div>

                    <div class="col-sm-6">
                       
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-sm-12 text-end">
                        @can('create user')
                            <button type="submit" class="btn" style="background-color: #001f3f; border: none; color: white;">Create</button>
                        @endcan
                    </div>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
@endsection('content')