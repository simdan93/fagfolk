@extends('no.layouts.company_dashboard')
@section('title', 'Mine services')
@section('page_heading','Laravel Multiple File Upload')

@section('dashboard-content')
<div class="">
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
  <form method="post" action="{{url('no/selskap/profil/uploadImages')}}" enctype="multipart/form-data">
    {{csrf_field()}}

    <div class="input-group control-group increment" >
      <input type="file" name="filename[]" class="form-control">
      <div class="input-group-btn">
        <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
      </div>
    </div>
    <div class="clone hide">
      <div class="control-group input-group" style="margin-top:10px">
        <input type="file" name="filename[]" class="form-control">
        <div class="input-group-btn">
          <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
        </div>
      </div>
    </div>

    <button type="submit" class="btn btn-primary" style="margin-top:10px">Submit</button>
  </form>
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
@stop
