@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('ibusiness::businesses.title.create business') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.ibusiness.business.index') }}">{{ trans('ibusiness::businesses.title.businesses') }}</a></li>
        <li class="active">{{ trans('ibusiness::businesses.title.create business') }}</li>
    </ol>
@stop

@section('content')
<style media="screen">
  .help-block{
    color:red;
  }
</style>
    {!! Form::open(['route' => ['admin.ibusiness.business.store'], 'method' => 'post','novalidate']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <div class="tab-content">
                    @include('ibusiness::admin.businesses.partials.create-fields')
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.create') }}</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.ibusiness.business.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
                    </div>
                </div>
            </div> {{-- end nav-tabs-custom --}}
        </div>
    </div>
    {!! Form::close() !!}
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>b</code></dt>
        <dd>{{ trans('core::core.back to index') }}</dd>
    </dl>
@stop

@push('js-stack')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js" type="text/javascript"></script>
    <script type="text/javascript">
        function showShippingForm(){
          var checkbox=$('#addressShipping').prop('checked');
          if(checkbox==true){
            console.log('Hide form');
            $('#formShipping').hide();
          }else{
            console.log('Show form');
            $('#formShipping').show();
          }
        }//showShippingForm()
        $( document ).ready(function() {
          $('#nit').mask('000000000-A');
          $('#phone').mask('000 0000000');
          $('.postcode').mask('0000000000');
            $(document).keypressAction({
                actions: [
                    { key: 'b', route: "<?= route('admin.ibusiness.business.index') ?>" }
                ]
            });
        });
    </script>
    <script>
        $( document ).ready(function() {
            $('input[type="checkbox"].flat-blue, input[type="radio"].flat-blue').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });
        });
    </script>
    <script type="text/javascript">
    $.ajax({
      url:"{{url('/')}}"+'/api/ilocations/allmincountries',
      type:'GET',
      headers:{'X-CSRF-TOKEN': "{{csrf_token()}}"},
      dataType:"json",
      data:{},
      success:function(result){
        if(result.length>0){
            //load select of countries
            for(var i=0;i<result.length;i++){
              $('#country').append('<option value="'+result[i]['iso_2']+'">'+result[i]['name']+'</option>');
              $('#country_s').append('<option value="'+result[i]['iso_2']+'">'+result[i]['name']+'</option>');
            }
        }//
      },
      error:function(error){
        console.log(error);
      }
    });//ajax
    function loadCity(iso){
      $.ajax({
        url:"{{url('/')}}"+'/api/ilocations/allprovincesbycountry/iso2/' + iso,
        type:'GET',
        headers:{'X-CSRF-TOKEN': "{{csrf_token()}}"},
        dataType:"json",
        data:{},
        success:function(result){
          $('#city').empty();
          if(result.length>0){
              //load select of city
              for(var i=0;i<result.length;i++){
                $('#city').append('<option value="'+result[i]['iso_2']+'">'+result[i]['name']+'</option>');
              }//for()
          }//result.length>0
        },
        error:function(error){
          console.log(error);
        }
      });//ajax
    }//loadCity
    function loadCity_s(iso){
      $.ajax({
        url:"{{url('/')}}"+'/api/ilocations/allprovincesbycountry/iso2/' + iso,
        type:'GET',
        headers:{'X-CSRF-TOKEN': "{{csrf_token()}}"},
        dataType:"json",
        data:{},
        success:function(result){
          $('#city_s').empty();
          if(result.length>0){
              //load select of city
              for(var i=0;i<result.length;i++){
                $('#city_s').append('<option value="'+result[i]['iso_2']+'">'+result[i]['name']+'</option>');
              }//for()
          }//result.length>0
        },
        error:function(error){
          console.log(error);
        }
      });//ajax
    }
    </script>
@endpush
