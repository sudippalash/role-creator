@extends(config('role-creator.layout_name'))

@section(config('role-creator.section_name'))
<section class="{{ $cssClass['container'] }}">
    <div class="{{ $cssClass['card'] }}">
        <div class="panel-heading">
            <div style="height: 40px;">
                <h4 class="pull-left">{{ trans('role-creator::sp_role_creator.role_show') }}</h4>
                <div class="pull-right">
                    <a class="btn {{ $cssClass['btn'] }} ml-3" href="{{ route($routeName . '.index') }}">{{ trans('role-creator::sp_role_creator.back_to_list') }}</a>
                </div>
            </div>
        </div>

        <div class="panel-body">
            <table class="table">
                <tbody>
                    <tr>
                        <td>{{ trans('role-creator::sp_role_creator.name') }}</td>
                        <td align="right">{{ $data->name }}</td>
                    </tr>
                    <tr>
                        <td>{{ trans('role-creator::sp_role_creator.guard') }}</td>
                        <td align="right">{{ $data->guard_name }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="form-group">
                <h6>{{ trans('role-creator::sp_role_creator.assign_role_permission') }}</h6>
                <table class="table table-striped mb-0">
                    <thead>
                    <tr>
                        <th>{{ trans('role-creator::sp_role_creator.module') }}</th>
                        <th>{{ trans('role-creator::sp_role_creator.permissions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($permissioDone as $module => $moduleArr)
                        <tr>
                            <td>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" checked disabled>
                                    <label class="custom-control-label">{{ ucfirst($module) }}</label>
                                </div>
                            </td>
                            <td>
                                <div class="row">
                                    @foreach($moduleArr as $md)
                                        <div class="col-sm-2 custom-control custom-checkbox">
                                            <input class="custom-control-input" type="checkbox" checked disabled>
                                            <label class="custom-control-label">{{ $md }}</label><br>
                                        </div>
                                    @endforeach            
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
@endsection
