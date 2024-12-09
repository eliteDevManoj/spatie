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
        <div class="col-10">
            
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

            <div class="row mt-2 table-responsive">
                <table class="table table-sm table-striped" id="permission-table">
                    <thead class="table-light">
                        <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider align-middle">
                        @foreach($permissions as $eachPermission)
                            <tr>
                                <th scope="row">{{$eachPermission->id}}</th>
                                <td>{{$eachPermission->name}}</td>
                                <td>
                                    @can('view permission')
                                        <a href="<?= route('permissions.view').'?id='.$eachPermission->id;?>" class="btn btn-secondary d-inline-block">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                    @endcan
                                    @can('delete permission')
                                    <form method="POST" action="{{route('permissions.delete')}}" class="d-inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="permission" value="{{$eachPermission->name}}">
                                        <button type="submit" class="btn btn-danger">
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

@endsection('content')