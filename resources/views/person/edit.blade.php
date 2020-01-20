@extends('../../share/Layout')

@section('CustomHeader')
 <link rel="stylesheet" href="{{Route('homeIndex')}}/template/concept/assets/vendor/multi-select/css/multi-select.css">
@endsection

@section('Breadcumbs')
  @include('../share/Breadcumbs' , [ 'Links' => array(
                                            "Home"=>array("Title"=>"Home","Link"=>Route('homeIndex'),"Active"=>false),
                                            "Person"=>array("Title"=>"Person","Link"=>Route('personIndex'),"Active"=>false),
                                            "PersonEdit"=>array("Title"=>"New","Link"=>"#","Active"=>true)
                                      )])
@endsection

@section('content')
<div class="container">
  <div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="section-block" id="inputgroup">
            <h3 class="section-title">Person</h3>
        </div>
        <div class="card">
            <form action="{{ URL::ROUTE('personUpdate') }}" method="POST">
            @csrf
            @method('put')
            <input type="hidden" id="id" name="id" value="{{$id}}"/>
            <h5 class="card-header">Edit Person</h5>
            <div class="card-body">
                <div class="form-row">
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2">
                      <label for="validationCustom03">Name</label>
                      <input type="text" name="name" class="form-control" id="validationCustom03" placeholder="Name" value="{{ $name ?? '' }}">
                      <div class="invalid-feedback">
                          name
                      </div>
                      @if($errors->first('name'))<div class="alert red-text">{{ $errors->first('name') }}</div>@endif
                  </div>
                  <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 mb-2 text-center">
                    <label>Assings Products</label>
                    <select name="products[]" id="products" class="form-control" multiple>
                        @forelse ($productList as $item)
                            <option 
                              @foreach($products as $idProductSelected)
                                @if($idProductSelected==$item->id)
                                  selected="selected"
                                @endif
                              @endforeach
                            value="{{$item->id}}">{{$item->name}}</option>
                        @empty
                            <option>Don't have product</option>
                        @endforelse
                    </select>
                    <div class="invalid-feedback">
                        products
                    </div>
                    @if($errors->first('products'))<div class="alert red-text">{{ $errors->first('products') }}</div>@endif
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
      $('#products').multiSelect();
    });
  </script>
@endsection