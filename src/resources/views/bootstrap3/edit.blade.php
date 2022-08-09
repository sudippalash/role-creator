@extends(config('role-creator.layout_name'))

@section(config('role-creator.section_name'))
<section class="{{ $cssClass['container'] }}">
    <div class="{{ $cssClass['card'] }}">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h4 class="m-0">{{ trans('role-creator::sp_role_creator.role_edit') }}</h4>
                <div class="d-flex">
                    <a class="btn {{ $cssClass['btn'] }} ml-3" href="{{ route($routeName . '.index') }}">{{ trans('role-creator::sp_role_creator.back_to_list') }}</a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route($routeName . '.update', $data->id) }}">
                @csrf
                @method('PUT')
        
                @include('role-creator::bootstrap.form')

                <hr>
                <button type="submit" id="submit" class="btn {{ $cssClass['btn'] }} float-right">{{ trans('role-creator::sp_role_creator.update') }}</button>
            </form>
        </div>
    </div>
</section>
@endsection
