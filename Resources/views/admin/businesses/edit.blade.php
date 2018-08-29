@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('ibusiness::businesses.title.edit business') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.ibusiness.business.index') }}">{{ trans('ibusiness::businesses.title.businesses') }}</a></li>
        <li class="active">{{ trans('ibusiness::businesses.title.edit business') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.ibusiness.business.update', $business->id], 'method' => 'put']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                @include('partials.form-tab-headers')
                <div class="tab-content">
                    <?php $i = 0; ?>
                    @foreach (LaravelLocalization::getSupportedLocales() as $locale => $language)
                        <?php $i++; ?>
                        <div class="tab-pane {{ locale() == $locale ? 'active' : '' }}" id="tab_{{ $i }}">
                            @include('ibusiness::admin.businesses.partials.edit-fields', ['lang' => $locale])
                        </div>
                    @endforeach

                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.update') }}</button>
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
    <script type="text/javascript">
        $( document ).ready(function() {
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
              if("{{$business->country}}"==result[i]['iso_2'])
                $('#country').append('<option value="'+result[i]['iso_2']+'" selected>'+result[i]['name']+'</option>');
              else
                $('#country').append('<option value="'+result[i]['iso_2']+'">'+result[i]['name']+'</option>');
            }//for
            loadCity("{{$business->country}}");
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
                if("{{$business->city}}"==result[i]['iso_2'])
                  $('#city').append('<option value="'+result[i]['iso_2']+'" selected>'+result[i]['name']+'</option>');
                else
                  $('#city').append('<option value="'+result[i]['iso_2']+'">'+result[i]['name']+'</option>');
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
