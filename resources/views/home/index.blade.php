@extends('../share/Layout')

@section('Breadcumbs')
  @include('../share/Breadcumbs' , [ 'Links' => array(
                                            "Home"=>array("Title"=>"Home","Link"=>Route('homeIndex'),"Active"=>true)
                                      )])
@endsection

@section('content')
  <section class="container">
    <h1>Test</h1>
  </section>
@endsection

