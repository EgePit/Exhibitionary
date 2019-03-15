<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-success" href="{{route('institution_types_new')}}">Add new</a>
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
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($institution_types as $institution_type)
        <tr>
            <td>{{$institution_type->id}}</td>
            <td>{{$institution_type->name}}</td>
            <td>
                <a class="btn btn-primary" href="{{route('institution_types_edit', ['id' => $institution_type->id])}}">edit</a>
                <a onClick="return confirm('Are you sure?')" class="btn btn-danger" href="{{route('institution_types_remove', ['id'=> $institution_type->id])}}">remove</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{$institution_types->links()}}