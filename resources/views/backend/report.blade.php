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

               <form action="" method="get">
                  <table class="table table-striped table-hover">
                     <tr>
                        <td>
                           <label>Title</label>
                           <input type="text" name="title" />
                        </td>
                        <td>
                           <label>Start Price</label>
                           <input type="text" name="price1" />
                        </td>
                        <td>
                           <label>End Date</label>
                           <input type="text" name="price2" />
                        </td>
                        <td>
                           <label>Start Date</label>
                           <input type="text" name="date1" />
                        </td>
                        <td>
                           <label>End Date</label>
                           <input type="text" name="date2" />
                        </td>
                        <td>
                           <label>Customer</label>
                           <select name="userid">
                              <option value="0">All Customers</option>
                              @foreach($allUsers as $usr)
                              <option value="{{$usr->id}}">{{$usr->name}}</option>
                              @endforeach
                           </select>
                        </td>
                        <td>
                           <input type="submit" name="sub" value="Search" />
                        </td>
                     </tr>
                  </table>
               </form>
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
