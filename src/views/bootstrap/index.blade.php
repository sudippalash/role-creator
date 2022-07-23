@extends(config('role-creator.layout_name'))

@section(config('role-creator.section_name'))
<section class="{{ $cssClass['container'] }}">
    <div class="{{ $cssClass['card'] }}">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h4 class="m-0">Role</h4>
                <div class="d-flex">
                    <a class="btn {{ $cssClass['btn'] }} ml-3" href="{{ route($routeName . '.create') }}">Create</a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-sm sortTable dataTable">
                    <thead class="bordered">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Guard</th>
                            <th>Created At</th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                    @if($records->count() > 0)
                        @foreach($records as $val)
                        <tr>
                            <td>{{ $val->id }}</td>
                            <td>{{ $val->name }}</td>
                            <td>{{ $val->guard_name }}</td>
                            <td>{{ $val->created_at }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn {{ $cssClass['btn'] }} btn-sm dropdown-toggle" data-toggle="dropdown" data-display="static">Action</button>
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-lg-right">
                                        <a class="dropdown-item" href="{{ route($routeName . '.show', $val->id) }}">Show</a>
                                        <a class="dropdown-item" href="{{ route($routeName . '.edit', $val->id) }}">Edit</a>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="deleted('{{ route($routeName . '.destroy', $val->id) }}')">Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @else
                    <tr>
                        <td colspan="5" class="text-center">Data not found!</td>
                    </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
