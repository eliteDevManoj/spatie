@extends('app')

@section('title', env('APP_NAME'))

@section('content')

<div class="container-fluid d-flex" style="height: 100vh;">

    <div class="left-side" style="flex: 1; background-color: #001f3f;"></div>
 
    <div class="right-side" style="flex: 1; background-color: white; display: flex; justify-content: center; align-items: center;">
     
    <div class="container-fluid">
        <h1 class="text-center"> SPATIE </h1>
        <form class="mt-5 form-container" action="<?=env('APP_URL')?>/login" method="POST">
            @csrf

            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="inputEmail3">

                    @error('email')
                        <div class="invalid-feedback">
                            <strong>{{ $message }} </strong>
                        </div>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword3" class="col-sm-2 col-form-label">Password</label>
                <div class="col-sm-10">
                    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="inputPassword3">

                    @error('password')
                        <div class="invalid-feedback">
                            <strong>{{ $message }} </strong>
                        </div>
                    @enderror
                </div>
            </div>

           <div class="row">
                <div class="col-sm-12 text-end">
                    <button type="submit" class="btn" style="background-color: #001f3f; border: none; color: white;">Log In</button>
                </div>
            </div>
        </form>

    </div>

    </div>
</div>

@endsection('content')