@extends('../../share/Layout')

@section('Breadcumbs')
  @include('../share/Breadcumbs' , [ 'Links' => array(
                                            "Home"=>array("Title"=>"Home","Link"=>Route('homeIndex'),"Active"=>false),
                                            "Product"=>array("Title"=>"Product","Link"=>Route('productIndex'),"Active"=>true)
                                      )])
@endsection

@section('content')
  <div class="container">
  <!--Form search-->
  <section class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <div class="card">
        <div class="card-body">
          <form class="form-inline" action="{{ URL::ROUTE('productIndex') }}" method="GET">
            @csrf
            <div class="form-group mb-2 display-block col-2">
              <h6 >Name</h6>
              <input type="text" placeholder="Name" class="form-control" id="name"  name="name" value="{{ $model?$model->name??'':''  }}">
              @if($errors->first('name'))<h6 class="alert red-text">{{ $errors->first('name') }}</h6>@endif
            </div>
            <div class="form-group mx-sm-3 mb-2 display-block col-2">
              <h6 >Price</h6>
              <input type="number" class="form-control" id="price" name="price" value="{{ $model?$model->price??'':'' }}" placeholder="Price">
              @if($errors->first('price'))<div class="alert red-text">{{ $errors->first('price') }}</div>@endif
            </div>
            <div class="form-group mx-sm-4 mb-2 display-block col-2" >
              <h6 >TypeProduct</h6>
              <select name="idTypeProduct" class="form-control">
                    <option >Seleccione</option>
                    @forelse ($typeProducts as $item)
                        <option {{$model?$model->idTypeProduct?$item->id==$model->idTypeProduct?"selected":"":"":""}} value="{{$item->id}}">{{$item->name}}</option>
                    @empty
                        <option>Don't have type of product</option>
                    @endforelse
              </select>
              @if($errors->first('idTypeProduct'))<div class="alert red-text">{{ $errors->first('idTypeProduct') }}</div>@endif
            </div>
            <button type="submit" class="btn btn-primary mb-2 btn-sm"><i class="fa fa-search"></i> Search</button>
          </form>
        </div>
      <div>
    </div>
  </section>
  <!--List data-->
  <section class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <div class="card">
          <h5 class="card-header">List of Products  <a class="btn btn-primary btn-sm" href="{{route('productCreate')}}"><i class="fa fa-plus"></i> New</a></h5>
          <div class="table-responsive ">
          <div class="card-body">
              <table class="table table-bordered table-hover text-center">
                  <thead>
                      <tr>
                          <th scope="col"><a class="btn btn-sm btn-primary" href="{{ route('productIndex',[
                                                                                                            'sortOrder'=>$currentOrder,
                                                                                                            'currentName'=>$currentFilter?$currentFilter->name??'':'',
                                                                                                            'currentPrice'=>$currentFilter?$currentFilter->price??'':'',
                                                                                                            'currentIdTypeProyect'=>$currentFilter?$currentFilter->idTypeProduct??'':''
                                                                                                          ]) }}">
                                          <i class="fa fa-sort color-white"></i><strong class="black">Name</strong></a></th>
                          <th scope="col">Price</th>
                          <th scope="col">TypeProduct</th>
                          <th scope="col">Options</th>
                      </tr>
                  </thead>
                  <tbody>
                        @foreach ($products as $product)
                        <tr>
                          <td>{{ $product->name }}</td>
                          <td>{{ $product->price }}</td>
                          <td>{{ $product->typeProduct[0]->name}}</td>
                          <td><div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Options
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="{{route('productEdit',['id'=>$product->id])}}">Edit</a>
                              <a class="dropdown-item" href="#">Delete</a>
                            </div>
                          </div></td>
                        </tr>
                         @endforeach
                  </tbody>
              </table>
            </div>
          </div>
      </div>
      {{ $products->appends([
                            'sortOrder'=>$currentOrder,
                            'currentName'=>$currentFilter?$currentFilter->name??'':'',
                            'currentPrice'=>$currentFilter?$currentFilter->price??'':'',
                            'currentIdTypeProyect'=>$currentFilter?$currentFilter->idTypeProduct??'':''
                            ])->links() }}
  </div>
  </section>
</div>
@endsection
