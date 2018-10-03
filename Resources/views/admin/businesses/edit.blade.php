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
@include('ibusiness::admin.businesses.partials.modal-address')
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
        <div class="box-footer text-center">
          <button type="submit" class="btn btn-primary pull-left btn-flat">{{ trans('core::core.button.update') }}</button>
          @if($business->parent_id==0)<a class="btn btn-info btn-flat" href="{{ route('admin.ibusiness.business.create.branchoffice', ['business_id'=>$business->id])}}"><i class="fa fa-pencil"></i> {{trans('ibusiness::businesses.title.add branch office')}}</a>@endif
          <a class="btn btn-info btn-flat" data-toggle="modal" data-target="#addressModal" ><i class="fa fa-pencil"></i> {{trans('ibusiness::businesses.title.show add new address')}}</a>
          <a class="btn btn-danger pull-right btn-flat" href="{{ route('admin.ibusiness.business.index')}}"><i class="fa fa-times"></i> {{ trans('core::core.button.cancel') }}</a>
        </div>
        @if($business->parent_id==0)
        <div class="box-body">
          <h1>{{trans('ibusiness::businesses.title.list of branch offices')}}</h1>
          <div class="table-responsive">
              <table class="data-table table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>{{trans('ibusiness::businesses.title.name')}}</th>
                    <th>{{trans('ibusiness::businesses.title.description')}}</th>
                    <th>{{trans('ibusiness::businesses.title.limit_budget')}}</th>
                      <th>{{ trans('core::core.table.created at') }}</th>
                      <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php if (isset($branchoffices)): ?>
                  <?php foreach ($branchoffices as $branchoffice): ?>
                  <tr>
                    <td>{{$branchoffice->name}}</td>
                    <td>{{$branchoffice->description}}</td>
                    <td>{{$branchoffice->budget}}</td>
                      <td>
                          <a href="{{ route('admin.ibusiness.business.edit', [$branchoffice->id]) }}">
                              {{ $branchoffice->created_at }}
                          </a>
                      </td>
                      <td>
                          <div class="btn-group">
                              <a href="{{ route('admin.ibusiness.business.edit', [$branchoffice->id]) }}" class="btn btn-default btn-flat" title="{{trans('ibusiness::businesses.table.index.business')}}"><i class="fa fa-pencil"></i></a>
                              <a href="{{ route('admin.ibusiness.userbusiness.edit', [$branchoffice->id]) }}" class="btn btn-default btn-flat btn-success" title="{{trans('ibusiness::businesses.table.index.users')}}"><i class="fa fa-users fa-inverse"></i></a>
                              <a href="{{ route('admin.ibusiness.businessproduct.edit', [$branchoffice->id]) }}" class="btn btn-default btn-flat btn-warning" title="{{trans('ibusiness::businesses.table.index.products')}}"><i class="fa fa-object-group fa-inverse"></i></a>
                              <button type="button" class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.ibusiness.business.destroy', [$branchoffice->id]) }}"><i class="fa fa-trash"></i></button>
                          </div>
                      </td>
                  </tr>
                  <?php endforeach; ?>
                  <?php endif; ?>
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>{{trans('ibusiness::businesses.title.name')}}</th>
                    <th>{{trans('ibusiness::businesses.title.description')}}</th>
                    <th>{{trans('ibusiness::businesses.title.limit_budget')}}</th>
                      <th>{{ trans('core::core.table.created at') }}</th>
                      <th>{{ trans('core::core.table.actions') }}</th>
                  </tr>
                  </tfoot>
              </table>
              <!-- /.box-body -->
          </div>
        </div>
        @endif
      </div>
    </div> {{-- end nav-tabs-custom --}}
  </div>
</div>
{!! Form::close() !!}
@include('core::partials.delete-modal')
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
$('#postcode').mask('0000000000');
var update_address_id=0;
var position=0;
function checkBilling(){
  var checkbox=$('#addressBilling').prop('checked');
  if(checkbox==true){
    $('#newAddress').hide();
  }//true
  else {
    $('#newAddress').show();
  }
}//test
function limpiar(){
  $('#firstname').val("");
  $('#lastname').val("");
  $('#address_1').val("");
  $('#address_2').val("");
  $('#type').val("");
  $('#postcode').val("");
  $("#country option[value='0']").prop('selected', true);
  $('#zone').empty();
  $('#city').val("");
  $('#btnCancel').hide();
  $("#addressBilling").prop("checked",false);
  update_address_id=0;//address_id to update
  position=0;//address updated position in array
};

function cancelUpdateAddress(){
  $("#buttonAddress").attr("onclick","addAddress2()");
  $('#buttonAddress').html("{{trans('ibusiness::businesses.button.add address')}}");
  limpiar();
}

function makeTableAddresses(){
  $('#addresses tbody').empty();
  var html="";
  var n=1;
  for(var i=0;i<address.length;i++){
    html+="<tr>";
    html+="<td>"+n+"</td>";
    html+="<td>"+address[i]['firstname']+" "+address[i]['lastname']+"</td>";
    html+="<td>"+address[i]['address_1']+" "+address[i]['city']+"</td>";
    if(address[i]['type']!=null)
      html+="<td><span class='badge badge-primary'>"+address[i]['type']+"</span></td>";
    else
      html+="<td></td>";
    html+='<td><button type="button" name="button" class="btn btn-info btn-sm" onclick="updateAddress('+address[i]['id']+')"> <i class="fa fa-pencil-square-o"></i> </button><button type="button" name="button" class="btn btn-info btn-sm" onclick="deleteAddress('+address[i]['id']+')"> <i class="fa fa-trash"></i> </button></td>';
    html+="</tr>";
    n++;
  }//for address
  $('#addresses tbody').html(html);
}
function updateAddress(address_id){
  $("#buttonAddress").attr("onclick","updateDataAddress()");
  $('#buttonAddress').html("{{trans('ibusiness::businesses.button.update address')}}");
  $('#btnCancel').show();
  update_address_id=address_id;
  for(var i=0;i<address.length;i++){
    if(address[i]['id']==update_address_id){
      position=i;
      break;
    }//if
  }//for address
  $('#firstname').val(address[i]['firstname']);
  $('#lastname').val(address[i]['lastname']);
  $('#address_1').val(address[i]['address_1']);
  $('#address_2').val(address[i]['address_2']);
  $('#type').val(address[i]['type']);
  $('#postcode').val(address[i]['postcode']);
  $('#country').val(address[i]['country']);
  var zone_value=address[i]['zone'];
  $.ajax({
    url:"{{url('/')}}"+'/api/ilocations/allprovincesbycountry/iso2/' + address[i]['country'],
    type:'GET',
    headers:{'X-CSRF-TOKEN': "{{csrf_token()}}"},
    dataType:"json",
    data:{},
    success:function(result){
      $('#zone').empty();
      if(result.length>0){
        //load select of city
        for(var i=0;i<result.length;i++){
          if(zone_value==result[i]['iso_2'])
          $('#zone').append('<option value="'+result[i]['iso_2']+'" selected>'+result[i]['name']+'</option>');
          else
          $('#zone').append('<option value="'+result[i]['iso_2']+'">'+result[i]['name']+'</option>');
        }//for()
      }//result.length>0
    },
    error:function(error){
      console.log(error);
    }
  });//ajax
  $('#city').val(address[i]['city']);
}//updateAddress
function updateDataAddress(){
  // console.log(update_address_id);
  firstname=$('#firstname').val();
  lastname=$('#lastname').val();
  address_1=$('#address_1').val();
  address_2=$('#address_2').val();
  type=$('#type').val();
  postcode=$('#postcode').val();
  country=$('#country').val();
  zone=$('#zone').val();
  city=$('#city').val();
  var shipping=0;
  var billing=0;
  var b=0;
  if(firstname=="" && firstname.length<4){
    alert("{{trans('ibusiness::businesses.validation.firstname_min')}}");
  }else if(lastname=="" || lastname.length<4){
    alert("{{trans('ibusiness::businesses.validation.lastname_min')}}");
  }else if(address_1=="" || address_1.length<4){
    alert("{{trans('ibusiness::businesses.validation.address_1_min')}}");
  }else if(postcode=="" || postcode.length>10){
    alert("{{trans('ibusiness::businesses.validation.postcode_min')}}");
  }else if(country=="" || country==null || country==0){
    alert("{{trans('ibusiness::businesses.validation.country_required')}}");
  }else if(zone=="" || zone==null){
    alert("{{trans('ibusiness::businesses.validation.zone_required')}}");
  }else if(city=="" || city.length<3){
    alert("{{trans('ibusiness::businesses.validation.city_required')}}");
  }else{
    for(var i=0;i<address.length;i++){
      if(address[i]['type']=="shipping" && address[i]['id']!=update_address_id)
      shipping++;
      else if(address[i]['type']=="billing" && address[i]['id']!=update_address_id)
      billing++;
    }//for
    if(type=="")
    b=1;
    else if(type=="shipping" && shipping==0)
    b=1;
    else if(type=="billing" && billing==0)
    b=1;
    else{
      if(type=="billing")
      alert("{{trans('ibusiness::businesses.validation.already_billing_address')}}");
      else
      alert("{{trans('ibusiness::businesses.validation.already_shipping_address')}}");
    }//else
    if(b==1){
      //send address and update
      $.ajax({
        url:"{{url('/')}}"+'/backend/ibusiness/businesses/updateaddress',
        type:'POST',
        headers:{'X-CSRF-TOKEN': "{{csrf_token()}}"},
        dataType:"json",
        data:{address_id:update_address_id,firstname:firstname,lastname:lastname,address_1:address_1,address_2:address_2,postcode:postcode,country:country,zone:zone,city:city,type:type},
        success:function(result){
          if(result.success){
            alert(result.message);
            address[position]['firstname']=firstname;
            address[position]['lastname']=lastname;
            address[position]['address_1']=address_1;
            address[position]['address_2']=address_2;
            address[position]['postcode']=postcode;
            address[position]['type']=type;
            address[position]['country']=country;
            address[position]['city']=city;
            address[position]['zone']=zone;
            $("#buttonAddress").attr("onclick","addAddress2()");
            $('#buttonAddress').html("{{trans('ibusiness::businesses.button.add address')}}");
            limpiar();
            makeTableAddresses();
          }//result.success
        },
        error:function(error){
          console.log(error);
        }
      });//ajax
    }//b==1
  }//else
}//updateDataAddress()
function deleteAddress(address_id){
  var r = confirm("{{trans('ibusiness::businesses.validation.confirm_delete_address')}}");
  if(r==true){
    $.ajax({
      url:"{{url('/')}}"+'/backend/ibusiness/businesses/deleteaddress',
      type:'POST',
      headers:{'X-CSRF-TOKEN': "{{csrf_token()}}"},
      dataType:"json",
      data:{address_id:address_id,business_id:business_id},
      success:function(result){
        if(result.success){
          alert(result.message);
          for(var i=0;i<address.length;i++){
            if(address[i]['id']==address_id){
              address.splice(i,1);
              break;
            }
          }//for address
          limpiar();
          makeTableAddresses();
        }//result.success
        else
          alert(result.message);
      },
      error:function(error){
        console.log(error);
      }
    });//ajax
  }//confirm
  // console.log('Address to delete'+address_id);
}//deleteAddress
var business_id="{{$business->id}}";
function addAddress2(){
  var checkbox=$('#addressBilling').prop('checked');
  if(checkbox==true){
    //disable address billing if exist and set new address of type billing
    $.ajax({
      url:"{{url('/')}}"+'/backend/ibusiness/businesses/setaddress',
      type:'POST',
      headers:{'X-CSRF-TOKEN': "{{csrf_token()}}"},
      dataType:"json",
      data:{business_id:business_id},
      success:function(result){
        if(result.success){
          alert(result.message);
          id=result.newAddress.id;
          firstname=result.newAddress.firstname;
          lastname=result.newAddress.lastname;
          address_1=result.newAddress.address_1;
          address_2=result.newAddress.address_2;
          city=result.newAddress.city;
          postcode=result.newAddress.postcode;
          country=result.newAddress.country;
          zone=result.newAddress.zone;
          type=result.newAddress.type;
          data={
            id,firstname,lastname,address_1,address_2,city,postcode,country,zone,type
          }//data
          address.push(data);
          makeTableAddresses();
        }//result.success
        else if(result.success==0){
          alert(result.message);
        }
        limpiar();
        $('#newAddress').show();
      },
      error:function(error){
        console.log(error);
      }
    });//ajax
  }//true
  else {
    firstname=$('#firstname').val();
    lastname=$('#lastname').val();
    address_1=$('#address_1').val();
    address_2=$('#address_2').val();
    type=$('#type').val();
    postcode=$('#postcode').val();
    country=$('#country').val();
    zone=$('#zone').val();
    city=$('#city').val();
    var id=0;
    var data;
    var shipping=0;
    var billing=0;
    var b=0;
    var html="";
    if(firstname=="" && firstname.length<4){
      alert("{{trans('ibusiness::businesses.validation.firstname_min')}}");
    }else if(lastname=="" || lastname.length<4){
      alert("{{trans('ibusiness::businesses.validation.lastname_min')}}");
    }else if(address_1=="" || address_1.length<4){
      alert("{{trans('ibusiness::businesses.validation.address_1_min')}}");
    }else if(postcode=="" || postcode.length>10){
      alert("{{trans('ibusiness::businesses.validation.postcode_min')}}");
    }else if(country=="" || country==null || country==0){
      alert("{{trans('ibusiness::businesses.validation.country_required')}}");
    }else if(zone=="" || zone==null){
      alert("{{trans('ibusiness::businesses.validation.zone_required')}}");
    }else if(city=="" || city.length<3){
      alert("{{trans('ibusiness::businesses.validation.city_required')}}");
    }else{
      for(var i=0;i<address.length;i++){
        if(address[i]['type']=="shipping")
        shipping++;
        else if(address[i]['type']=="billing")
        billing++;
      }//for
      if(type=="")
      b=1;
      else if(type=="shipping" && shipping==0)
      b=1;
      else if(type=="billing" && billing==0)
      b=1;
      else{
        if(type=="billing")
        alert("{{trans('ibusiness::businesses.validation.already_billing_address')}}");
        else
        alert("{{trans('ibusiness::businesses.validation.already_shipping_address')}}");
      }//else
      if(b==1){
        data={
          firstname,lastname,address_1,address_2,city,postcode,country,zone,type
        }//data
        $.ajax({
          url:"{{url('/')}}"+'/backend/ibusiness/businesses/createaddress',
          type:'POST',
          headers:{'X-CSRF-TOKEN': "{{csrf_token()}}"},
          dataType:"json",
          data:{address:data,business_id:business_id},
          success:function(result){
            if(result.success){
              alert(result.message);
              id=result.address_id;
              data={
                id,firstname,lastname,address_1,address_2,city,postcode,country,zone,type
              }//data
              address.push(data);
              limpiar();
              makeTableAddresses();
            }//result.success
          },
          error:function(error){
            console.log(error);
          }
        });//ajax
      }//b==1
    }//else validate inputs
  }//else new address
}//addAddress()
$( document ).ready(function() {
  $('#nit').mask('000000000-A');
  $('#phone').mask('000 0000000');
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
      $('#zone').empty();
      if(result.length>0){
        //load select of city
        for(var i=0;i<result.length;i++){
          if("{{$business->city}}"==result[i]['iso_2'])
          $('#zone').append('<option value="'+result[i]['iso_2']+'" selected>'+result[i]['name']+'</option>');
          else
          $('#zone').append('<option value="'+result[i]['iso_2']+'">'+result[i]['name']+'</option>');
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
