@extends('no.layouts.welcome_page')
@section('title', 'Forside')

@section('content')
<div class="welcomeBox">
  <div class="service-promo">
    <img src="images/1.jpg" alt="" style="margin-top:65px;width:100%;">
    <div class="welcome-text-box">
      <font size="7">Finn fagfolk enkelt.</font>
    </div>
    <div class="welcome-text-box" style="top: 70%;">
      <a href="#" data-toggle="modal" data-target="#loginAsPrivateUser"><button type="button" class="btn btn-primary" style="color:white;padding: 12px 24px;">Logg inn som en kunde</button></a>
      <a href="#" data-toggle="modal" data-target="#loginAsCompanyUser"><button type="button" class="btn btn-primary" style="color:white;padding: 12px 24px;">Logg inn som en fagman</button></a>
    </div>
  </div>
</div>

<div class="introduction-box">
  <h1>Kort introduksjon om Fagfolk.</h1>
  <div class="intro-text-box">
    <?php include 'texts/introduction.php';?>
  </div>
  <div class="intro-img-box">
    <img src="\images\Why-Choose-Us-BG-1024x448.jpg" alt="intro" style="width:100%;">
  </div>
</div>

<div class="findHelpBox">
  <div class="service-promo">
    <h1>Finn hjelp</h1>
    @php($count = 0)
    @php($serviceQueue = array(12, 14, 9, 3, 10, 6, 13, 5, 2, 1, 14, 7, 8, 4, 11))
    @for ($i = 0; $i < 5; $i++)
      <div class="mainServiceRow">
      @for ($j = 0; $j < 3; $j++)
        <div class="mainServiceBox" id="mainServiceBox{$count+1}">
          <div class="mainService" id="{{$serviceQueue[$count]}}" value="{{ $mainServices[$serviceQueue[$count]-1]->id }}">
            <img src="images/Services/main_services/service_id_{{ $mainServices[$serviceQueue[$count]-1]->id }}.jpg" width="100%" alt="{{ $mainServices[$serviceQueue[$count]-1]->hovedfag }}" >
            <h4 class="service-name pull-left"><b>{{ $mainServices[$serviceQueue[$count]-1]->hovedfag }}</b></h4>
          </div>
        </div>
        @php($count += 1)
      @endfor
      </div>

      @for ($j = ($count-2); $j <= $count; $j++)
      <div class="secServiceRow" id="seeSecondaryServices{{$serviceQueue[$j-1]}}">
        <!-- Filled by Javascript Ajax in seeSecondaryServices.js-->
      </div>
      @endfor
    @endfor
  </div>
</div>

<!-- Modals will be placed here -->
<div class="" id="modules" value="{{$userLogged}}">
</div>

<div class="newsBox">
  <div class="service-promo">
    News box
  </div>
</div>
@stop



@section('scripts')
<script src="/js/seeSecondaryServices.js"></script>
<script src="/js/seeSecDescription.js"></script>
@stop
