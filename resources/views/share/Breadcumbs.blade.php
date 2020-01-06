<!--Help -->
<!--Requeriments: Links(Array) of Arrays-->


<div class="row">
  <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
      <div class="page-header">
          <h2 class="pageheader-title">App Test Laravel</h2>
          <p class="pageheader-text">this one aplication for recharge memory of programation in this workstation</p>
          <div class="page-breadcrumb">
              <nav aria-label="breadcrumb">
                  <ol class="breadcrumb">
                      @foreach ($Links as $item)
                        <li class="{{$item["Active"]==true ? "breadcrumb-item active": "breadcrumb-item" }}" aria-current="page"><a href="{{$item["Link"]}}" class="breadcrumb-link">{{$item["Title"]}}</a></li>
                      @endforeach
                  </ol>
              </nav>
          </div>
      </div>
  </div>
</div>