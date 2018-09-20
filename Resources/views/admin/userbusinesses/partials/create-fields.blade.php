<div class="box-body">
  <input type="hidden" name="users" id="users" value="">
  <div class="row">
    <div class="col-md-6">
      <label>{{ trans('ibusiness::userbusinesses.form.companies') }}</label>
      <select class="form-control" required onChange="getBranch(this.options[this.selectedIndex].value)" id="company" name="company">
        <option value="0">Select a company</option>
        @foreach($businesses as $key)
        <option value="{{$key->id}}" @if(old('company')==$key->id) selected @endif>{{$key->name}}</option>
        @endforeach
      </select>
    </div>
    <div class="col-md-6">
      <label>{{ trans('ibusiness::userbusinesses.form.branch offices') }}</label>
      <select class="form-control" required name="branch_office" id="branch_office">
        <option value="0" >Select a business</option>
      </select>
    </div>
    <div class="col-md-12 text-center">
      <div class="table table-responsive">
        <br>
        <h4><strong>{{ trans('ibusiness::userbusinesses.form.users') }}</strong></h4>
        <table class="table table-bordered table-striped" id="tableUsers">
          <thead>
            <th scope="col" style="text-align: center;">#</th>
            <th scope="col" style="text-align: center;">{{ trans('ibusiness::userbusinesses.form.table.user') }}</th>
            <th scope="col" style="text-align: center;">{{ trans('ibusiness::userbusinesses.form.table.businesses') }}</th>
            <th scope="col" style="text-align:center;" onload="">{{ trans('ibusiness::userbusinesses.form.table.action') }}</th>
          </thead>
          <tbody>
            @foreach($users as $key)
            <tr>
              <td scope="row">{{$loop->iteration}}</td>
              <td>{{$key['user_fullname']}}</td>
              <td>{{$key['business']}}</td>
              <td>
                <input type="checkbox" onclick="getUserId({{$key['user_id']}})" value="">
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
