@extends(config('role-creator.layout_name'))

@section(config('role-creator.section_name'))
<section class="{{ $cssClass['container'] }}">
    <div class="{{ $cssClass['card'] }}">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h4 class="m-0">{{ trans('role-creator::sp_role_creator.role') }}</h4>
                <div class="d-flex">
                    <a class="btn {{ $cssClass['btn'] }} ml-3" href="{{ route($routeName . '.create') }}">{{ trans('role-creator::sp_role_creator.create') }}</a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table {{ $cssClass['table'] }}">
                    <thead>
                        <tr>
                            <th>{{ trans('role-creator::sp_role_creator.id') }}</th>
                            <th>{{ trans('role-creator::sp_role_creator.name') }}</th>
                            <th>{{ trans('role-creator::sp_role_creator.guard') }}</th>
                            <th>{{ trans('role-creator::sp_role_creator.created_at') }}</th>
                            <th class="{{ $cssClass['table_action_col_width'] }}"></th>
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
                                    <button type="button" class="btn {{ $cssClass['table_action_btn'] }} btn-sm dropdown-toggle" data-toggle="dropdown" data-display="static">{{ trans('role-creator::sp_role_creator.action') }}</button>
                                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-lg-right">
                                        <a class="dropdown-item" href="{{ route($routeName . '.show', $val->id) }}">{{ trans('role-creator::sp_role_creator.show') }}</a>
                                        <a class="dropdown-item" href="{{ route($routeName . '.edit', $val->id) }}">{{ trans('role-creator::sp_role_creator.edit') }}</a>
                                        <a class="dropdown-item" href="javascript:void(0)" onclick="if (confirm('Are you sure to delete this role?')) { event.preventDefault(); document.getElementById('role-delete-form{{ $val->id }}').submit(); } else { event.stopPropagation(); event.preventDefault(); };">{{ trans('role-creator::sp_role_creator.destroy') }}</a>
                                        

                                        <form id="role-delete-form{{ $val->id }}" action="{{ route($routeName . '.destroy', $val->id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    @else
                    <tr>
                        <td colspan="5" class="text-center">{{ trans('role-creator::sp_role_creator.row_not_found') }}</td>
                    </tr>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
