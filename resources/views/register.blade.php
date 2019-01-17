@extends('master')

@section('content')
<?php
print_r($allCt);
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
                    <form class="form-horizontal" method="POST" id="form" action="{{ route('register') }}" novalidate="">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <br />

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <br />

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <br />

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>
                        <br />

                        <div class="form-group">
                            <label for="address" class="col-md-4 control-label">Address</label>

                            <div class="col-md-6{{($errors->has("address"))?" has-error":""}}">
                                <textarea name="address" class="form-control">{{old('address')}}</textarea>
                                @if ($errors->has('address'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <br />


                        <div class="form-group">
                            <label for="cntid" class="col-md-4 control-label">Country</label>

                            <div class="col-md-6{{($errors->has("cntid"))?" has-error":""}}">
                                <select name="cntid" id="cntid" class="form-control">
                                    <option value="0">Choose Country</option>
                                    @foreach($allCnt as $value)
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('cntid'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('cntid') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <br />
                        <div class="form-group">
                            <label for="ctid" class="col-md-4 control-label">City</label>

                            <div class="col-md-6{{($errors->has("city_id"))?" has-error":""}}">
                                <select name="city_id" id="ctid" class="form-control">
                                    <option value="0">Choose Country First</option>
                                </select>
                                @if ($errors->has('cntid'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('city_id') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <br />
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="g-recaptcha" data-sitekey="6LdMy2IUAAAAACvO-d8IdayHoGcH3xVm-9MQHWzH"></div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
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
foreach ($allCnt as $cnt) {
    echo "else if(cnt == $cnt->id){";
    foreach ($allCt as $ct) {
        if ($ct->country_id == $cnt->id) {
            echo "$(\"#ctid\").append(\"<option value='{$ct->id}'>$ct->name</option>\");";
        }
    }
    echo "}";
}
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
