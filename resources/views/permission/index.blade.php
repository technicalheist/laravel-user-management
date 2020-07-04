@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                <h2>Permisssion List <a style="float:right" href="{{url('/permission/create')}}" class="btn tooltipped" data-position="bottom" data-tooltip="Add Permission"> <i class="material-icons">add</i></a></h2>
                <div>
                    <table id="permissionTable" class="table">
                    <thead>
                    <tr>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($permissions as $value)
                    <tr>
                    <td>{{$value->category}}</td>
                    <td>{{$value->name}}</td>
                    <td>{{$value->description}}</td>
                    <td>  
                    <a style="float:right" href="{{url('/permission/delete/'.$value->id)}}" class=" tooltipped" data-position="bottom" data-tooltip="Delete Permission"> <i class="material-icons">delete</i></a>
                    <a style="float:right" href="{{url('/permission/edit/'.$value->id)}}" class=" tooltipped" data-position="bottom" data-tooltip="Edit Permission"> <i class="material-icons">edit</i></a>
                    </td>
                    </tr>
                    @endforeach
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer_script')
<script>
$(document).ready(function(){
    $('.tooltipped').tooltip();
  });
  @if(Session::has('success'))
     M.toast({html: '{{Session::get('success')}}', classes: 'rounded'});
  @endif
</script>
<script>
  $(document).ready( function () {
    $('#permissionTable').DataTable();
} );
  </script>
@endsection