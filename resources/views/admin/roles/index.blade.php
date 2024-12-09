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
                <table class="table table-sm table-striped" id="role-table">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Permissions</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider align-middle">
                        @foreach($roles as $eachRole)
                            <tr>
                                <th scope="row">{{ $eachRole->id }}</th>
                                <td>{{ $eachRole->name }}</td>
                                <td>
                                    <a href="<?= route('roles.view').'?id='.$eachRole->id; ?>" class="btn btn-info btn-sm">{{ $eachRole->permissions->count() }}</a>
                                </td>
                                <td>
                                    @can('view role')
                                        <a href="<?= route('roles.view').'?id='.$eachRole->id; ?>" class="btn btn-secondary btn-sm d-inline-block">
                                            <i class="fa-solid fa-pen-to-square"></i>    
                                        </a>
                                    @endcan

                                    @can('delete role')
                                        <form action="{{ route('roles.delete') }}" method="POST" class="d-inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" name="role" value="{{isset($eachRole->name) ? $eachRole->name : ''}}"> 
                                            <button type="submit" class="btn btn-danger btn-sm">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
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

@endsection
