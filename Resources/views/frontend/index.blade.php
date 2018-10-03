@extends('layouts.master')

@section('title')
{{trans('ibusiness::frontend.title.preorder')}} | @parent
@stop


@section('content')


<div class="ibusiness-breadcrumb container">

  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-4 text-uppercase">
          <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">{{trans('icommerce::common.home.title')}}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{trans('ibusiness::frontend.title.preorder')}}</li>
        </ol>
      </nav>
    </div>
  </div>

  <h2 class="text-center mt-0 mb-5">{{trans('ibusiness::frontend.title.preorder')}}</h2>

</div>

<div class="ibusiness-body container mb-5">
  <!-- preloader -->
  <div id="content_preloader">
    <div id="preloader"></div>

    <div class="d-flex justify-content-center">
      <i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>
      <span class="sr-only">Loading...</span>
    </div>

  </div>

  <div id="index_ibusiness" style="opacity: 0">
    @if(Auth::user()->hasAccess(['ibusiness.orders.permissions.create']))
    <div class="row">
      <div class="col">
        <a class="btn btn-primary text-uppercase" href="{{route(locale().'.ibusiness.preorder.create')}}">
          {{ trans('ibusiness::frontend.buttons.create preorder') }}
        </a>
      </div>
    </div>
    @endif
    @if(Auth::user()->roles()->first()->slug=='buyer' || Auth::user()->roles()->first()->slug=='approver')
    <div v-if="preordersTemp.length >= 1" >
      <div class="row">
        <div class="col-12 col-md-9 col-lg-9">
          <br>
          <div class="mt-2 form-inline font-weight-bold">
            {{trans('ibusiness::frontend.buttons.see')}}
            <select v-model="pageSize" class="form-control form-control-sm col-2 col-md-1 col-lg-1 ml-2 mr-2">
              <option v-for="option in optionspageSize" v-bind:value="option.value">
                @{{ option.text }}
              </option>
            </select>
            {{trans('ibusiness::frontend.buttons.rows')}}
          </div>
        </div>
        <div class="col-12 col-md-3 col-lg-3">
          <div class="form-group">
            <label for="Search" class="font-weight-bold">{{trans('ibusiness::frontend.buttons.search')}}:</label>
            <input id="search" class="form-control form-control-sm" type="text" v-model="search" v-on:keyup="filterOrders" required>
          </div>
        </div>
      </div>
      <table class="table table-bordered table-sm table-striped table-hover mt-4">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">{{trans('ibusiness::frontend.table.firstname')}}</th>
            <th scope="col">{{trans('ibusiness::businesses.single')}}</th>
            <th scope="col">{{trans('ibusiness::businesses.title.email')}}</th>
            <th scope="col">{{trans('ibusiness::frontend.table.total')}}</th>
            <th scope="col">{{trans('ibusiness::frontend.table.status')}}</th>
            <th scope="col">{{trans('core::core.table.created at')}}</th>
            <th>{{ trans('core::core.table.actions') }}</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="item in orders_registred">
            <th scope="row">@{{item.id}}</th>
            <td> @{{item.first_name}}</td>
            <td> @{{item.payment_company}}</td>
            <td> @{{item.email}}</td>
            <td> @{{item.total}}</td>
            <td> @{{item.status_name}}</td>
            <td> @{{item.created_at}}</td>
            <td>
              <a v-bind:href="item.url" title="{{trans('ibusiness::frontend.buttons.see')}}" class="btn btn-sm btn-danger btn-flat text-white"  >
                <i class="fa fa-eye" aria-hidden="true"></i>
              </a>
              <a v-if="item.status == 0" title="{{trans('ibusiness::frontend.buttons.pay')}}" class="btn btn-sm btn-success btn-flat mx-1" >
                <i class="fa fa-money" aria-hidden="true"></i>
              </a>
              @if(Auth::user()->hasAccess(['ibusiness.orders.permissions.edit']))
              <a v-bind:href="'{{url('/business/preorder/edit')}}/'+item.id" title="{{trans('ibusiness::frontend.buttons.edit')}}" class="btn btn-sm btn-info btn-flat mx-1">
                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
              </a>
              @endif
            </td>
          </tr>
        </tbody>
      </table>
      <div class="">
        <strong class="pt-5" v-show='statusFilter'>{{trans('ibusiness::frontend.buttons.showing')}}: @{{rows}} {{trans('ibusiness::frontend.buttons.records of')}} @{{preorders.length}}</strong>
        <strong class="pt-5" v-show='!statusFilter'>{{trans('ibusiness::frontend.buttons.showing')}}: 0 {{trans('ibusiness::frontend.buttons.records of')}} 0 </strong>
        <div style="float:right">
          <button class="btn bg-primary text-white font-weight-bold" v-on:click="prevPage" data-toggle="tooltip" title="Anterior"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>
          <button class="btn bg-primary text-white font-weight-bold" v-on:click="nextPage"data-toggle="tooltip" title="Siguiente"><i class="fa fa-arrow-right" aria-hidden="true"></i></button>
          <div class="row ml-2">
            <strong>{{trans('ibusiness::frontend.buttons.page')}}:  @{{currentPage}}</strong>
          </div>
        </div>
      </div>
    </div>

    <div class="col" v-else>
      <br>
      <div class="alert alert-danger" role="alert">
        No Results  <i class="fa fa-frown-o"></i>
      </div>
    </div>
    @endif
  </div>

</div>

@stop

@section('scripts')
@parent

{!!Theme::script('js/app.js?v='.config('app.version'))!!}

<script type="text/javascript">

const vue_index_ibusiness = new Vue({

  el: '#index_ibusiness',
  data: {
    preloaded: true,
    preloader: true,
    preorders: [],
    preordersTemp:[],
    path: '{{ route('ibusiness.api.preorders') }}',
    user: {!! !empty($user)? $user :0 !!},
    search:'',
    currentSort:'payment_company',//field default
    currentSortDir:'asc',//order asc
    pageSize:'5',//Rows for page
    optionspageSize: [
      { text: '5', value: 5 },
      { text: '10', value: 10 },
      { text: '25', value: 25 },
      { text: '50', value: 50 },
      { text: '100', value: 100 }
    ],//Rows per page
    currentPage:1,//Page 1
    statusFilter:1,
    rows:0
  },
  computed:{
    orders_registred:function() {
      this.rows=0;
      return this.preorders.sort((a,b) => {
        let modifier = 1;
        if(this.currentSortDir === 'desc')
        modifier = -1;
        if(a[this.currentSort] < b[this.currentSort])
        return -1 * modifier;
        if(a[this.currentSort] > b[this.currentSort])
        return 1 * modifier;
        return 0;
      }).filter((row, index) => {
        let start = (this.currentPage-1)*this.pageSize;
        let end = this.currentPage*this.pageSize;
        if(index >= start && index < end){
          this.rows+=1;
          return true;
        }
      });
    },
  },
  methods:{
    filterOrders:function(){
      let filtrardo=[];
      if(this.search){
        for(let i in this.preorders){
          if(this.preorders[i].payment_company.toString().toLowerCase().trim().search(this.search.toLowerCase())!=-1){
            this.statusFilter=1;
            filtrardo.push(this.preorders[i]);
          }//if
        }//for
        if(filtrardo.length>0)
        this.preorders=filtrardo;
        else{
          this.statusFilter=0;
          // this.preorders=filtrardo;//Empty
          this.preorders=this.preordersTemp;
        }// if(filtrardo.length)
      }else{
        this.statusFilter=1;
        this.preorders=this.preordersTemp;
      }//if(this.search)
    },// filtrar:function()
    nextPage:function() {
      if((this.currentPage*this.pageSize) < this.preorders.length) this.currentPage++;
    },
    prevPage:function() {
      if(this.currentPage > 1) this.currentPage--;
    },
    get_preorders: function (path) {
      !path ? path = this.path : false;
      axios({
        method: 'Get',
        responseType: 'json',
        url: path,
        params: {
          user: this.user
        }
      }).then(function (response) {
        vue_index_ibusiness.order_response(response);
      });
    },

    /*ordena los datos luego de consultar las preordenes*/
    order_response: function (response) {
      this.preorders = response.data.preorders;
      this.preordersTemp = response.data.preorders;

    }//order_response

  },
  mounted: function () {
    this.$nextTick(function () {
      this.get_preorders(this.path);
      this.preloaded = false;
      setTimeout(function () {
        $('#content_preloader').fadeOut(1000, function () {
          $('#index_ibusiness').animate({'opacity': 1}, 500);
        });
      }, 1800);
    });
  }
});


</script>
@stop
