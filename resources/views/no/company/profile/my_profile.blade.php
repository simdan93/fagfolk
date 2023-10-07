@extends('no.layouts.company_dashboard')
@section('title', 'Min profil')
@section('page_heading','Min profil')

@section('dashboard-content')
<div class="panel panel-default">
  <div class="panel-heading">Mitt arbeidsområde</div>
  <div class="panel-body">
    <div id="map"></div>
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">{{ $companyInfo[0]->navn }}</div>
  <div class="panel-body">
    @if($companyDetails == null)
      <a href="{{ route('company.fillInfo') }}">Fyll inn selskapsopplysninger</a>
    @else
      <p>Selskapsnavn: {{ $companyDetails[0]->selskap }} </p>
      <p>Organisasjonsnummer: {{ $companyDetails[0]->org_nummer }}</p>
      @if(isset($companyWorkAreas))
        <p id="workarea">
          Arbeidsområde:
          @foreach($companyWorkAreas as $companyWorkArea)
            {{ $companyWorkArea->postnummer }}
          @endforeach
        </p>
      @endif
      <input type="hidden" name="officeAddress" id="officeAddress" value="{{$companyWorkAreas[0]->postnummer}}">

    @endif

  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">Bilder opplastet</div>
  <div class="panel-body">
    @if (count($errors) > 0)
      <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
    @if(session('success'))
    <div class="alert alert-success">
      {{ session('success') }}
    </div>
    @endif
    <a href = '#' data-toggle="modal" data-target="#uploadImages" data-backdrop="static">Opplast bilder</a>

    <form method="POST" action="profil/slett-bilder" enctype="multipart/form-data">
      {{ csrf_field() }}
      <input type="submit" name="image" value="Slett bilder">
      <hr>
      @php($count = 0)
      @for($i = 0; $i < 2; $i++)
        @if(!isset($imagesForCompany[$count]))
          @break
        @endif
        <div class="mainServiceRow">
        @for($j = 0; $j < 4; $j++)
          <div class="column" style="width:25%;height:230px;">
            <img class="hover-shadow image-resize" src="{{ asset('images/company_' . $companyInfo[0]->id . '/'.  $imagesForCompany[$count]->filename) }}" onclick="openModal();currentSlide({{$count+1}})"/>
            <input type="checkbox" name="image[]" value="{{$imagesForCompany[$count]->id}}" style="margin: 0;position: absolute;margin-top: 200px;z-index: 1;float: left!important;">
          </div>
          @php($count = $count + 1)
          @if(!isset($imagesForCompany[$count]))
            @break
          @endif
        @endfor
        </div>
        @if(!isset($imagesForCompany[$count]))
          @break
        @endif
      @endfor
    </form>
  </div>
</div>


<div class="panel panel-default">
  <div class="panel-heading">Om oss</div>
  <div class="panel-body">
    <h3>Beskrivelse</h3>
    <h3>Sertifikater og utmerkelser</h3>
  </div>
</div>

<div class="panel panel-default">
  <div class="panel-heading">Evalueringer</div>
  <div class="panel-body">
  </div>
</div>

<!-- Modal-Add-Service -->
<div class="modal fade" id="uploadImages">
  <div class="modal-dialog">
      <div class="modal-content">
        <form method="POST" action="profil/uploadImages" enctype="multipart/form-data">
          {{ csrf_field() }}
          <div class="modal-header">
              <h3 class="modal-title">Legg til service</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
              @include('no.includes.forms.uploadImages')
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Avbryt</button>
              <button type="submit" class="btn btn-primary">Legg til</button>
          </div>
        </form>
      </div>
  </div>
</div>

<!-- The Modal/Lightbox -->
<div id="myModal" class="modal-slide">
  <span class="close-slide cursor" onclick="closeModal()">&times;</span>
  <div class="modal-slide-content">

    @foreach ($imagesForCompany as $key2 => $image2)
      <div class="mySlides">
          <div class="numbertext">{{$key2+1}} / {{$count+1}}</div>
        <img class="image-resize" src="{{ asset('images/company_' . $companyInfo[0]->id . '/'.  $image2->filename) }}" style="height:500px"/>
      </div>
    @endforeach

    <!-- Next/previous controls
    <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
    <a class="next" onclick="plusSlides(1)">&#10095;</a>-->

    <!-- Caption text -->
    <div class="caption-container">
      <p id="caption"></p>
    </div>
    <!-- Thumbnail image controls -->
    @foreach ($imagesForCompany as $key3 => $image3)
      <div class="column" style="width:25%;height:300px">
        <img class="image-resize" src="{{ asset('images/company_' . $companyInfo[0]->id . '/'.  $image3->filename) }}" class="demo cursor" onclick="currentSlide({{$key3+1}})" alt=""/>
      </div>
    @endforeach
  </div>
</div>
@stop

@section('scripts')
<script type="text/javascript">
    $(document).ready(function() {
      $(".btn-success").click(function(){
          var html = $(".clone").html();
          $(".increment").after(html);
      });

      $("body").on("click",".btn-danger",function(){
          $(this).parents(".control-group").remove();
      });
    });
</script>
<script>
// Open the Modal
function openModal() {
  document.getElementById('myModal').style.display = "block";
}

// Close the Modal
function closeModal() {
  document.getElementById('myModal').style.display = "none";
}

var slideIndex = 1;
showSlides(slideIndex);

// Next/previous controls
function plusSlides(n) {
  showSlides(slideIndex += n);
}

// Thumbnail image controls
function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  var i;
  var slides = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("demo");
  var captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace(" active", "");
  }
  slides[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += " active";
  captionText.innerHTML = dots[slideIndex-1].alt;
}
</script>
<script>
  var map;
  var geocoder;
  function initMap() {
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(-34.397, 150.644);
    var mapOptions = {
      zoom: 8,
      center: latlng,
      //mapTypeId: google.maps.MapTypeId.ROADMAP,
      //mapTypeControl: false
    }
    map = new google.maps.Map(document.getElementById('map'), mapOptions);
    var infowindow = new google.maps.InfoWindow(), marker, lat, lng;
    var bounds = new google.maps.LatLngBounds();
    $.ajax(
    {
      type: "GET",
      url: "/no/selskap/profil/hent-arbeidsområder",
      cache: false,
      dataType: 'json',
      success: function(response)
      {
        var work_areas = jQuery.parseJSON(response);
        $.each(work_areas, function(key,postnummer) {
          geocoder.geocode({
              componentRestrictions: {
                country: 'NO',
                postalCode: postnummer['postnummer']
              }
            }, function(results, status) {
              if (status == 'OK') {
                  map.setCenter(results[0].geometry.location);
                    map.setZoom(10);
                    var marker = new google.maps.Marker({
                        map: map,
                        name: key,
                        position: results[0].geometry.location
                    });
                    //loc = new google.maps.LatLng(marker.position.lat(), marker.position.lng());
                    //bounds.extend(loc);
                    google.maps.event.addListener( marker, 'click', function(e){
                      infowindow.setContent( this.name );
                      infowindow.open( map, this );
                    }.bind( marker ) );

                  } else {
                    alert('Geocode was not successful for the following reason: ' + status);
                  }
            });
        });
        //map.fitBounds(bounds);       # auto-zoom
        //map.panToBounds(bounds);     # auto-center
      }
    });
  }
</script>
@stop
