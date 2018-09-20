@extends('layouts.master')
<style media="screen">
  th{
    text-align: center;
  }
</style>
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
    {!! Form::open(['route' => ['admin.ibusiness.userbusiness.store'], 'method' => 'post', 'id'=>'userbusiness']) !!}
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <div class="tab-content">
                    @include('ibusiness::admin.userbusinesses.partials.create-fields')
                    <div class="box-footer">
                        <button type="button" onclick="validate()" class="btn btn-primary btn-flat">{{ trans('ibusiness::userbusinesses.button.asign users') }}</button>
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
    var users=[];
    var url2="{{url('/')}}"+'/backend/ibusiness/getbranch';
    console.log(url2);
    function getBranch(company_id){
      if(company_id!=0){
        $.ajax({
          url:url2+"/"+company_id,
          type:'get',
          //headers:{'X-CSRF-TOKEN': "{{csrf_token()}}"},
          dataType:"json",
          data:{},
          success:function(result){
            $('#branch_office').empty();
            if(result.success){
              if(result.branchOffices.length>0){
                $('#branch_office').append('<option value="0">Select a branch offices</option>');
                for(var i=0;i<result.branchOffices.length;i++)
                  $('#branch_office').append('<option value="'+result.branchOffices[i].id+'">'+result.branchOffices[i].name+' - '+result.branchOffices[i].description+'</option>');
              }
            }else{
              console.log('Error: '+result.message);
            }
          },
          error:function(error){
            console.log(error);
          }
        });//ajax
      }//company_id!=0
    }//function generateSiteMap
    function getUserId(user_id){
      var b=0;
      for(var i=0;i<users.length;i++){
        if(users[i]==user_id){
          b=1;
          users.splice(i,1);
        }//if
      }//for
      if(b==0)
        users.push(user_id);
      $('#users').val(users);
      // if ( $.fn.DataTable.isDataTable('#tableUsers') ) {
      //   $('#tableUsers').DataTable().destroy();
      // }//datable
      // $('#tableUsers tbody').empty();
    }//getUserId(user_id)
    function validate(){
      //userbusiness id Form
      var company=$('#company').val();
      var b=0;
      if(company==0){
        alert('You must select a company');
        b++;
      }else if(users.length<=0){
        alert('You must select at least one user');
        b++;
      }
      if(b==0)
        document.getElementById("userbusiness").submit();
    }//validate()
    $( document ).ready(function() {
        console.log( "ready!" );
        $('#tableUsers').dataTable();
    });
    </script>
@endpush
