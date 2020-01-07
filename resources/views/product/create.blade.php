@extends('../../share/Layout')

@section('Breadcumbs')
  @include('../share/Breadcumbs' , [ 'Links' => array(
                                            "Home"=>array("Title"=>"Home","Link"=>Route('homeIndex'),"Active"=>false),
                                            "Product"=>array("Title"=>"Product","Link"=>Route('productIndex'),"Active"=>false),
                                            "ProductCreate"=>array("Title"=>"New","Link"=>Route('productCreate'),"Active"=>true)
                                      )])
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="section-block" id="inputgroup">
            <h3 class="section-title">Product</h3>
            <p>to here you can write information for the form</p>
        </div>
        <div class="card">
            <form action="{{ URL::ROUTE('productStore') }}" method="POST">
            @csrf 
            <h5 class="card-header">New Product</h5>
            <div class="card-body">
                <div class="form-row">
                  <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="validationCustom03">Name</label>
                      <input type="text" name="Name" class="form-control" id="validationCustom03" placeholder="Name" value="{{ $Name ?? '' }}">
                      <div class="invalid-feedback">
                          Name
                      </div>
                      @if($errors->first('Name'))<div class="alert red-text">{{ $errors->first('Name') }}</div>@endif
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="validationCustom04">Price</label>
                      <input name="Price" type="number" class="form-control" id="validationCustom04" placeholder="Price" value="{{ $Price ?? '' }}">
                      <div class="invalid-feedback">
                          Price
                      </div>
                      @if($errors->first('Price'))<div class="alert red-text">{{ $errors->first('Price') }}</div>@endif
                  </div>
                  <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12 mb-2">
                    <label for="validationCustom04">Type of Product</label>
                    <select name="idTypeProduct" class="form-control">
                        @forelse ($TypeProducts as $item)
                            <option {{isset($idTypeProduct)?$item->id==$idTypeProduct?"selected":"":""}} value="{{$item->id}}">{{$item->name}}</option>
                        @empty
                            <option>Don't have type of product</option>
                        @endforelse
                    </select>
                    <div class="invalid-feedback">
                        Type Product
                    </div>
                    @if($errors->first('idTypeProduct'))<div class="alert red-text">{{ $errors->first('idTypeProduct') }}</div>@endif
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