@extends('../../share/Layout')

@section('Breadcumbs')
  @include('../share/Breadcumbs' , [ 'Links' => array(
                                            "Home"=>array("Title"=>"Home","Link"=>Route('homeIndex'),"Active"=>false),
                                            "typeProduct"=>array("Title"=>"type Product","Link"=>Route('typeProductIndex'),"Active"=>true)
                                      )])
@endsection

@section('content')
  <div class="container">
  <!--Form search-->
  <section class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <div class="card">
        <div class="card-body">
          <form class="form-inline" action="{{ URL::ROUTE('typeProductIndex') }}" method="GET">
            @csrf
            <div class="form-group mb-2  mx-sm-3 display-block col-2">
              <h6 >Name</h6>
              <input type="text" placeholder="name" class="form-control" id="name"  name="name" value="{{ $model?$model->name??'':''  }}">
              @if($errors->first('name'))<h6 class="alert red-text">{{ $errors->first('name') }}</h6>@endif
            </div>
            <button type="submit" class="btn btn-primary  mx-sm-3 mb-2 btn-sm"><i class="fa fa-search"></i> Search</button>
          </form>
        </div>
      <div>
    </div>
  </section>
  <!--List data-->
  <section class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <div class="card">
          <h5 class="card-header">List of type Products  <a class="btn btn-primary btn-sm" href="{{route('typeProductCreate')}}"><i class="fa fa-plus"></i> New</a></h5>
          <div class="table-responsive ">
          <div class="card-body">
              <table class="table table-bordered table-hover text-center">
                  <thead>
                      <tr>
                          <th class="hidden">id</th>
                          <th scope="col"><a class="btn btn-sm btn-primary" href="{{ route('typeProductIndex',[
                                                                                                            'sortOrder'=>$nextOrder,
                                                                                                            'currentName'=>$currentFilter?$currentFilter->name??'':''
                                                                                                          ]) }}">
                          <i class="fa fa-sort color-white"></i><strong class="black">Name</strong></a></th>
                          <th scope="col">Options</th>
                      </tr>
                  </thead>
                  <tbody>
                        @foreach ($typeProducts as $typeProduct)
                        <tr>
                          <td class="hidden">{{ $typeProduct->id }}</td>
                          <td>{{ $typeProduct->name }}</td>
                          <td><div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Options
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="{{route('typeProductEdit',['id'=>$typeProduct->id])}}"><i class="fa fa-edit"></i> Edit</a>
                              <button class="dropdown-item deleteTypeProduct mouse-pointer" ><i class="fa fa-trash-alt"></i> Delete</button>
                            </div>
                          </div></td>
                        </tr>
                         @endforeach
                  </tbody>
              </table>
            </div>
          </div>
      </div>
      {{ $typeProducts->appends([
                            'sortOrder'=>$currentOrder,
                            'currentName'=>$currentFilter?$currentFilter->name??'':''
                            ])->links() }}
  </div>
  </section>
</div>

<div id="modalDeleteTypeProduct" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Type Product: <span id="modalTypeProductName"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>you  want to remove this type product?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn" data-dismiss="modal">Close</button>
        <a class="btn btn-primary" id="modalTypeProductOk" href="{{route('typeProductDelete')}}">Delete</a>
      </div>
    </div>
  </div>
</div>

@endsection


@section("CustomJs")
    <script type="text/javascript">
        $(document).ready(function(){
            //remove product
            $(".deleteTypeProduct").click(function(){
                var id = $(this).parent().parent().parent().parent().find('td').eq(0).html();
                var name = $(this).parent().parent().parent().parent().find('td').eq(1).html();
                $("#modalTypeProductName").text(name);
                $("#modalTypeProductOk").attr("href",$("#modalTypeProductOk").attr("href")+"?id="+id);
                //open modal
                $('#modalDeleteTypeProduct').modal('show');
            });
        });
    </script>
@endsection