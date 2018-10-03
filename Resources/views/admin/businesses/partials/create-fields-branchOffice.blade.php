<div class="box-body">
  <div class="col-md-6 form-group">
      <label>{{trans('ibusiness::businesses.title.name')}}:</label>
      <input type="text" name="name" class="form-control" required placeholder="{{trans('ibusiness::businesses.title.name business')}}" value="{{old('name')}}">
  </div>
  <div class="col-md-6 form-group">
    <label>{{trans('ibusiness::businesses.title.description')}}:</label>
    <input type="text" name="description" class="form-control" required placeholder="{{trans('ibusiness::businesses.title.description')}}" value="{{old('description')}}">
  </div>
  <div class="col-md-6 form-group">
    <label>{{trans('ibusiness::businesses.title.phone')}}:</label>
    <input type="text" name="phone" class="form-control" id="phone" required placeholder="{{trans('ibusiness::businesses.title.phone_contact_business')}}" value="{{old('phone')}}">
  </div>
  <div class="col-md-6 form-group">
    <label>{{trans('ibusiness::businesses.title.nit')}}:</label>
    <input type="text" name="nit" class="form-control" id="nit" required placeholder="{{trans('ibusiness::businesses.title.tax identification number')}}" value="{{old('nit')}}">
  </div>
  <div class="col-md-6 form-group">
    <label>{{trans('ibusiness::businesses.title.email')}}:</label>
    <input type="text" name="email" class="form-control" required placeholder="{{trans('ibusiness::businesses.title.email')}}" value="{{old('email')}}">
  </div>
  <input type="hidden" name="parent_id" value="{{$business_id}}">
  <div class="col-md-6 form-group">
    <label>{{trans('ibusiness::businesses.title.limit_budget')}}:</label>
    <input type="number" class="form-control" required name="budget" step="0.01" min="1">
  </div>
  <div class="col-md-6 form-group">
    <label>{{trans('ibusiness::businesses.title.person_first_name')}}:</label>
    <input type="text" class="form-control" required name="person_first_name" placeholder="{{trans('ibusiness::businesses.title.person_first_name')}}" value="">
  </div>
  <div class="col-md-6 form-group">
    <label>{{trans('ibusiness::businesses.title.person_last_name')}}:</label>
    <input type="text" class="form-control" required name="person_last_name" placeholder="{{trans('ibusiness::businesses.title.person_last_name')}}" value="">
  </div>
  <hr>
  <div class="col-md-12 text-center box box-primary" style="margin-top:25px;">
    <div class="box-header with-border">
      <h3 class="box-title">{{trans('ibusiness::businesses.title.address_shipping')}}</h3>
    </div>
    <div class="col-md-6 form-group">
      <label>{{trans('ibusiness::businesses.title.firstname')}}:</label>
      <input type="text" name="firstname" class="form-control" required placeholder="{{trans('ibusiness::businesses.title.firstname')}}" value="{{old('firstname')}}">
      @if ($errors->has('firstname'))<span class="help-block"><strong>{{ $errors->first('firstname') }}</strong></span>@endif
    </div>
    <div class="col-md-6 form-group">
      <label>{{trans('ibusiness::businesses.title.lastname')}}:</label>
      <input type="text" name="lastname" class="form-control" required placeholder="{{trans('ibusiness::businesses.title.lastname')}}" value="{{old('lastname')}}">
      @if ($errors->has('lastname'))
          <span class="help-block">
              <strong>{{ $errors->first('lastname') }}</strong>
          </span>
      @endif
    </div>
    <div class="col-md-6 form-group">
      <label>{{trans('ibusiness::businesses.title.address_1')}}:</label>
      <input type="text" name="address_1" class="form-control" required placeholder="{{trans('ibusiness::businesses.title.address_1')}}" value="{{old('address_1')}}">
      @if ($errors->has('address_1'))
          <span class="help-block">
              <strong>{{ $errors->first('address_1') }}</strong>
          </span>
      @endif
    </div>
    <div class="col-md-6 form-group">
      <label>{{trans('ibusiness::businesses.title.address_2')}}:</label>
      <input type="text" name="address_2" class="form-control"  placeholder="{{trans('ibusiness::businesses.title.address_2')}}" value="{{old('address_2')}}">
      @if ($errors->has('address_2'))
          <span class="help-block">
              <strong>{{ $errors->first('address_2') }}</strong>
          </span>
      @endif
    </div>
    <div class="col-md-6 form-group">
      <label>{{trans('ibusiness::businesses.title.type')}}:</label>
      <select class="form-control" name="type" required >
        <option value="shipping">{{trans('ibusiness::businesses.title.shipping')}}</option>
      </select>
    </div>
    <div class="col-md-6 form-group">
      <label>{{trans('ibusiness::businesses.title.postcode')}}:</label>
      <input type="text" required class="form-control postcode" name="postcode" value="{{old('postcode')}}">
      @if ($errors->has('postcode'))
          <span class="help-block">
              <strong>{{ $errors->first('postcode') }}</strong>
          </span>
      @endif
    </div>
    <div class="col-md-6 form-group">
      <label>{{trans('ibusiness::businesses.title.country')}}:</label>
      <select class="form-control" required id="country" onChange="loadCity(this.options[this.selectedIndex].value)" name="country">
        <option>{{trans('ibusiness::businesses.title.select_country')}}</option>
      </select>
    </div>
    <div class="col-md-6 form-group">
      <label>{{trans('ibusiness::businesses.title.state_province')}}:</label>
      <select class="form-control" required id="city" name="zone">
      </select>
    </div>
    <div class="col-xs-12 form-group">
      <label>{{trans('ibusiness::businesses.title.city')}}:</label>
      <input type="text" name="city" class="form-control"  placeholder="{{trans('ibusiness::businesses.title.city')}}" value="{{old('city')}}">
      @if ($errors->has('city'))
          <span class="help-block">
              <strong>{{ $errors->first('city') }}</strong>
          </span>
      @endif
      <hr>
      <div class="form-check text-uppercase text-left">
        <input class="form-check-input" onclick="showBillingForm()" type="radio" name="addressBilling" value="10" >
        <label class="form-check-label" >
        {{trans('ibusiness::businesses.form.address_billing_same_shipping')}}
        </label>
      </div>
      <div class="form-check text-uppercase text-left">
        <input class="form-check-input" onclick="showBillingForm()" type="radio" name="addressBilling" value="20">
        <label class="form-check-label" >
          {{trans('ibusiness::businesses.form.address_billing_same_main_company')}} ({{$business->name}})
        </label>
      </div>
      <div class="form-check text-uppercase text-left">
        <input class="form-check-input" type="radio" onclick="showBillingForm()" name="addressBilling" id="addressBilling" value="30" checked >
        <label class="form-check-label" >
          {{trans('ibusiness::businesses.form.add_new_billing_address')}}
        </label>
      </div>
      <hr>
    </div>
    <div class="clearfix"></div>
    <div id="formBilling" class="box box-primary">
      <div class="box-header with-border">
        <h3 class="box-title">Dirección de facturación</h3>
      </div>
      <div class="col-md-6 form-group">
        <label>{{trans('ibusiness::businesses.title.firstname')}}:</label>
        <input type="text" name="firstname_billing" class="form-control" required placeholder="{{trans('ibusiness::businesses.title.firstname')}}" value="{{old('firstname_billing')}}">
        @if ($errors->has('firstname_billing'))<span class="help-block"><strong>{{ $errors->first('firstname_billing') }}</strong></span>@endif
      </div>
      <div class="col-md-6 form-group">
        <label>{{trans('ibusiness::businesses.title.lastname')}}:</label>
        <input type="text" name="lastname_billing" class="form-control" required placeholder="{{trans('ibusiness::businesses.title.lastname')}}" value="{{old('lastname_billing')}}">
        @if ($errors->has('lastname_billing'))
            <span class="help-block">
                <strong>{{ $errors->first('lastname_billing') }}</strong>
            </span>
        @endif
      </div>
      <div class="col-md-6 form-group">
        <label>{{trans('ibusiness::businesses.title.address_1')}}:</label>
        <input type="text" name="address_1_billing" class="form-control" required placeholder="{{trans('ibusiness::businesses.title.address_1')}}" value="{{old('address_1_billing')}}">
        @if ($errors->has('address_1_billing'))
            <span class="help-block">
                <strong>{{ $errors->first('address_1_billing') }}</strong>
            </span>
        @endif
      </div>
      <div class="col-md-6 form-group">
        <label>{{trans('ibusiness::businesses.title.address_2')}}:</label>
        <input type="text" name="address_2_billing" class="form-control"  placeholder="{{trans('ibusiness::businesses.title.address_2')}}" value="{{old('address_2_billing')}}">
        @if ($errors->has('address_2_billing'))
            <span class="help-block">
                <strong>{{ $errors->first('address_2_billing') }}</strong>
            </span>
        @endif
      </div>
      <div class="col-md-6 form-group">
        <label>{{trans('ibusiness::businesses.title.type')}}:</label>
        <select class="form-control" name="type_billing" required >
          <option value="billing">{{trans('ibusiness::businesses.title.billing')}}</option>
        </select>
      </div>
      <div class="col-md-6 form-group">
        <label>{{trans('ibusiness::businesses.title.postcode')}}:</label>
        <input type="text" required class="form-control postcode" name="postcode_billing" value="{{old('postcode_billing')}}">
        @if ($errors->has('postcode_billing'))
            <span class="help-block">
                <strong>{{ $errors->first('postcode_billing') }}</strong>
            </span>
        @endif
      </div>
      <div class="col-md-6 form-group">
        <label>{{trans('ibusiness::businesses.title.country')}}:</label>
        <select class="form-control" required id="country_billing" onChange="loadCity(this.options[this.selectedIndex].value)" name="country_billing">
          <option>{{trans('ibusiness::businesses.title.select_country')}}</option>
        </select>
      </div>
      <div class="col-md-6 form-group">
        <label>{{trans('ibusiness::businesses.title.state_province')}}:</label>
        <select class="form-control" required id="city_billing" name="zone_billing">
        </select>
      </div>
      <div class="col-xs-12 form-group">
        <label>{{trans('ibusiness::businesses.title.city')}}:</label>
        <input type="text" name="city_billing" class="form-control"  placeholder="{{trans('ibusiness::businesses.title.city')}}" value="{{old('city_billing')}}">
        @if ($errors->has('city_billing'))
            <span class="help-block">
                <strong>{{ $errors->first('city_billing') }}</strong>
            </span>
        @endif
      </div>
    </div>
  </div>
</div>
