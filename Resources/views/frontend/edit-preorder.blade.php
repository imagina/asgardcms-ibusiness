@extends('layouts.master')
@section('title')
{{trans('ibusiness::frontend.title.create preorder')}} | @parent
@stop
@section('content')
<div class="ibusiness-breadcrumb container">
  <div class="row">
    <div class="col">
      <nav aria-label="breadcrumb">
        <ol class="breadcrumb mt-4 text-uppercase">
          <li class="breadcrumb-item"><a href="{{ URL::to('/') }}">{{trans('icommerce::common.home.title')}}</a></li>
          <li class="breadcrumb-item"><a href="{{ route(locale().'.ibusiness')}}">{{trans('ibusiness::frontend.title.preorder')}}</a></li>
          <li class="breadcrumb-item active" aria-current="page">{{trans('ibusiness::frontend.title.create preorder')}}</li>
        </ol>
      </nav>
    </div>
  </div>
  <h2 class="text-center mt-0 mb-5">{{trans('ibusiness::frontend.title.create preorder')}}</h2>
</div>
<div class="ibusiness-body container mb-5" id="preorder">
  <div class="row">
    <div class="col-12 col-sm-6">
      <div class="card">
        <div class="card-header bg-secondary text-white">
          <i style="margin-right: 5px;" class="fa fa-building" aria-hidden="true"></i>
          {{ trans('ibusiness::businesses.title.businesses') }}
        </div>
        <div class="card-body text-center">
          <h4>@{{business.name}}</h4>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-6">
      <div class="card">
        <div class="card-header bg-secondary text-white">
          {{trans('ibusiness::frontend.title.payment_methods')}}
        </div>
        <div class="card-body">
          @{{payment_method}}
          <!-- <div v-for="payment in payment_methods">
            <input type="radio" name="payment_method" v-model="payment_method" v-bind:value="payment.configName" > @{{payment.configTitle}}
          </div> -->
        </div>
      </div>
    </div>
  </div> <!--row-->
  <br>
  <div class="row">
    <div class="col-12 col-sm-6" v-show="business_id!=0" >
      <div class="card">
        <div class="card-header bg-secondary text-white">
          <i style="margin-right: 5px;" class="fa fa-shopping-car" aria-hidden="true"></i>
          {{ trans('ibusiness::businessproducts.title.businessproducts') }}
        </div>
        <div class="card-body">
          <div class="col text-center" v-if="businessproducts.length>0">
            <h3>{{trans('icommerce::products.plural')}}</h3>
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>{{trans('icommerce::products.table.image')}}</th>
                    <th>{{trans('icommerce::products.table.title')}}</th>
                    <th>{{trans('icommerce::products.table.principal category')}}</th>
                    <th>{{trans('icommerce::products.table.price')}}</th>
                    <th>{{ trans('core::core.table.actions') }}</th>
                  </tr>
                </thead>
                <tbody>
                  <tr v-for="product in businessproducts">
                    <td>
                      <a v-if="product.product.options.mainimage != null" v-bind:href="product.product.slug" class="cart-img float-left">
                        <img v-if="product.product.options.mainimage != null" class="img-fluid" v-bind:src="'{{url('/')}}/'+product.product.options.mainimage"
                             v-bind:alt="product.product.title.es">
                        <img v-else class="img-fluid"
                             src="{{url('modules/icommerce/img/product/default.jpg')}}"
                             v-bind:alt="product.product.title.es">
                      </a>
                    </td>
                    <td>@{{product.product.title.es}}</td>
                    <td>@{{product.product.category.title.es}}</td>
                    <td>@{{product.price}}</td>
                    <td>
                      <button type="button" @click="addPreOrderProduct({id:product.product.id,name:product.product.title.es,price_unit:product.price,quantity:1,maxquantity:product.product.quantity})" class="btn btn-success btn-small" name="button">
                        <!-- {{trans('ibusiness::frontend.buttons.add_to_order')}} -->
                        <i class="fa fa-plus"></i>
                      </button>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div v-else class="text-center">
            <h5>{{trans('ibusiness::frontend.validation.business_no_products')}}</h5>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-6" v-show="businessproductsOrder.length>0">
      <div class="card">
        <div class="card-header bg-secondary text-white">
          <i style="margin-right: 5px;" class="fa fa-pencil-square-o" aria-hidden="true"></i>
          {{ trans('ibusiness::businessproducts.title.orderproducts') }}
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table class="table table-bordered table-hover">
              <thead>
                <tr>
                  <th>{{trans('icommerce::products.table.title')}}</th>
                  <th>{{trans('icommerce::products.table.price')}}</th>
                  <th>{{trans('icommerce::products.table.quantity')}}</th>
                  <th>{{trans('ibusiness::frontend.table.total')}}</th>
                  <th>{{ trans('core::core.table.actions') }}</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="(product,index) in businessproductsOrder">
                  <td>
                    @{{product.name}}
                  </td>
                  <td>
                    @{{currencySymbolLeft}} @{{product.price_unit}}
                  </td>
                  <td >
                    <div class="input-group">
                      <div class="input-group-prepend">
                        <div class="waves-input-wrapper waves-effect waves-light">
                          <input type="button" @click="product.quantity--" class="btn btn-outline-primary border-right-0 quantity-down" field="quantity" value="-">
                        </div>
                      </div>
                      <input type="text" onkeypress="return isNumberKey(event)" v-model="product.quantity" style="text-align:center;" @keyup="validationOrderProduct(index)" v-bind:max="product.maxquantity" class="form-control quantity border-primary" name="" value="">
                      <div class="input-group-append">
                        <div class="waves-input-wrapper waves-effect waves-light">
                          <input type="button" value="+" @click="product.quantity++" class="btn btn-outline-primary border-left-0 quantity-up" field="quantity">
                        </div>
                      </div>
                    </div>
                  </td>
                  <td>@{{currencySymbolLeft}} @{{product.price_unit*product.quantity}}</td>
                  <td>
                    <button type="button" class="btn btn-danger btn-sm" @click="deleteProductOrder(index)" name="button"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>
              </tbody>
            </table>
            <hr>
            <div class="row">
              <div class="col-7">
                <h5 class="font-weight-bold">{{trans('ibusiness::frontend.form.total_preorder')}}</h5>
              </div>
              <div class="col-5">
                @{{currencySymbolLeft}} @{{totalPrice}}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <br>
  <div class="row" v-show="businessproductsOrder.length>0">
    <div class="mx-auto">
      <button type="button" class="btn btn-primary text-uppercase" name="button" @click="sendPreOrder()">  {{trans('ibusiness::frontend.buttons.update_preorder')}}</button>
    </div>
  </div>

</div>

@stop

@section('scripts')
@parent

{!!Theme::script('js/app.js?v='.config('app.version'))!!}

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.4.5/js/mdb.min.js"></script>

<script type="text/javascript">
function isNumberKey(evt)
{
  var charCode = (evt.which) ? evt.which : event.keyCode
  if (charCode > 31 && (charCode < 48 || charCode > 57))
  return false;

  return true;
}
const app=new Vue({
  el:'#preorder',
  data:{
    business: {!! $business ? $business : "''"!!},
    payment_methods: {!! $payments ? $payments : "''"!!},
    // payment_method: '',
    payment_method: {!! $payment_method ? $payment_method : "''"!!},
    order_id: {!! $orderID ? $orderID : "''"!!},
    business_id:0,
    // businessproducts:[],//products of business
    businessproducts: {!! $businessproduct ? $businessproduct : "''"!!},
    // businessproductsOrder:[],
    businessproductsOrder: {!! $productsOrder ? $productsOrder : "''"!!},
    locales: {!! json_encode(LaravelLocalization::getSupportedLocales()) !!},
    currentLocale: '{{locale()}}',
    currencySymbolLeft:"{{$currency->symbol_left}}",
    currencySymbolRight:"{{$currency->symbol_right}}",
    business_billing:{
      city:'',
      address_1:''
    },
    business_shipping:{
      city:'',
      address_1:''
    },
    // business_limit_budget:0,
    business_limit_budget: {!! $limit_budget ? $limit_budget : "''"!!},
    total:0
  },
  computed:{
    totalPrice(){
      var totalP=0;
      for(var i=0;i<this.businessproductsOrder.length;i++){
        if(parseInt(this.businessproductsOrder[i].quantity)>parseInt(this.businessproductsOrder[i].maxquantity)){
          this.businessproductsOrder[i].quantity=this.businessproductsOrder[i].maxquantity;
        }else if(parseInt(this.businessproductsOrder[i].quantity)<=0){
          this.businessproductsOrder[i].quantity=1;
        }
        totalP+=this.businessproductsOrder[i].price_unit*this.businessproductsOrder[i].quantity;
      }//for
      this.total=totalP;
      this.validateLimitBudget();
      return totalP;
    }//totalPrice()
  },
  methods:{
    getBusinessProducts(){
      axios.post('{{ url("api/ibusiness/products/") }}', {business_id:this.business_id}).then(response => {
        this.businessproducts=response.data.businessproduct;
        this.businessproductsOrder=[];//Clear productsOrder
      }).catch(error => {
        console.log(error);//Error
      });
      for(var i=0;i<this.business.length;i++){
        if(this.business[i].business_id==this.business_id){
          for(var l=0;l<this.business[i].business.addresses.length;l++){
            if(this.business[i].business.addresses[l].type=="shipping"){
              this.business_shipping.address_1=this.business[i].business.addresses[l].address_1;
              this.business_shipping.city=this.business[i].business.addresses[l].city;
            }else if(this.business[i].business.addresses[l].type=="billing"){
              this.business_billing.address_1=this.business[i].business.addresses[l].address_1;
              this.business_billing.city=this.business[i].business.addresses[l].city;
            }
          }//for
          this.business_limit_budget=this.business[i].business.budget;
        }//if
      }//for
    },//getBusinessProducts()
    addPreOrderProduct(product){
      var b=0;
      for(var i=0;i<this.businessproductsOrder.length;i++){
        if(this.businessproductsOrder[i].id==product.id){
          this.alerta("{{trans('ibusiness::frontend.validation.product_already_order_list')}}",'error');
          b=1;
          break;
        }
      }//for
      if(this.total>this.business_limit_budget){

      }
      if(b==0){
        this.businessproductsOrder.push(product);
      }
    },//addPreOrderProduct()
    sendPreOrder(){
      if(this.payment_method==""){
        this.alerta("{{trans('ibusiness::frontend.validation.payment_method_required')}}",'error');
      }else if(this.businessproductsOrder.length>0 && this.business_id!=0){
        axios.post('{{ url("business/preorder/update") }}', {order_id:this.order_id,business_id:this.business_id,businessproducts:this.businessproductsOrder,payment_method:this.payment_method}).then(response => {
          if(response.data){
            this.alerta("{{trans('ibusiness::frontend.messages.update preorder success')}}",'success');
          }//response.data
        }).catch(error => {
          console.log(error);//Error
        });
      }//
    },
    deleteProductOrder(index){
      this.businessproductsOrder.splice(index,1);
    },
    validationOrderProduct(index){
      if(parseInt(this.businessproductsOrder[index].quantity)>parseInt(this.businessproductsOrder[index].maxquantity)){
        this.businessproductsOrder[index].quantity=this.businessproductsOrder[index].maxquantity;
      }else if(parseInt(this.businessproductsOrder[index].quantity)<=0){
        this.businessproductsOrder[index].quantity=1;
      }
    },
    validateLimitBudget(){
      var totalP=0;
      for(var i=0;i<this.businessproductsOrder.length;i++){
        if(parseInt(this.businessproductsOrder[i].quantity)>parseInt(this.businessproductsOrder[i].maxquantity)){
          this.businessproductsOrder[i].quantity=this.businessproductsOrder[i].maxquantity;
        }else if(parseInt(this.businessproductsOrder[i].quantity)<=0){
          this.businessproductsOrder[i].quantity=1;
        }
        totalP+=this.businessproductsOrder[i].price_unit*this.businessproductsOrder[i].quantity;
      }//for
      if(parseFloat(totalP)>parseFloat(this.business_limit_budget)){
        this.businessproductsOrder.splice(this.businessproductsOrder.length-1,1);
        if(this.businessproductsOrder.length>0){
          var totalP=0;
          for(var i=0;i<this.businessproductsOrder.length;i++){
            if(parseInt(this.businessproductsOrder[i].quantity)>parseInt(this.businessproductsOrder[i].maxquantity)){
              this.businessproductsOrder[i].quantity=this.businessproductsOrder[i].maxquantity;
            }else if(parseInt(this.businessproductsOrder[i].quantity)<=0){
              this.businessproductsOrder[i].quantity=1;
            }
            totalP+=this.businessproductsOrder[i].price_unit*this.businessproductsOrder[i].quantity;
          }//for
          this.total=totalP;
        }
        this.alerta("{{trans('ibusiness::frontend.validation.orders_product_exceed_limit')}}",'error');
      }
    },
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
  },//methods
  mounted(){
    this.business_id=this.business.id;
  }
});

</script>
@stop
