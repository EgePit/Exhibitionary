<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-success" href="{{route('institution_new')}}">Add new</a>
        </div>
    </div>
</div>
@if ($errors->has('used'))
    <span class="error">
        <strong>{{ $errors->first('used') }}</strong>
    </span>
@endif
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>City</th>
            <th>Type</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($institutions as $institution)
        <tr>
            <td>{{$institution->id}}</td>
            <td>{{$institution->name}}</td>
            <td>{{$institution->city_id()->first()->name}}</td>
            <td>{{$institution->type_id()->first()->name}}</td>
            <td>
                <a class="btn btn-primary" href="{{route('institution_edit', ['id' => $institution->id])}}">edit</a>
                <a onClick="return confirm('Are you sure?')" class="btn btn-danger" href="{{route('institution_remove', ['id'=> $institution->id])}}">remove</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{$institutions->links()}}