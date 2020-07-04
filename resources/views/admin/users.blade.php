@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                <h2>Users</h2>
                <p> 
                <a href="{{url('/users/create')}}" class="btn btn-success">Create</a>
                @if(isAdmin())
                <a href="{{url('/permission')}}" class="btn btn-success">Permission</a>
                @endif
                </p>
                <div>
                    <table class="table datatable" >
                    <thead>
                    <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>User Type</th>
                    <th>Action</th>
                    </tr>
                    </thead>
                     <tbody>
                     @foreach($users as $user)
                    <tr>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{ ($user->user_type == 1 ) ? 'Admin' : (($user->user_type == 2) ? 'Staff' : 'User')}}</td>
                    <td>
                    @if(checkAdminPermission($user->id))
                    <a href="{{url('/users/edit/'.$user->id)}}"><i class="small material-icons">border_color</i></a> 
                    @if(isAuthorized('can_delete_user'))
                    <a onclick="return confirm('Are you sure, you want to delete this user?')" href="{{url('/users/delete/'.$user->id)}}"><i class="small material-icons">delete_forever</i></a>
                    @endif
                    @endif
                     </td>
                    </tr>
                    </tbody>
                    @endforeach
                    </table>
                </div>
            </div>

            {{ $users->links() }}
        </div>
    </div>
</div>
@endsection


@section('footer_script')
<script>
  @if(Session::has('success'))
     M.toast({html: '{{Session::get('success')}}', classes: 'rounded'});
  @endif
  </script>
  @endsection
