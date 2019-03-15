<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-success" href="{{route('exhibition_new')}}">Add new</a>
        </div>
    </div>
</div>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>City</th>
            <th>Open - Close</th>
            <th>Institution</th>
            <th>Editors</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($exhibitions as $exhibition)
        <tr>
            <td>{{$exhibition->id}}</td>
            <td>{{$exhibition->name}}</td>
            <td>{{implode(', ', $exhibition->cities()->pluck('name')->toArray())}}</td>
            <td>{{$exhibition->open}} - {{$exhibition->expired}}</td>
            <td>{{$exhibition->institution()->first()->name}}</td>
            <td>{{implode(', ', $exhibition->editors()->pluck('name')->toArray())}}</td>
            <td>
                <a class="btn btn-primary" href="{{route('exhibition_edit', ['id' => $exhibition->id])}}">edit</a>
                <a onClick="return confirm('Are you sure?')" class="btn btn-danger" href="{{route('exhibition_remove', ['id'=> $exhibition->id])}}">remove</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{$exhibitions->links()}}