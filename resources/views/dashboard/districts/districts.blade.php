<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-success" href="{{route('district_new')}}">Add new</a>
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
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($districts as $district)
        <tr>
            <td>{{$district->id}}</td>
            <td>{{$district->name}}</td>
            <td>{{$district->city_id()->first()->name}}</td>
            <td>
                <a class="btn btn-primary" href="{{route('district_edit', ['id' => $district->id])}}">edit</a>
                <a onClick="return confirm('Are you sure?')" class="btn btn-danger" href="{{route('district_remove', ['id'=> $district->id])}}">remove</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{$districts->links()}}