<nav class="card">
    <div class="card-header">
        <a href="{{ route('dashboard') }}">{{ config('app.name', 'Laravel') }}</a>
    </div>
    <div class="card-body">
        <ul class="sidebar-nav">
            <li class="{{Route::currentRouteName() == 'users_list' ? 'current' : ''}}"><a href="{{route('users_list')}}">Users</a></li>
            <li class="{{Route::currentRouteName() == 'cities_list' ? 'current' : ''}}"><a href="{{route('cities_list')}}">Cities</a></li>
            <li class="{{Route::currentRouteName() == 'districts_list' ? 'current' : ''}}"><a href="{{route('districts_list')}}">Districs</a></li>
            <li class="{{Route::currentRouteName() == 'institution_types_list' ? 'current' : ''}}"><a href="{{route('institution_types_list')}}">Institution types</a></li>
            <li class="{{Route::currentRouteName() == 'institutions_list' ? 'current' : ''}}"><a href="{{route('institutions_list')}}">Institution</a></li>
            <li class="{{Route::currentRouteName() == 'exhibitions_list' ? 'current' : ''}}"><a href="{{route('exhibitions_list')}}">Exhibitions</a></li>
            <li class="{{Route::currentRouteName() == 'editors_list' ? 'current' : ''}}"><a href="{{route('editors_list')}}">Editors</a></li>
            <li class="{{Route::currentRouteName() == 'images_list' ? 'current' : ''}}"><a href="{{route('images_list')}}">Images</a></li>
        </ul>
    </div>
</nav>