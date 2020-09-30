@extends('layouts.app')

@section('content')

<style type="text/css">
    th,td{
        border: 1px solid #dddddd;
    }
</style>
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">User List
                <div class="row">
                    <div class="col-sm-8"></div>
                    <div class="col-sm-4" align="right">
                       <a href="/add_bulk" class="btn btn-info "><i class="fa fa-plus" aria-hidden="true"></i> Import bulk users</a>
                    </div>           
                </div>
            </div>

            <div class="panel-body">
                @if(session('status'))
                    <div class="alert alert-success">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{ session('status') }}
                    </div>
                @elseif(session('status_delete'))
                    <div class="alert alert-danger">
                      <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a> {{ session('status_delete') }}
                    </div>
                @endif

                <table id="user_table" class="display nowrap dataTable" cellspacing="0">
                    <thead>
                        <th class="text-center">User name</th>
                        <th class="text-center">Email address</th>
                        <th class="text-center">User level</th>
                        <th class="text-center">Birthday</th>
                        <th class="text-center">Department</th>
                        <th class="text-center">Create date</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Action</th>
                    </thead>
                    <tbody>
                    @if(isset($users))
                      @foreach ($users as $user)
                        <tr>
                          <td class="text-left">{{$user->name}}</td>
                          <td class="text-left">{{$user->email}}</td>
                          <td class="text-left">{{$user->user_level}}</td>
                          <td class="text-left">{{$user->birthday}}</td>
                          <td class="text-left">{{$user->department}}</td>
                          <td class="text-center">{{$user->created_at}}</td>
                          <td class="text-center">{{($user->status == 1 ? "Active" : "Deactive")}}</td>
                          <td class="text-center">
                            <a class="btn btn-warning" id='{{$user->id}}' href="user/{{$user->id}}" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>
                            <form action="/user/{{$user->id}}" class="pull-right" method="POST">
                                {{ csrf_field() }}
                                <button type="submit" name="delete" class="btn btn-danger" data-toggle="tooltip" title="Delete"><i class="fa fa-trash-o"></i></button>
                                <input type="hidden" name="_method" value="DELETE">
                            </form>
                           </td>                          
                        </tr>
                      @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection