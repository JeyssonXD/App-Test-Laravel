@extends('../../share/Layout')

@section('Breadcumbs')
  @include('../share/Breadcumbs' , [ 'Links' => array(
                                            "Home"=>array("Title"=>"Home","Link"=>Route('homeIndex'),"Active"=>false),
                                            "typeProduct"=>array("Title"=>"Type Product","Link"=>Route('typeProductIndex'),"Active"=>false),
                                            "typeProductEdit"=>array("Title"=>"Edit","Link"=>"#","Active"=>true)
                                      )])
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="section-block" id="inputgroup">
            <h3 class="section-title">Type Product</h3>
            <p>to here you can write information for the form</p>
        </div>
        <div class="card">
            <form action="{{ URL::ROUTE('typeProductUpdate') }}" method="POST">
            @csrf 
            @method("put")
            <input type="hidden" name="id"  value="{{ $id ?? '' }}"/>
            <h5 class="card-header">Edit Type Product</h5>
            <div class="card-body">
                <div class="form-row">
                  <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="validationCustom03">Name</label>
                      <input type="text" name="name" class="form-control" placeholder="name" value="{{ $name ?? '' }}">
                      <div class="invalid-feedback">
                          Name
                      </div>
                      @if($errors->first('name'))<div class="alert red-text">{{ $errors->first('name') }}</div>@endif
                  </div>
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