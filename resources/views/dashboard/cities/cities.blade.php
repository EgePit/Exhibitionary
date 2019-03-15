<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-success" href="{{route('city_new')}}">Add new</a>
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
            <th>Code</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($cities as $city)
        <tr>
            <td>{{$city->id}}</td>
            <td>{{$city->name}}</td>
            <td>{{$city->code}}</td>
            <td>
                <a class="btn btn-primary" href="{{route('city_edit', ['id' => $city->id])}}">edit</a>
                <a onClick="return confirm('Are you sure?')" class="btn btn-danger" href="{{route('city_remove', ['id'=> $city->id])}}">remove</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{$cities->links()}}