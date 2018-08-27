<div class="box-body">
  <div class="col-md-6">
    <label>Name:</label>
    <input type="text" name="name" class="form-control" required placeholder="Name business" value="{{old('name')}}">
  </div>
  <div class="col-md-6">
    <label>Description:</label>
    <input type="text" name="description" class="form-control" required placeholder="Description about business" value="{{old('description')}}">
  </div>
  <div class="col-md-6">
    <label >Country</label>
    <select class="form-control" required id="country" onChange="loadCity(this.options[this.selectedIndex].value)" name="country">
      <option>Select a country</option>
    </select>
  </div>
  <div class="col-md-6">
    <label >City</label>
    <select class="form-control" required id="city" name="city">
    </select>
  </div>
  <div class="col-md-6">
    <label >Address</label>
    <input type="text" required class="form-control" name="address_1" value="{{old('address_1')}}">
  </div>
  <div class="col-md-6">
    <label >Postal code</label>
    <input type="number" required class="form-control" maxlength="5" name="postcode" value="{{old('postcode')}}">
  </div>
  <div class="col-md-6">
    <label>Parent:</label>
    <select class="form-control" required name="parent_id">
      <option value="0">Select a business</option>
      @foreach($businesses as $key)
        <option value="{{$key->id}}">{{$key->name}}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-6">
    <label>Budget limit:</label>
    <input type="number" class="form-control" required name="budget" value="0">
  </div>
</div>
