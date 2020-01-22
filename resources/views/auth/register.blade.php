@extends('../../share/Layout')

@section('CustomHeader')
 <link rel="stylesheet" href="{{Route('homeIndex')}}/template/concept/assets/vendor/multi-select/css/multi-select.css">
@endsection


@section('Breadcumbs')
  @include('../share/Breadcumbs' , [ 'Links' => array(
                                            "Home"=>array("Title"=>"Home","Link"=>Route('homeIndex'),"Active"=>false),
                                            "users"=>array("Title"=>"Users","Link"=>Route('userIndex'),"Active"=>true)
                                      )])
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="section-block" id="inputgroup">
            <h3 class="section-title">User</h3>
            <p>to here you can write information for the form</p>
        </div>
        <div class="card">
            <form action="{{ URL::ROUTE('userStore') }}" method="POST">
            @csrf 
            <h5 class="card-header">New User</h5>
            <div class="card-body">
                <div class="row">
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                    <br/>
                    <div class="form-row">
                        <label class="col-lg-2">Name</label>
                        <input type="text" name="name" class="form-control col-lg-10" id="validationCustom03" placeholder="Name" value="{{ $name ?? '' }}">
                        <div class="invalid-feedback">
                            Name
                        </div>
                        @if($errors->first('name'))<div class="alert red-text">{{ $errors->first('name') }}</div>@endif
                    </div>
                    <br/>
                    <div class="form-row">
                      <label class="col-lg-2">Email</label>
                      <input type="text" name="email" class="form-control col-lg-10" id="validationCustom03" placeholder="Email" value="{{ $email ?? '' }}" />
                      <div class="invalid-feedback">
                          Email
                      </div>
                      @if($errors->first('email'))<div class="alert red-text">{{ $errors->first('email') }}</div>@endif
                    </div>
                    <br/>
                    <div class="form-row">
                      <label class="col-lg-2">Password</label>
                      <input type="password" name="password" class="form-control col-lg-10" id="validationCustom03" placeholder="Password" value="{{ $password ?? '' }}" />
                      <div class="invalid-feedback">
                          Password
                      </div>
                      @if($errors->first('password'))<div class="alert red-text">{{ $errors->first('password') }}</div>@endif
                    </div>
                    <br/>
                    <div class="form-row">
                      <label class="col-lg-2">Remember password</label>
                      <input type="password" name="password_confirmation" class="form-control col-lg-10" id="validationCustom03" placeholder="Remember password" value="{{ $rememberPassword ?? '' }}" />
                      <div class="invalid-feedback">
                          Remember password
                      </div>
                      @if($errors->first('password_confirmation'))<div class="alert red-text">{{ $errors->first('password_confirmation') }}</div>@endif
                    </div>
                    <br/>
                 </div>
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2 text-center">
                    <label>Assings roles</label>
                    <select name="roles[]" id="roles" class="form-control" multiple>
                        @forelse ($rolesList as $item)
                            <option 
                              @foreach($roles as $idRoleSelected)
                                @if($idRoleSelected==$item->id)
                                  selected="selected"
                                @endif
                              @endforeach
                            value="{{$item->id}}">{{$item->name}}</option>
                        @empty
                            <option>Don't have roles</option>
                        @endforelse
                    </select>
                    <div class="invalid-feedback">
                        roles
                    </div>
                    @if($errors->first('roles'))<div class="alert red-text">{{ $errors->first('roles') }}</div>@endif
                  </div>
                  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                      <button class="btn btn-primary" type="submit"><i class="far fa-save color-black"></i>  save</button>
                  </div>
              </div>
            </div>
          </form>
        </div>
    </div>
  </div>
</div>
@endsection

@section("CustomJs")
<script src="{{Route('homeIndex')}}/template/concept/assets/vendor/multi-select/js/jquery.multi-select.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('#roles').multiSelect();
    });
  </script>
@endsection