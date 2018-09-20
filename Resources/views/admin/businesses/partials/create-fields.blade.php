<div class="box-body">
  <input type="hidden" name="parent_id" value="0">
  <div class="col-md-6 form-group">
      <label>{{trans('ibusiness::businesses.title.name')}}:</label>
      <input type="text" name="name" class="form-control" required placeholder="{{trans('ibusiness::businesses.title.name business')}}" value="{{old('name')}}">
      @if ($errors->has('name'))
          <span class="help-block">
              <strong>{{ $errors->first('name') }}</strong>
          </span>
      @endif
  </div>
  <div class="col-md-6 form-group">
    <label>{{trans('ibusiness::businesses.title.description')}}:</label>
    <input type="text" name="description" class="form-control" required placeholder="{{trans('ibusiness::businesses.title.description')}}" value="{{old('description')}}">
    @if ($errors->has('description'))
        <span class="help-block">
            <strong>{{ $errors->first('description') }}</strong>
        </span>
    @endif
  </div>
  <div class="col-md-6 form-group">
    <label>{{trans('ibusiness::businesses.title.phone')}}:</label>
    <input type="text" name="phone" class="form-control" id="phone" required placeholder="{{trans('ibusiness::businesses.title.phone_contact_business')}}" value="{{old('phone')}}">
    @if ($errors->has('phone'))
        <span class="help-block">
            <strong>{{ $errors->first('phone') }}</strong>
        </span>
    @endif
  </div>
  <div class="col-md-6 form-group">
    <label>{{trans('ibusiness::businesses.title.nit')}}:</label>
    <input type="text" name="nit" class="form-control" id="nit" required placeholder="{{trans('ibusiness::businesses.title.tax identification number')}}" value="{{old('nit')}}">
    @if ($errors->has('nit'))
        <span class="help-block">
            <strong>{{ $errors->first('nit') }}</strong>
        </span>
    @endif
  </div>
  <div class="col-md-6 form-group">
    <label>{{trans('ibusiness::businesses.title.email')}}:</label>
    <input type="email" name="email" class="form-control" required placeholder="{{trans('ibusiness::businesses.title.email')}}" value="{{old('email')}}">
    @if ($errors->has('email'))
        <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong>
        </span>
    @endif
  </div>
  <div class="col-md-6 form-group">
    <label>{{trans('ibusiness::businesses.title.limit_budget')}}:</label>
    <input type="number" class="form-control" required name="budget" step="0.01" min="1">
    @if ($errors->has('budget'))
        <span class="help-block">
            <strong>{{ $errors->first('budget') }}</strong>
        </span>
    @endif
  </div>
  <div class="col-md-6 form-group">
    <label>{{trans('ibusiness::businesses.title.person_first_name')}}:</label>
    <input type="text" class="form-control" required name="person_first_name" placeholder="{{trans('ibusiness::businesses.title.person_first_name')}}" value="">
    @if ($errors->has('person_first_name'))
        <span class="help-block">
            <strong>{{ $errors->first('person_first_name') }}</strong>
        </span>
    @endif
  </div>
  <div class="col-md-6 form-group">
    <label>{{trans('ibusiness::businesses.title.person_last_name')}}:</label>
    <input type="text" class="form-control" required name="person_last_name" placeholder="{{trans('ibusiness::businesses.title.person_last_name')}}" value="">
    @if ($errors->has('person_last_name'))
        <span class="help-block">
            <strong>{{ $errors->first('person_last_name') }}</strong>
        </span>
    @endif
  </div>
  <br>
  <div class="col-md-12 text-center  box box-primary" style="margin-top:25px;">
    <div class="box-header with-border">
      <h3 class="box-title">{{trans('ibusiness::businesses.title.address_billing_shipping')}}</h3>
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
        <option value="billing">{{trans('ibusiness::businesses.title.billing')}}</option>
        <!-- <option value="shipping">Shipping</option> -->
      </select>
    </div>
    <div class="col-md-6 form-group">
      <label>{{trans('ibusiness::businesses.title.postcode')}}:</label>
      <input type="text" required class="form-control postcode" id="postcode" name="postcode" value="{{old('postcode')}}">
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
      <input type="text" name="city" required class="form-control"  placeholder="{{trans('ibusiness::businesses.title.city')}}" value="{{old('city')}}">
      @if ($errors->has('city'))
          <span class="help-block">
              <strong>{{ $errors->first('city') }}</strong>
          </span>
      @endif
    </div>
    <hr>

    <div class="text-uppercase" style="font-weight:bold;">
      <input type="checkbox" onclick="showShippingForm()" name="addressShipping" id="addressShipping" > {{trans('ibusiness::businesses.form.address_shipping_same_billing')}}
    </div>

    <div id="formShipping" class="box box-primary" style="margin-top:25px;">
      <div class="box-header with-border">
        <h4 class="box-title">{{trans('ibusiness::businesses.title.address_shipping')}}</h4>
      </div>
      <div class="col-md-6 form-group">
        <label>{{trans('ibusiness::businesses.title.firstname')}}:</label>
        <input type="text" name="firstname_shipping" class="form-control" required placeholder="{{trans('ibusiness::businesses.title.firstname')}}" value="{{old('firstname')}}">
        @if ($errors->has('firstname_shipping'))<span class="help-block"><strong>{{ $errors->first('firstname_shipping') }}</strong></span>@endif
      </div>
      <div class="col-md-6 form-group">
        <label>{{trans('ibusiness::businesses.title.lastname')}}:</label>
        <input type="text" name="lastname_shipping" class="form-control" required placeholder="{{trans('ibusiness::businesses.title.lastname')}}" value="{{old('lastname')}}">
        @if ($errors->has('lastname_shipping'))
        <span class="help-block">
          <strong>{{ $errors->first('lastname_shipping') }}</strong>
        </span>
        @endif
      </div>
      <div class="col-md-6 form-group">
        <label>{{trans('ibusiness::businesses.title.address_1')}}:</label>
        <input type="text" name="address_1_shipping" class="form-control" required placeholder="{{trans('ibusiness::businesses.title.address_1')}}" value="{{old('address_1')}}">
        @if ($errors->has('address_1'))
        <span class="help-block">
          <strong>{{ $errors->first('address_1_shipping') }}</strong>
        </span>
        @endif
      </div>
      <div class="col-md-6 form-group">
        <label>{{trans('ibusiness::businesses.title.address_2')}}:</label>
        <input type="text" name="address_2_shipping" class="form-control"  placeholder="{{trans('ibusiness::businesses.title.address_2')}}" value="{{old('address_2')}}">
        @if ($errors->has('address_2_shipping'))
        <span class="help-block">
          <strong>{{ $errors->first('address_2_shipping') }}</strong>
        </span>
        @endif
      </div>
      <div class="col-md-6 form-group">
        <label>{{trans('ibusiness::businesses.title.type')}}:</label>
        <select class="form-control" name="type_shipping" required >
          <!--<option value="billing">Billing</option>-->
          <option value="shipping">{{trans('ibusiness::businesses.title.shipping')}}</option>
        </select>
      </div>
      <div class="col-md-6 form-group">
        <label>{{trans('ibusiness::businesses.title.postcode')}}:</label>
        <input type="text" required class="form-control postcode" id="postcode" name="postcode_shipping" value="{{old('postcode')}}">
        @if ($errors->has('postcode_shipping'))
        <span class="help-block">
          <strong>{{ $errors->first('postcode_shipping') }}</strong>
        </span>
        @endif
      </div>
      <div class="col-md-6 form-group">
        <label>{{trans('ibusiness::businesses.title.country')}}:</label>
        <select class="form-control" name="country_shipping" required id="country_s" onChange="loadCity_s(this.options[this.selectedIndex].value)" >
          <option>{{trans('ibusiness::businesses.title.select_country')}}</option>
        </select>
      </div>
      <div class="col-md-6 form-group">
        <label>{{trans('ibusiness::businesses.title.state_province')}}:</label>
        <select class="form-control" required id="city_s" name="zone_shipping">
        </select>
      </div>
      <div class="col-xs-12 form-group">
        <label>{{trans('ibusiness::businesses.title.city')}}:</label>
        <input type="text" name="city_shipping" required class="form-control"  placeholder="{{trans('ibusiness::businesses.title.city')}}" value="{{old('city')}}">
        @if ($errors->has('city_shipping'))
        <span class="help-block">
          <strong>{{ $errors->first('city_shipping') }}</strong>
        </span>
        @endif
      </div>
    </div>
  </div>
</div>
