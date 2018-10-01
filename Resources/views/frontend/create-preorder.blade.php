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
        <div class="card-body">
          <select class="form-control" v-model="business_id" v-on:change="getBusinessProducts()" name="business_id">
            <option value="0">{{trans('ibusiness::businesses.form.select_business')}}</option>
            <option v-for="company in business" v-bind:value="company.business.id" >
              @{{company.business.name}}
            </option>
          </select>
          <div v-show="business_id!=0" class="text-center row">
            <hr>
            <div class="col-12">
              <br>
              <h4>{{trans('ibusiness::businesses.form.addresses')}}</h4>
            </div>
            <div class="col-6">
              <strong>{{trans('ibusiness::frontend.title.billing_address')}}:</strong>
              <br>
              @{{business_billing.address_1}} - @{{business_billing.city}}
            </div>
            <div class="col-6">
              <strong>{{trans('ibusiness::frontend.title.shipping_address')}}:</strong>
              <br>
              @{{business_shipping.address_1}} - @{{business_shipping.city}}
            </div>
            <div class="col-12">
              <br>
              <h4>{{trans('ibusiness::businesses.title.limit_budget')}}</h4>
            </div>
            <div class="col-12">
              @{{currencySymbolLeft}} @{{business_limit_budget}}
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-12 col-sm-6">
      <div class="card">
        <div class="card-header bg-secondary text-white">
          {{trans('ibusiness::frontend.title.payment_methods')}}
        </div>
        <div class="card-body">
          <div v-for="payment in payment_methods">
            <input type="radio" name="payment_method" v-model="payment_method" v-bind:value="payment.configName" > @{{payment.configTitle}}
          </div>
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
            <label class="mb-3"><strong>{{trans('ibusiness::frontend.title.select_category_see_products')}}:</strong></label>
            <select class="form-control" v-model="category_id">
              <option value="0">{{trans('ibusiness::frontend.title.see_all_products')}}</option>
              <option v-for="categories in productCategories" v-bind:value="categories.id">
                @{{categories.name}}
              </option>
            </select>
            <hr>
            <!-- <h4>{{trans('icommerce::products.plural')}}</h4> -->
            <div class="table-responsive">
              <table class="table table-bordered table-hover">
                <thead>
                  <tr>
                    <th>{{trans('icommerce::products.table.image')}}</th>
                    <th>{{trans('icommerce::products.table.title')}}</th>
                    <!-- <th @click="sort('product')">{{trans('icommerce::products.table.principal category')}}
                    <i v-if="currentSortDir=='asc'" class="fa fa-arrow-up"></i>
                    <i v-else class="fa fa-arrow-down"></i>
                  </th> -->
                  <th>{{trans('icommerce::products.table.price')}}</th>
                  <th>{{ trans('core::core.table.actions') }}</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="product in productsBusiness">
                  <td>
                    <a v-if="product.image != null" v-bind:href="product.slug" class="cart-img float-left">
                      <img v-if="product.image != null" class="img-fluid" v-bind:src="product.image"
                      v-bind:alt="product.title">
                      <img v-else class="img-fluid"
                      src="{{url('modules/icommerce/img/product/default.jpg')}}"
                      v-bind:alt="product.title">
                    </a>
                  </td>
                  <td class="align-middle">@{{product.title}}</td>
                  <!-- <td>@{{product.product.category.title.es}}</td> -->
                  <td class="align-middle">@{{product.price}}</td>
                  <td class="align-middle">
                    <button type="button" @click="addPreOrderProduct({id:product.product_id,name:product.title,price_unit:product.price,quantity:1,maxquantity:product.quantity})" class="btn btn-success btn-small" name="button">
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
    <button type="button" class="btn btn-primary text-uppercase" name="button" @click="sendPreOrder()">  {{trans('ibusiness::frontend.buttons.generate_preorder')}}</button>
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
    business: {!! $userbusiness ? $userbusiness : "''"!!},
    payment_methods: {!! $payments ? $payments : "''"!!},
    business_id:0,
    category_id:0,
    businessproducts:[],//products of business
    businessproductsFiltered:[],//products of business filtered by category
    productCategories:[],
    businessproductsOrder:[],
    locales: {!! json_encode(LaravelLocalization::getSupportedLocales()) !!},
    currentLocale: '{{locale()}}',
    currencySymbolLeft:"{{$currency->symbol_left}}",
    currencySymbolRight:"{{$currency->symbol_right}}",
    payment_method:'',
    business_billing:{
      city:'',
      address_1:''
    },
    business_shipping:{
      city:'',
      address_1:''
    },
    business_limit_budget:0,
    total:0,
    currentSort:'category_id',//field default
    currentSortDir:'asc'//order asc
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
    },//totalPrice()
    productsBusiness:function() {
      this.rows=0;
      this.businessproductsFiltered=[];
      for(var i=0;i<this.businessproducts.length;i++){
        if(this.category_id==0){
          this.businessproductsFiltered.push(this.businessproducts[i]);//push products filtered by category
        }else{
          if(this.businessproducts[i].category_id==this.category_id){
            this.businessproductsFiltered.push(this.businessproducts[i]);//push products filtered by category
          }//if this.category_id == this.businessproducts[i].product.category_id
        }
      }//for
      return this.businessproductsFiltered.sort((a,b) => {
        let modifier = 1;
        if(this.currentSortDir === 'desc')
        modifier = -1;
        if(a[this.currentSort] < b[this.currentSort])
        return -1 * modifier;
        if(a[this.currentSort] > b[this.currentSort])
        return 1 * modifier;
        return 0;
      });
    },
  },
  methods:{
    sort:function(s) {
      //if s == current sort, reverse
      if(s === this.currentSort) {
        this.currentSortDir = this.currentSortDir==='asc'?'desc':'asc';
      }
      this.currentSort = s;
    },
    getBusinessProducts(){
       var filters={
           business_id:this.business_id,
           order:{by:'created_at',type:'asc'},
           paginate:10
       };
       var includes=[
         'product','product.category'
       ];
      axios.get('{{route("ibusiness.api.products.businessproducts")}}', {
        params: {
          filters: filters,
          includes:includes
        }
      })
      .then(response => {
        // console.log(response);
        this.businessproducts=response.data.data;
        this.businessproductsOrder=[];//Clear productsOrder
        this.loadCategories();
      })
      .catch(function (error) {
        console.log(error);
      });

      // axios.post('{{ url("api/ibusiness/products") }}', {business_id:this.business_id}).then(response => {
      //   this.businessproducts=response.data.businessproduct;
      //   this.businessproductsOrder=[];//Clear productsOrder
      //   this.loadCategories();
      // }).catch(error => {
      //   console.log(error);//Error
      // });
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
    loadCategories(){
      var categories=[];
      var b=0;
      for(var i=0;i<this.businessproducts.length;i++){
        for(var s=0;s<categories.length;s++){
          if(categories[s].nombre==this.businessproducts[i].category_name){
            b=1;
            break;
          }//if
        }//for
        if(b==0){
          categories.push({'name':this.businessproducts[i].category_name,'id':this.businessproducts[i].category_id});
        }//b==0
      }//for
      this.productCategories=categories;
    },
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
        axios.post('{{ url("business/preorder/") }}', {business_id:this.business_id,businessproducts:this.businessproductsOrder,payment_method:this.payment_method}).then(response => {
          if(response.data.status==202){
            this.alerta(response.data.message,'success');
            location.reload();
          }else{
            this.alerta(response.data.message,'error');
          }
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
  }
});

</script>
@stop
