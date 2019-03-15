<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-success" href="{{route('image_new')}}">Add new</a>
        </div>
    </div>
</div>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Thumb</th>
            <th>Name</th>
            <th>Used</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($images as $image)
        <tr>
            <td>{{$image->id}}</td>
            <td><img class="thumbnail" src="{{\App\Http\Controllers\Dashboard\ImagesController::getImageBySize($image->id, 'thumbnail')->url}}"/></td>
            <td>{{$image->name}}</td>
            <td>{{count($image->exhibitions()->pluck('name')->toArray()) > 0 ? 'Exhibitions:' : ''}} {{implode(', ', $image->exhibitions()->pluck('name')->toArray())}}
                @if(count($image->exhibitions()->pluck('name')->toArray()) > 0)
                <br />
                @endif
                {{count($image->users()->pluck('email')->toArray()) > 0 ? 'Users:' : ''}} {{implode(', ', $image->users()->pluck('email')->toArray())}}</td>
            <td>
                <a onClick="return confirm('Are you sure?')" class="btn btn-danger" href="{{route('image_remove', ['id'=> $image->id])}}">remove</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{$images->links()}}