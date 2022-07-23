@extends(config('role-creator.layout_name'))

@section(config('role-creator.section_name'))
<section class="{{ $cssClass['container'] }}">
    <div class="{{ $cssClass['card'] }}">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h4 class="m-0">Role Create</h4>
                <div class="d-flex">
                    <a class="btn {{ $cssClass['btn'] }} ml-3" href="{{ route($routeName . '.index') }}">Back to List</a>
                </div>
            </div>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('admin.role.store') }}">
                @csrf
        
                @include('rolemake::bootstrap.form')

                <hr>
                <button type="submit" id="submit" class="btn {{ $cssClass['btn'] }} float-right">Save</button>
            </form>
        </div>
    </div>
</section>
@endsection
