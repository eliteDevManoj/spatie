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

            <div class="row mt-5 table-responsive">
                <table class="table table-sm table-striped" id="user-table">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider align-middle">
                        @foreach($users as $eachUser)
                            <tr>
                                <th scope="row">{{ $eachUser->id }}</th>
                                <td>{{ $eachUser->name }}</td>
                                <td>{{ $eachUser->email }}</td>
                                <td>
                                    @foreach($eachUser->getRoleNames() as $eachUserRole)
                                        {{ $eachUserRole }}
                                    @endforeach
                                </td>
                                <td>
                                    @can('view user')
                                        <a href="<?= env('APP_URL').'/users/edit?id='.$eachUser->id; ?>" class="btn btn-secondary btn-sm">
                                            <i class="fa-solid fa-pen-to-square"></i> 
                                        </a>
                                    @endcan
                                    @can('delete user')
                                        <a href="<?= env('APP_URL').'/users/delete?id='.$eachUser->id; ?>" class="btn btn-danger btn-sm">
                                            <i class="fa-solid fa-trash"></i>
                                        </a>
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection('content')