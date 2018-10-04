@extends('layouts.master')

@section('title')
{{trans('ibusiness::frontend.title.preorder')}} | @parent
@stop


@section('content')

@php
$currency=localesymbol($code??'USD')
@endphp

<div class="ibusiness-breadcrumb container">

  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-4 text-uppercase">
          <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">{{trans('icommerce::common.home.title')}}</a></li>
          <li class="breadcrumb-item"><a href="{{ route(locale().'.ibusiness')}}">{{trans('ibusiness::frontend.title.preorder')}}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{trans('ibusiness::frontend.single')}}</li>
        </ol>
      </nav>
    </div>
  </div>

  <h2 class="text-center mt-0 mb-5">{{trans('ibusiness::frontend.single')}}</h2>

</div>

<div class="ibusiness-body ibusiness-show container mb-5">

  <!-- preloader -->
  <div id="content_preloader">
    <div id="preloader"></div>

    <div class="d-flex justify-content-center">
      <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>
      <span class="sr-only">Loading...</span>
    </div>

  </div>

  <div id="show_ibusiness" style="opacity: 0">

    <div id="orderDetails" class="pb-5">
      <div class="container" >

        <div class="row">

          <div class="col-12 col-sm-4">

            <div class="card">

              <div class="card-header bg-secondary text-white bg-secondary text-white">
                <i style="margin-right: 5px;" class="fa fa-shopping-cart" aria-hidden="true"></i>
                {{trans('icommerce::orders.table.details')}}
              </div>

              <ul class="list-group list-group-flush">
                <li class="list-group-item">@{{ preorder.created_at}}</li>
                <li class="list-group-item">@{{ preorder.payment_method }} </li>
              </ul>

            </div>

          </div>

          <div class="col-12 col-sm-4">

            <div class="card">

              <div class="card-header bg-secondary text-white">
                <i style="margin-right: 5px;" class="fa fa-user" aria-hidden="true"></i>
                {{trans('icommerce::orders.table.customer details')}}
              </div>

              <ul class="list-group list-group-flush">
                <li class="list-group-item">@{{preorder.first_name}} @{{preorder.last_name}}</li>
                <li class="list-group-item">@{{preorder.email}}</li>
                <li class="list-group-item" v-if="preorder.telephone">@{{preorder.telephone}}</li>
              </ul>

            </div>

          </div>

          <div class="col-12 col-sm-4">

            <div class="card ">

              <div class="card-header bg-secondary text-white">
                <i style="margin-right: 5px;" class="fa fa-plus-circle" aria-hidden="true"></i>
                {{trans('icommerce::orders.table.others details')}}
              </div>

              <ul class="list-group list-group-flush">
                <li class="list-group-item" v-if="preorder.invoice_nro">@{{preorder.invoice_nro}}</li>
                <li class="list-group-item">@{{preorder.status_name}}</li>
              </ul>

            </div>

          </div>

        </div>

        <hr class="my-4 hr-lg">

        <div class="row">

          <div id="orderC" class="col-12">
            <div class="card">

              <div class="card-header bg-secondary text-white">
                <i style="margin-right: 5px;" class="fa fa-book" aria-hidden="true"></i>
                {{trans('icommerce::orders.table.order')}}
                # @{{preorder.id}}
              </div>

              <div class="card-body">

                <div class="table-responsive">
                  <table class="table">

                    <th>{{trans('icommerce::orders.table.payment address')}}</th>
                    <th>{{trans('icommerce::orders.table.shipping address')}}</th>

                    <tr>
                      <td>
                        @{{preorder.payment_firstname}}<br>
                        @{{preorder.payment_lastname}}<br>
                        @{{preorder.payment_address_1}}<br>
                        @{{preorder.payment_address_2}}<br>
                        @{{preorder.payment_postcode}}<br>
                        @{{preorder.payment_city}}<br>
                        @{{preorder.payment_zone}}<br>
                        @{{preorder.payment_country}}
                      </td>

                      <td>
                        @{{preorder.shipping_firstname}}<br>
                        @{{preorder.shipping_lastname}}<br>
                        @{{preorder.shipping_address_1}}<br>
                        @{{preorder.shipping_address_2}}<br>
                        @{{preorder.shipping_postcode}}<br>
                        @{{preorder.shipping_city}}<br>
                        @{{preorder.shipping_zone}}<br>
                        @{{preorder.shipping_country}}
                      </td>

                    </tr>

                  </table>
                </div>

                <div class="table-responsive">
                  <table class="table ">
                    <th>{{trans('icommerce::orders.table.product')}}</th>
                    <th>{{trans('icommerce::orders.table.sku')}}</th>
                    <th>{{trans('icommerce::orders.table.quantity')}}</th>
                    <th>{{trans('icommerce::orders.table.unit price')}}</th>
                    <th class="text-right">{{trans('icommerce::orders.table.total')}}</th>

                    <tr class="product-order" v-for="product in preorder.products">
                      <td>@{{product.title}}<br></td>
                      <td>@{{product.sku}}</td>
                      <td>@{{product.quantity}}</td>
                      <td>{{$currency->symbol_left}} @{{product.priceFormat}} {{$currency->symbol_right}}</td>
                      <td class="text-right">{{$currency->symbol_left}} @{{product.totalFormat}} {{$currency->symbol_right}}</td>
                    </tr>

                    <tr class="subtotal">
                      <td colspan="4" class="text-right font-weight-bold">{{trans('icommerce::orders.table.subtotal')}}</td>
                      <td class="text-right">{{$currency->symbol_left}}  @{{preorder.subtotalFormat}} {{$currency->symbol_right}}</td>
                    </tr>

                    <tr class="shippingTotal">
                      <td colspan="4" class="text-right font-weight-bold">{{trans('icommerce::orders.table.shipping_method')}}</td>
                      <td class="text-right">
                        @{{ preorder.shipping_method }}
                        <div v-if="preorder.shipping_amount!=0">
                          {{$currency->symbol_left}}
                          @{{preorder.shipping_amountFormat}}
                          {{$currency->symbol_right}}
                        </div>
                      </td>
                    </tr>

                    <tr class="taxAmount" v-if="preorder.tax_amount>0">
                      <td colspan="4" class="text-right font-weight-bold">{{trans('icommerce::order_summary.tax')}}</td>
                      <td class="text-right">
                        {{$currency->symbol_left}}
                        @{{preorder.tax_amountFormat}}
                        {{$currency->symbol_right}}
                      </td>
                    </tr>

                    <tr class="total">
                      <td colspan="4" class="text-right font-weight-bold">{{trans('icommerce::orders.table.total')}}</td>
                      <td class="text-right">{{$currency->symbol_left}} @{{preorder.totalFormat}} {{$currency->symbol_right}}</td>
                    </tr>

                  </table>
                </div>


              </div>

            </div>
          </div>

        </div>

        <hr class="my-4 hr-lg">
        <div class="row">
          @if(Auth::user()->hasAccess(['ibusiness.orders.permissions.update']))
          @include('ibusiness::frontend.partials.approvers-check')
          @else
          @include('ibusiness::frontend.partials.approvers-infor')
          @endif
        </div>
        <div class="col-12 text-right mt-3 mt-md-0">
          <a href="{{ route(locale().'.ibusiness') }}"
          class="btn btn-outline-primary btn-rounded btn-lg my-2">{{trans('ibusiness::frontend.buttons.back')}}</a>
        </div>

      </div>
    </div>
  </div>
</div>
@stop
@section('scripts')
@parent
{!!Theme::script('js/app.js?v='.config('app.version'))!!}
<script type="text/javascript">

const vue_show_ibusiness = new Vue({

  el: '#show_ibusiness',
  data: {
    preloaded: true,
    preloader: true,
    preorder: '',
    path: '{{ route('ibusiness.api.preorder',[$orderID]) }}',
    user: {!! !empty($user)? $user :0 !!},
    approversCant: 0,
    approversStatus: [],
    statusSelected: '',
    approver: '',
    approver_comment:''
  },
  methods:{
    get_preorder: function (path) {
      !path ? path = this.path : false;
      axios({
        method: 'Get',
        responseType: 'json',
        url: path
      }).then(function (response) {

        vue_show_ibusiness.preorder = response.data;
        vue_show_ibusiness.approversCant = response.data.approversCant;

      });
    },
    get_approversStatus: function(){
      axios({
        method: 'get',
        responseType: 'json',
        url: '{{ route("ibusiness.api.orderapprovers.getStatus") }}'
      }).then(function (response) {
        vue_show_ibusiness.approversStatus = response.data;
      })
    },
    get_dataApprover: function(){
      axios({
        method: 'get',
        responseType: 'json',
        params: {
          user: this.user
        },
        url: '{{ route("ibusiness.api.orderapprovers.getDataApprover",[$orderID]) }}'
      }).then(function (response) {
        vue_show_ibusiness.approver = response.data;
        vue_show_ibusiness.statusSelected = response.data.status;
        vue_show_ibusiness.approver_comment=response.data.comment;
      })
    },
    update_status: function(){
      // var url = "{!! route('ibusiness.api.orderapprovers.update',['id' => '']) !!}"+"/"+this.approver.id;
      axios.put("{{route('ibusiness.api.orderapprovers.update')}}",{order_id:"{{$orderID}}",approver_id:this.user,status_id:this.statusSelected,comment:this.approver_comment}).then(response => {
        if(response.data){
          this.alerta("{{trans('ibusiness::orderapprovers.messages.order status approver success')}}",'success');
          var urlAf = "{{route(locale().'.ibusiness')}}";
          window.setTimeout(function(){
            window.location.replace(urlAf);
          }, 5000);
        }
      });
    },//update_status()
    alerta: function (menssage, type) {
      toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": 400,
        "hideDuration": 400,
        "timeOut": 4000,
        "extendedTimeOut": 1000,
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      };
      toastr[type](menssage);
    },
  },
  mounted: function () {
    this.$nextTick(function () {

      this.get_preorder(this.path);

      @if(Auth::user()->hasAccess(['ibusiness.orders.permissions.update']))
      this.get_approversStatus();
      this.get_dataApprover();
      @endif

      this.preloaded = false;
      setTimeout(function () {
        $('#content_preloader').fadeOut(1000, function () {
          $('#show_ibusiness').animate({'opacity': 1}, 500);
        });
      }, 1800);
    });
  }
});

</script>
@stop
