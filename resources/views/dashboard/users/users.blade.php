<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a class="btn btn-success" href="{{route('user_new')}}">Add new</a>
        </div>
    </div>
</div>
<table class="table">
    <thead>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Is Admin</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($users as $user)
        <tr>
            <td>{{$user->id}}</td>
            <td>{{$user->firstname}} {{$user->lastname}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->whois}}</td>
            <td>{{$user->is_admin}}</td>
            <td>
                <a class="btn btn-primary" href="{{route('user_edit', ['id' => $user->id])}}">edit</a>
                <a onClick="return confirm('Are you sure?')" class="btn btn-danger" href="{{route('user_remove', ['id'=> $user->id])}}">remove</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
{{$users->links()}}