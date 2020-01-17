@extends('../../share/Layout')

@section('Breadcumbs')
  @include('../share/Breadcumbs' , [ 'Links' => array(
                                            "Home"=>array("Title"=>"Home","Link"=>Route('homeIndex'),"Active"=>false),
                                            "Person"=>array("Title"=>"Person","Link"=>Route('personIndex'),"Active"=>true)
                                      )])
@endsection

@section('content')
  <div class="container">
  <!--Form search-->
  <section class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <div class="card">
        <div class="card-body">
          <form class="form-inline" action="{{ URL::ROUTE('personIndex') }}" method="GET">
            @csrf
            <div class="form-group mb-2 display-block col-2">
              <h6 >Name</h6>
              <input type="text" placeholder="Name" class="form-control" id="name"  name="name" value="{{ $model?$model->name??'':''  }}">
              @if($errors->first('name'))<h6 class="alert red-text">{{ $errors->first('name') }}</h6>@endif
            </div>
            <div class="form-group mb-2 display-block col-2 mx-sm-3">
              <h6>Products</h6>
              <select name="products[]" class="form-control chzn-select" multiple>
                @forelse ($products as $product)
                      <option 
                        @foreach ($model->products as $productSelected)
                          @if($productSelected==$product->id)
                            selected="selected"
                          @endif
                        @endforeach
                      value="{{$product->id}}">{{$product->name}}</option>
                  @empty
                    <option>Don't have type of product</option>
                @endforelse
              </select>
              @if($errors->first('products'))<h6 class="alert red-text">{{ $errors->first('producs') }}</h6>@endif
            </div>
            <button type="submit" class="btn btn-primary  btn-sm"><i class="fa fa-search"></i> Search</button>
          </form>
        </div>
      <div>
    </div>
  </section>
  <!--List data-->
  <section class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <div class="card">
          <h5 class="card-header">List of Person  <a class="btn btn-primary btn-sm" href="{{route('personCreate')}}"><i class="fa fa-plus"></i> New</a></h5>
          <div class="table-responsive ">
          <div class="card-body">
              <table class="table table-bordered table-hover text-center">
                  <thead>
                      <tr>
                          <th class="hidden">id</th>
                          <th scope="col"><a class="btn btn-sm btn-primary" href="{{ route('personIndex',[
                                                                                                            'sortOrder'=>$nextOrder,
                                                                                                            'currentName'=>$currentFilter?$currentFilter->name??'':'',
                                                                                                            'currentProducts'=>$currentFilter?$currentFilter->products??'':''
                                                                                                          ]) }}">
                                          <i class="fa fa-sort color-white"></i><strong class="black">Name</strong></a></th>
                          <th scope="col">Products</th>
                          <th scope="col">Options</th>
                      </tr>
                  </thead>
                  <tbody>
                        @foreach ($persons as $person)
                        <tr>
                          <td class="hidden">{{ $person->id }}</td>
                          <td>{{ $person->name }}</td>
                          <td>
                            <ul class="list-unstyled" >
                              @foreach ($person->products as $prodct)
                                <li style="float: left">
                                  <span class="badge badge-primary ml-1">{{$prodct->name}}</span>
                                </li>
                              @endforeach
                            </ul>
                          </td>
                          <td><div class="dropdown">
                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              Options
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="{{route('personEdit',['id'=>$person->id])}}"><i class="fa fa-edit"></i> Edit</a>
                              <button class="dropdown-item deletePerson mouse-pointer" ><i class="fa fa-trash-alt"></i> Delete</button>
                            </div>
                          </div></td>
                        </tr>
                         @endforeach
                  </tbody>
              </table>
            </div>
          </div>
      </div>
      {{ $persons->appends([
                            'sortOrder'=>$currentOrder,
                            'currentName'=>$currentFilter?$currentFilter->name??'':'',
                            'currentProducts'=>$currentFilter?$currentFilter->products??'':''
                            ])->links() }}
  </div>
  </section>
</div>

<div id="modalDeletePerson" class="modal" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Person: <span id="modalPersonName"></span></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>you  want to remove this person?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn" data-dismiss="modal">Close</button>
        <a class="btn btn-primary" id="modalPersonOk" href="{{route('personDelete')}}">Delete</a>
      </div>
    </div>
  </div>
</div>
@endsection


@section("CustomJs")
    <script type="text/javascript">
        $(document).ready(function(){
            //chosen
            $(".chzn-select").chosen({ placeholder_text_multiple: "seleccione", width: 150 });
            //remove product
            $(".deletePerson").click(function(){
                var id = $(this).parent().parent().parent().parent().find('td').eq(0).html();
                var name = $(this).parent().parent().parent().parent().find('td').eq(1).html();
                $("#modalPersonName").text(name);
                $("#modalPersonOk").attr("href",$("#modalPersonOk").attr("href")+"?id="+id);
                //open modal
                $('#modalDeletePerson').modal('show');
            });
        });
    </script>
@endsection