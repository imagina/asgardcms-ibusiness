@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('ibusiness::userbusinesses.title.create userbusiness') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li><a href="{{ route('admin.ibusiness.userbusiness.index') }}">{{ trans('ibusiness::userbusinesses.title.userbusinesses') }}</a></li>
        <li class="active">{{ trans('ibusiness::userbusinesses.title.create userbusiness') }}</li>
    </ol>
@stop

@section('content')
    {!! Form::open(['route' => ['admin.ibusiness.userbusiness.store'], 'method' => 'post']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <div class="tab-content">
                    @include('ibusiness::admin.userbusinesses.partials.create-fields')
                    <div class="box-footer">
                        <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.create') }}</button>
                        <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.ibusiness.userbusiness.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
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
                    { key: 'b', route: "<?= route('admin.ibusiness.userbusiness.index') ?>" }
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
    function getBranch(company_id){
      // console.log('Getbranch'+company_id);
      if(company_id!=0){
        $.ajax({
          url:"{{url('/')}}"+'/backend/ibusiness/getbranch',
          type:'POST',
          headers:{'X-CSRF-TOKEN': "{{csrf_token()}}"},
          dataType:"json",
          data:{},
          success:function(result){
            if(result.success==1){
              console.log('work');
            }else{
              console.log('not work');
              //alert(result.message);
            }
          },
          error:function(error){
            console.log(error);
          }
        });//ajax
      }//company_id!=0
    }//function generateSiteMap
    $( document ).ready(function() {
        console.log( "ready!" );
    });
    </script>
@endpush
