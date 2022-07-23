@extends(config('role-creator.layout_name'))

@section(config('role-creator.section_name'))
<section class="{{ $cssClass['container'] }}">
    <div class="{{ $cssClass['card'] }}">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h4 class="m-0">Role Show</h4>
                <div class="d-flex">
                    <a class="btn {{ $cssClass['btn'] }} ml-3" href="{{ route($routeName . '.index') }}">Back to List</a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table browser mt-4 no-border">
                <tbody>
                    <tr>
                        <td>{{ __('Name') }}</td>
                        <td align="right">{{ $data->name }}</td>
                    </tr>
                    <tr>
                        <td>{{ __('Guard') }}</td>
                        <td align="right">{{ $data->guard_name }}</td>
                    </tr>
                </tbody>
            </table>

            <div class="form-group">
                <h6>Assign permissions to role</h6>
                <table class="table table-striped mb-0">
                    <thead>
                    <tr>
                        <th>{{ __('Module') }}</th>
                        <th>{{ __('Permissions') }}</th>
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
                                            <input class="custom-control-input" type="checkbox" value="{{ $md }}" checked disabled>
                                            <label class="custom-control-label">{{ str_replace($module, '', $md) }}</label><br>
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
