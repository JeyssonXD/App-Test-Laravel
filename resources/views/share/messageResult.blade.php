<!--Help -->
<!--Requeriments: Title,Message,Type,Links(Array => Text,Url)-->

<!--Type 0 is Error----->
<!--Type 1 is Warning----->
<!--Type 2 is Information----->
<!--Type 3 is Success----->

@extends('../../share/Layout')

@section('content')
<section class="container">
<div class="row">
  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <div class="page-section" id="overview">
          <div class="row">
              <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                <h2>
                    @switch ($Type)
                      @case (0)
                        <i class="fas fa-bug"> {{$Title}}</i>
                        @break
                      @case (1)
                        <i class="fas fa-info-circle"> {{$Title}}</i>
                        @break
                      @case (2)
                        <i class="fas fa-exclamation-triangule"> {{$Title}}</i>
                        @break
                      @case (3)
                        <i class="fas fa-check-circle"> {{$Title}}</i>
                        @break
                      @default:
                        <i class="fas fa-info-circle"> {{$Title}}</i>
                        @break
                    @endswitch
                </h2>
                <p class="lead">{{$Message}}</p>
                  @if(isset($Links))
                    <p>you can redirect to link's recomended:</p>
                    <ul class="list-unstyled arrow">
                      @foreach ($Links as $item)
                        <li><a href="{{$item["Link"]}}" >{{$item["Text"]}}</a></li>
                      @endforeach
                    </ul>
                  @endif
              </div>
          </div>
      </div>
  </div>
</div>
</section>
@endsection

