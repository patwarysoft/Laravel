@extends('master')

@section('content')
<?php
?>
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
       
        <div class="panel-body">
          @if (session('msg'))
          <div class="alert alert-success">
            {{ session('msg') }}
          </div>
          @endif
           
          <table class="table table-striped table-hover">
            @forelse($allUsers as $usr)
            <tr>
              <td>{{$usr->name}}</td>
              
              <td><a href="{{url('/account-management/edit')}}/{{$usr->id}}">Edit</a></td>
              <td><a href="{{url('/account-management/delete')}}/{{$usr->id}}">delete</a></td>
            </tr>
            @empty
            <tr>
              <td colspan="8"><h1>No Data Found</h1></td>
            </tr>
            @endforelse
          </table>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection
