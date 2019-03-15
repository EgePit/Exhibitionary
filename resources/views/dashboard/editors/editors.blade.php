<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-success" href="{{route('editor_new')}}">Add new</a>
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
            <th>Cities</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($editors as $editor)
        <tr>
            <td>{{$editor->id}}</td>
            <td>{{$editor->name}}</td>
            <td>{{implode(', ', $editor->cities->pluck('code')->toArray())}}</td>
            <td>
                <a class="btn btn-primary" href="{{route('editor_edit', ['id' => $editor->id])}}">edit</a>
                <a onClick="return confirm('Are you sure?')" class="btn btn-danger" href="{{route('editor_remove', ['id'=> $editor->id])}}">remove</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{$editors->links()}}