<script type="text/javascript">
var address=[];
var firstname;
var lastname;
var address_1;
var address_2;
var city;
var postcode;
var country;
var zone;
var type;
var id;
</script>
<!-- Modal -->
<div id="addressModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header text-center">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h3 class="modal-title"><strong>{{trans('ibusiness::businesses.title.add_address_billing_shipping')}}</strong></h3>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 text-center">
            <!-- <h3>Add new address for billing / shipping</h3> -->
            @if($business->parent_id!=0)

            <input onclick="checkBilling()" type="checkbox" id="addressBilling" value="0"> {{trans('ibusiness::businesses.form.use_billing_address_main_company')}}
            <hr>
            @endif
            <div id="newAddress">
              <div class="col-md-6 form-group">
                <label>{{trans('ibusiness::businesses.title.firstname')}}:</label>
                <input type="text" name="firstname" id="firstname" class="form-control" required placeholder="{{trans('ibusiness::businesses.title.firstname')}}" value="{{old('firstname')}}">
              </div>
              <div class="col-md-6 form-group">
                <label>{{trans('ibusiness::businesses.title.lastname')}}:</label>
                <input type="text" name="lastname" id="lastname" class="form-control" required placeholder="{{trans('ibusiness::businesses.title.lastname')}}" value="{{old('lastname')}}">
              </div>
              <div class="col-md-6 form-group">
                <label>{{trans('ibusiness::businesses.title.address_1')}}:</label>
                <input type="text" name="address_1" id="address_1" class="form-control" required placeholder="{{trans('ibusiness::businesses.title.address_1')}}" value="{{old('address_1')}}">
              </div>
              <div class="col-md-6 form-group">
                <label>{{trans('ibusiness::businesses.title.address_2')}}:</label>
                <input type="text" name="address_2" id="address_2" class="form-control"  placeholder="{{trans('ibusiness::businesses.title.address_2')}}" value="{{old('address_2')}}">
              </div>
              <div class="col-md-6 form-group">
                <label>{{trans('ibusiness::businesses.title.type')}}:</label>
                <select class="form-control" name="type" id="type" required >
                  <option value="">{{trans('ibusiness::businesses.title.select_optional_type')}}</option>
                  <option value="billing">Billing</option>
                  <option value="shipping">Shipping</option>
                </select>
              </div>
              <div class="col-md-6 form-group">
                <label>{{trans('ibusiness::businesses.title.postcode')}}:</label>
                <input type="text" required class="form-control" id="postcode" maxlength="5" name="postcode" value="{{old('postcode')}}">
              </div>
              <div class="col-md-6 form-group">
                <label>{{trans('ibusiness::businesses.title.country')}}:</label>
                <select class="form-control" required id="country" onChange="loadCity(this.options[this.selectedIndex].value)" name="country">
                  <option value="0">{{trans('ibusiness::businesses.title.select_country')}}</option>
                </select>
              </div>
              <div class="col-md-6 form-group">
                <label>{{trans('ibusiness::businesses.title.state_province')}}:</label>
                <select class="form-control" required id="zone" name="zone">
                </select>
              </div>
              <div class="col-xs-12 form-group">
                <label>{{trans('ibusiness::businesses.title.city')}}:</label>
                <input type="text" id="city" name="city" class="form-control"  placeholder="{{trans('ibusiness::businesses.title.city')}}" value="{{old('city')}}">
              </div>
            </div>
            <div class="mx-auto">
              <button type="button" class="btn btn-success" id="buttonAddress" onclick="addAddress2()" name="button">{{trans('ibusiness::businesses.button.add address')}}</button>
              <button type="button" class="btn btn-warning" onclick="cancelUpdateAddress()" style="display:none;" id="btnCancel" name="button">{{ trans('core::core.button.cancel') }}</button>
            </div>
          </div>
        </div>
        <br>
        <div class="row col-md-12 table-responsive">
          <div class="text-center">
            <h3>{{trans('ibusiness::businesses.title.address of company')}}</h3>
            <table class="table table-bordered" id="addresses">
              <thead>
                <tr>
                  <th>#</th>
                  <th>{{trans('ibusiness::businesses.title.person')}}</th>
                  <th>{{trans('ibusiness::businesses.title.address')}}</th>
                  <th>{{trans('ibusiness::businesses.title.type')}}</th>
                  <th>{{ trans('core::core.table.actions') }}</th>
                </tr>
              </thead>
              <tbody>
                @foreach($business->addresses as $address)
                <script type="text/javascript">
                  firstname="{{$address->firstname}}";
                  lastname="{{$address->lastname}}";
                  address_1="{{$address->address_1}}";
                  address_2="{{$address->address_2}}";
                  city="{{$address->city}}";
                  postcode="{{$address->postcode}}";
                  country="{{$address->country}}";
                  zone="{{$address->zone}}";
                  type="{{$address->type}}";
                  id="{{$address->id}}";
                  var data={
                    id,firstname,lastname,address_1,address_2,city,postcode,country,zone,type
                  }//data
                  address.push(data);
                  // console.log('address:');
                  // console.log(address);
                </script>
                <tr>
                  <td>{{$loop->iteration}}</td>
                  <td>{{$address->firstname}} {{$address->lastname}}</td>
                  <td>{{$address->address_1}} - {{$address->city}}</td>
                  @if($address->type!="" || $address->type!=null)
                  <td><span class="badge badge-primary">{{$address->type}}</span></td>
                  @else
                  <td></td>
                  @endif
                  <td>
                    <div class="input-group">
                      <button type="button" name="button" class="btn btn-info btn-sm" onclick="updateAddress({{$address->id}})"> <i class="fa fa-pencil-square-o" ></i> </button>
                      <button type="button" name="button" class="btn btn-info btn-sm" onclick="deleteAddress({{$address->id}})"> <i class="fa fa-trash" ></i> </button>
                    </div>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">{{ trans('core::core.button.cancel') }}</button>
      </div>
    </div>

  </div>
</div>
