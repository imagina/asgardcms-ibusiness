<div class="box-body">
<div class="row">
  <div class="col-md-6">
    <label>Companies</label>
    <select class="form-control" onChange="getBranch(this.options[this.selectedIndex].value)" name="company">
      <option value="0">Select a company</option>
      @foreach($businesses as $key)
        <option value="{{$key->id}}" @if(old('company')==$key->id) selected @endif>{{$key->name}}</option>
      @endforeach
    </select>
  </div>
  <div class="col-md-6">
    <label>Branch offices</label>
    <select class="form-control" name="branch_office">
      <option value="0">Select a branch office</option>
    </select>
  </div>
  <div class="col-md-6">
    <label>Users</label>
    <select class="form-control" name="company">
      <option value="0">Select a user</option>
      @foreach($users as $key)
        <option value="{{$key->id}}">{{$key->first_name}} {{$key->last_name}} - {{$key->email}}</option>
      @endforeach
    </select>
  </div>
</div>
</div>
