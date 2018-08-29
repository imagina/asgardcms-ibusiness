<div class="box-body">
  <div class="col-md-6 form-group">
    <label>Name:</label>
    <input type="text" name="name" class="form-control" placeholder="Name business" value="{{$business->name}}">
  </div>
  <div class="col-md-6 form-group">
    <label>Description:</label>
    <input type="text" name="description" class="form-control" placeholder="Description about business" value="{{$business->description}}">
  </div>
  <div class="col-md-6 form-group">
    <label >Country</label>
    <select class="form-control" required id="country" onChange="loadCity(this.options[this.selectedIndex].value)" name="country">
      <option>Select a country</option>
    </select>
  </div>
  <div class="col-md-6 form-group">
    <label >City</label>
    <select class="form-control" required id="city" name="city">
    </select>
  </div>
  <div class="col-md-6 form-group">
    <label >Address</label>
  <input type="text" required class="form-control" name="address_1" value="{{$business->address_1}}">
  </div>
  <div class="col-md-6 form-group">
    <label >Postal code</label>
    <input type="number" required class="form-control" maxlength="5" name="postcode" value="{{$business->postcode}}">
  </div>
  <div class="col-md-6 form-group">
    <label>Parent_id</label>
    <select class="form-control" name="parent_id">
      <option value="0">Select a business</option>
      @foreach($businesses as $key)
        @if($key->id!=$business->id)
          <option value="{{$key->id}}" @if($business->parent_id==$key->id) selected @endif>{{$key->name}}</option>
        @endif
      @endforeach
    </select>
  </div>
  <div class="col-md-6 form-group">
    <label>Budget:</label>
    <input type="number" class="form-control" required name="budget" value="{{$business->budget}}">
  </div>
  <div class="col-md-12">
    <h3 style="text-align:center">Branch offices</h3>
    <table class="table table-bordered">
      <thead>
        <tr>
          <th>#</th>
          <th>Name</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach($branchOffices as $branchoffice)
        <tr>
          <td>{{$loop->iteration}}</td>
          <td>{{$branchoffice->name}} - {{$branchoffice->description}}</td>
          <td>
            <button type="button" class="btn btn-info" name="button"><i class="fa fa-pencil"></i></button>
            <button type="button" class="btn btn-danger" name="button"><i class="fa fa-trash"></i></button>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
