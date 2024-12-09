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

            <div class="container-fluid">

                <div class="row mt-3" style="overflow-x: auto; white-space: nowrap;">
                    <div class="col-3 d-inline-block">
                        <div class="card" style="background: linear-gradient(to bottom right, #ff030e, #c93f52, #ffb6b6);">
                            <div class="card-body">
                                <h4 class="card-text text-center" style="color: white;font-size: 16px; font-weight: 700; font-family: serif;">
                                    {{ $users->count() }}
                                </h4>

                                <hr style="color:white;">
                                <h3 class="text-center" style="color: white;font-size: 18px; font-weight: 700; font-family: serif;">Users</h3>  
                            </div>
                        </div>
                    </div>

                    <div class="col-3 d-inline-block">
                        <div class="card" style="background: linear-gradient(to bottom right, #0638b3, #46749b, #e1e5f4);">
                            <div class="card-body">
                                <h4 class="card-text text-center" style="color: white;font-size: 16px; font-weight: 700; font-family: serif;">
                                    {{ $roles->count() }}
                                </h4>

                                <hr style="color:white;">
                                <h3 class="text-center" style="color: white;font-size: 18px; font-weight: 700; font-family: serif;">Roles</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-3 d-inline-block">
                        <div class="card" style="background: linear-gradient(to bottom right, #04943c, #48914d, #f4f4f4);">
                            <div class="card-body">
                                <h4 class="card-text text-center" style="color: white;font-size: 16px; font-weight: 700; font-family: serif;">
                                   {{ $permissions->count() }}
                                </h4>

                                <hr style="color:white;">
                                <h3 class="text-center" style="color: white;font-size: 18px; font-weight: 700; font-family: serif;">Permissions</h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-3 d-inline-block">
                        <div class="card" style="background: linear-gradient(to bottom right, #04943c, #48914d, #f4f4f4);">
                            <div class="card-body">
                                <h4 class="card-text text-center" style="color: white;font-size: 16px; font-weight: 700; font-family: serif;">
                                    15 
                                </h4>

                                <hr style="color:white;">
                                <h3 class="text-center" style="color: white;font-size: 18px; font-weight: 700; font-family: serif;">Permissions</h3>
                            </div>
                        </div>
                    </div>
                  
                </div>
            </div>
        </div>
    </div>
</div>

@endsection('content')
