<div class="form-group">
    <label>Role Name <span class="text-danger">*</span></label>
    <input type="text" class="form-control" name="name" value="{{ old('name', isset($data) ? $data->name : '') }}" required>

    @if ($errors->has('name'))
        <span class="invalid-feedback d-block">{{ $errors->first('name') }}</span>
    @endif
</div>

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
            @if (!empty($permissionArr))
                @php($i = 1)
                @foreach($permissionArr as $module => $moduleArr)
                <tr>
                    <td>
                        <div class="custom-control custom-switch">
                            <input type="checkbox" {{ (array_key_exists($module, $permissioDone))?'checked':'' }} class="custom-control-input" id="module{{ $i }}" onclick="moduleCheck({{ $i }})">
                            <label class="custom-control-label" for="module{{ $i }}">{{ ucfirst($module) }}</label>
                        </div>
                    </td>
                    <td>
                        <div class="row" id="moduleContent{{ $i }}">
                            @foreach($moduleArr as $md)
                                <div class="col-sm-2 custom-control custom-checkbox">
                                    <input class="custom-control-input" id="permission{{ $md->id }}" name="permissions[]" type="checkbox" value="{{ $md->name }}" {{ (isset($permissioDone[$module]) && in_array($md->name, $permissioDone[$module]))?'checked':'' }}>
                                    <label for="permission{{ $md->id }}" class="custom-control-label">{{ str_replace($module, '', $md->name) }}</label><br>
                                </div>
                            @endforeach            
                        </div>
                    </td>
                </tr>
                @php($i++)
                @endforeach
            @else
            <tr>
                <td colspan="2" class="text-center">Permission not found!</td>
            </tr>
            @endif
        </tbody>
    </table>
</div>

<script>
    function moduleCheck(k) {
        if (document.getElementById('module'+k).checked==true) {
            $('#moduleContent'+k+' input').prop('checked', true);
        } else {
            $('#moduleContent'+k+' input').prop('checked', false);
        }
    }
</script>