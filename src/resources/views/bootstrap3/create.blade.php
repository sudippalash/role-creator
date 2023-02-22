@extends(config('role-creator.layout_name'))

@section(config('role-creator.section_name'))
<section class="{{ $cssClass['container'] }}">
    <div class="{{ $cssClass['card'] }}">
        <div class="panel-heading">
            <div style="height: 40px;">
                <h4 class="pull-left">{{ trans('role-creator::sp_role_creator.role_create') }}</h4>
                <div class="pull-right">
                    <a class="btn {{ $cssClass['btn'] }} ml-3" href="{{ route($routeName . '.index') }}">{{ trans('role-creator::sp_role_creator.back_to_list') }}</a>
                </div>
            </div>
        </div>

        <div class="panel-body">
            <form method="POST" action="{{ route($routeName . '.store') }}">
                @csrf
        
                @include('role-creator::bootstrap.form')

                <hr>
                <button type="submit" id="submit" class="btn {{ $cssClass['btn'] }} float-right">{{ trans('role-creator::sp_role_creator.save') }}</button>
            </form>
        </div>
    </div>
</section>
@endsection
