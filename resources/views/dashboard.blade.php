@extends('layouts.app')
@section('menu')
    @include('layouts.menu')
@endsection
@section('content')
<div class="card">
    <div class="card-header">Dashboard</div>

    <div class="card-body">
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        @if (Route::currentRouteName() == 'dashboard')
            <span>You are logged in!</span>
        @elseif (Route::currentRouteName() == 'users_list')
            @include('dashboard.users.users')
        @elseif (Route::currentRouteName() == 'user_edit' || Route::currentRouteName() == 'user_new')
            @include('dashboard.users.userForm')
        @elseif (Route::currentRouteName() == 'cities_list')
            @include('dashboard.cities.cities')
        @elseif (Route::currentRouteName() == 'city_edit' || Route::currentRouteName() == 'city_new')
            @include('dashboard.cities.cityForm')
        @elseif (Route::currentRouteName() == 'districts_list')
            @include('dashboard.districts.districts')
        @elseif (Route::currentRouteName() == 'district_edit' || Route::currentRouteName() == 'district_new')
            @include('dashboard.districts.districtForm')
        @elseif (Route::currentRouteName() == 'institution_types_list')
            @include('dashboard.institution_types.institution_types')
        @elseif (Route::currentRouteName() == 'institution_types_edit' || Route::currentRouteName() == 'institution_types_new')
            @include('dashboard.institution_types.institution_typeForm')
        @elseif (Route::currentRouteName() == 'images_list')
            @include('dashboard.images.images')
        @elseif (Route::currentRouteName() == 'image_edit' || Route::currentRouteName() == 'image_new')
            @include('dashboard.images.imageForm')
        @elseif (Route::currentRouteName() == 'institutions_list')
            @include('dashboard.institutions.institutions')
        @elseif (Route::currentRouteName() == 'institution_edit' || Route::currentRouteName() == 'institution_new')
            @include('dashboard.institutions.institutionForm')
        @elseif (Route::currentRouteName() == 'editors_list')
            @include('dashboard.editors.editors')
        @elseif (Route::currentRouteName() == 'editor_edit' || Route::currentRouteName() == 'editor_new')
            @include('dashboard.editors.editorForm')
        @elseif (Route::currentRouteName() == 'exhibitions_list')
            @include('dashboard.exhibitions.exhibitions')
        @elseif (Route::currentRouteName() == 'exhibition_edit' || Route::currentRouteName() == 'exhibition_new')
            @include('dashboard.exhibitions.exhibitionForm')
        @endif
    </div>
</div>
@endsection

