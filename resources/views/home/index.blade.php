@extends('../share/Layout')

@section('Breadcumbs')
  @include('../share/Breadcumbs' , [ 'Links' => array(
                                            "Home"=>array("Title"=>"Home","Link"=>Route('homeIndex'),"Active"=>true)
                                      )])
@endsection

@section('content')
  <h1>Test</h1>
@endsection

