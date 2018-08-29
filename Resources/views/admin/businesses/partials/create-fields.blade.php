<div class="box-body">
  <div class="col-md-6 form-group">
      <label>{{trans('ibusiness::businesses.title.name')}}:</label>
      <input type="text" name="name" class="form-control" required placeholder="Name business" value="{{old('name')}}">
  </div>
  <div class="col-md-6 form-group">
    <label>{{trans('ibusiness::businesses.title.description')}}:</label>
    <input type="text" name="description" class="form-control" required placeholder="Description about business" value="{{old('description')}}">
  </div>
  <div class="col-md-6 form-group">
    <label>{{trans('ibusiness::businesses.title.phone')}}:</label>
    <input type="text" name="phone" class="form-control" id="phone" required placeholder="Phone to contact business" value="{{old('phone')}}">
  </div>
  <div class="col-md-6 form-group">
    <label>{{trans('ibusiness::businesses.title.nit')}}:</label>
    <input type="text" name="nit" class="form-control" id="nit" required placeholder="Tax identification number" value="{{old('nit')}}">
  </div>
  <div class="col-md-6 form-group">
    <label>{{trans('ibusiness::businesses.title.email')}}:</label>
    <input type="text" name="email" class="form-control" required placeholder="E-mail to contact business" value="{{old('email')}}">
  </div>
  <!-- <div class="col-md-6 form-group">
    <label>{{trans('ibusiness::businesses.title.address')}}:</label>
    <input type="text" required class="form-control" name="address_1" value="{{old('address_1')}}">
  </div> -->
  <!-- <div class="col-md-6 form-group">
    <label>Parent:</label>
    <select class="form-control" required name="parent_id">
      <option value="0">Select a business</option>
      @foreach($businesses as $key)
        <option value="{{$key->id}}">{{$key->name}}</option>
      @endforeach
    </select>
  </div> -->
  <input type="hidden" name="parent_id" value="0">
  <div class="col-md-6 form-group">
    <label>{{trans('ibusiness::businesses.title.limit_budget')}}:</label>
    <input type="number" class="form-control" required name="budget" value="1">
  </div>
  <div class="col-md-6 form-group">
    <label>{{trans('ibusiness::businesses.title.person_first_name')}}:</label>
    <input type="text" class="form-control" required name="person_first_name" placeholder="First name of the legal representative" value="">
  </div>
  <div class="col-md-6 form-group">
    <label>{{trans('ibusiness::businesses.title.person_last_name')}}:</label>
    <input type="text" class="form-control" required name="person_last_name" placeholder="Last name of the legal representative" value="">
  </div>
  <hr>
  <div class="col-md-12 text-center">
    <h3>Address for billing / shipping</h3>
    <div class="col-md-6 form-group">
      <label>First name</label>
      <input type="text" name="firstname" class="form-control" required placeholder="First name of person" value="{{old('firstname')}}">
    </div>
    <div class="col-md-6 form-group">
      <label>Last name</label>
      <input type="text" name="lastname" class="form-control" required placeholder="Last name of person" value="{{old('lastname')}}">
    </div>
    <div class="col-md-6 form-group">
      <label>Address 1</label>
      <input type="text" name="address_1" class="form-control" required placeholder="Address 1" value="{{old('address_1')}}">
    </div>
    <div class="col-md-6 form-group">
      <label>Address 2</label>
      <input type="text" name="address_2" class="form-control"  placeholder="Address 2" value="{{old('address_2')}}">
    </div>
    <div class="col-md-6 form-group">
      <label>{{trans('ibusiness::businesses.title.type')}}:</label>
      <select class="form-control" name="type" required >
        <option value="billing">Billing</option>
        <option value="shipping">Shipping</option>
      </select>
    </div>
    <div class="col-md-6 form-group">
      <label>{{trans('ibusiness::businesses.title.postcode')}}:</label>
      <input type="number" required class="form-control" maxlength="5" name="postcode" value="{{old('postcode')}}">
    </div>
    <div class="col-md-6 form-group">
      <label>{{trans('ibusiness::businesses.title.country')}}:</label>
      <select class="form-control" required id="country" onChange="loadCity(this.options[this.selectedIndex].value)" name="country">
        <option>Select a country</option>
      </select>
    </div>
    <div class="col-md-6 form-group">
      <label>{{trans('ibusiness::businesses.title.state_province')}}:</label>
      <select class="form-control" required id="city" name="zone">
      </select>
    </div>
    <div class="col-xs-12 form-group">
      <label>City</label>
      <input type="text" name="city" class="form-control"  placeholder="City" value="{{old('city')}}">
    </div>
  </div>
</div>
