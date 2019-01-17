@extends('master')

@section('content')
<?php
?>
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">Register</div>

        <div class="panel-body">
          @if (session('error'))
          <div class="alert alert-danger">
            {{ session('error') }}
          </div>
          @endif
          <table style="align: center; width: 600px; margin: 0 auto; celpadding:0;" >
            <form action="{{url('/product-management')}}" method="post" enctype="multipart/form-data">
              {{csrf_field()}}
              <tr>
                <td><label>Title:</label></td>
                <td><input type="text" name="title" value="{{old('title')}}"></td>
              </tr>
              <tr>
                <td><label>Price:</label></td>
                <td><input type="text" name="price" value="{{old('price')}}"></td>
              </tr>
              <tr>
                <td><label>stock:</label></td>
                <td><input type="text" name="stock" value="{{old('stock')}}"></td>
              </tr>
              <tr>
                <td><label>discount:</label></td>
                <td><input type="text" name="discount" value=""></td>
              </tr>
              <tr>
                <td><label>description:</label></td>
                <td><textarea name="description" rows="4" cols="50"></textarea></td>
              </tr>
              <tr>
                <td><label>Subcategory:</label></td>
                <td>
                <select name="subcategory"> 
                  <option value="0"> Choose category </option>
                    <option>   </option>
                  
                  </select>
                </td>
              </tr>
              <tr>
                <td><label>Unit:</label></td>
                <td><select name="unit"> 
                    <option value="0"> Choose category </option>
                    <option>   </option>
                    
                  </select></td>
              </tr>

              <tr>
                <td><label>picture1:</label></td>
                <td><input type="file" name="picture1" value=""></td>
              </tr>

              <tr>
                <td><label>picture2:</label></td>
                <td><input type="file" name="picture2" value=""></td>
              </tr>

              <tr>
                <td><label>picture3:</label></td>
                <td><input type="file" name="picture3" value=""></td>
              </tr>
              

              <tr>
                <td></td>
                <td><input type="submit" name="submit" value="Submit"></td>
              </tr>

            </form>   
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function () {
    $("#cntid").change(function () {
      var cnt = $("#cntid").val();
      $("#ctid").html("");

      if (cnt == 0) {
        $("#ctid").append("<option value='0'>Choose Country First...</option>");
      }
<?php
/*
  foreach ($allCnt as $cnt) {
  echo "else if(cnt == $cnt->id){";
  foreach ($allCt as $ct) {
  if ($ct->country_id == $cnt->id) {
  echo "$(\"#ctid\").append(\"<option value='{$ct->id}'>$ct->name</option>\");";
  }
  }
  echo "}";
  }
 * 
 */
?>
      /*
       else if(cnt == 1){
       $("#ctid").append("<option value='1'>Dhaka</option>");
       $("#ctid").append("<option value='2'>Khulna</option>");
       }
       */
    });
  });
</script>
@endsection
