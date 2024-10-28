<div class="mb-3">
    <label class="form-label">{{ trans('role-creator::sp_role_creator.name') }} <span class="text-danger">*</span></label>
    <input type="text" class="form-control" name="name" value="{{ old('name', isset($data) ? $data->name : '') }}" required>

    @if ($errors->has('name'))
        <span class="invalid-feedback d-block">{{ $errors->first('name') }}</span>
    @endif
</div>

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
            @if (!empty($permissionArr))
                @php($i = 1)
                @foreach($permissionArr as $module => $moduleArr)
                <tr>
                    <td>
                        <div class="form-check form-switch">
                            <input type="checkbox" class="form-check-input" id="module{{ $i }}" onclick="moduleCheck({{ $i }})"{{ (array_key_exists($module, $permissioDone)) ? ' checked' : '' }}>
                            <label class="form-check-label" for="module{{ $i }}">{{ $moduleArr[0]->module }}</label>
                        </div>
                    </td>
                    <td>
                        <div class="row" id="moduleContent{{ $i }}">
                            @foreach($moduleArr as $md)
                                <div class="col-sm-2 form-check">
                                    <input type="checkbox" class="form-check-input" id="permission{{ $md->id }}" name="permissions[]" value="{{ $md->name }}"{{ (isset($permissioDone[$module]) && in_array($md->name, $permissioDone[$module])) ? ' checked' : '' }}>
                                    <label class="form-check-label" for="permission{{ $md->id }}">{{ $md->label }}</label><br>
                                </div>
                            @endforeach            
                        </div>
                    </td>
                </tr>
                @php($i++)
                @endforeach
            @else
            <tr>
                <td colspan="2" class="text-center">{{ trans('role-creator::sp_role_creator.permission_not_found') }}</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>

<script>
    function moduleCheck(k) {
        if (document.getElementById('module'+k).checked == true) {
            $('#moduleContent'+k+' input').prop('checked', true);
        } else {
            $('#moduleContent'+k+' input').prop('checked', false);
        }
    }
</script>