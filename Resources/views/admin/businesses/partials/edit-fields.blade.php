<div class="box-body">
  <div class="col-md-6 form-group">
    <label>Name:</label>
    <input type="text" name="name" required class="form-control" placeholder="Name business" value="{{$business->name}}">
    @if ($errors->has('name'))<span class="help-block"><strong>{{ $errors->first('name') }}</strong></span>@endif
  </div>
  <div class="col-md-6 form-group">
    <label>Description:</label>
    <input type="text" name="description" required class="form-control" placeholder="Description about business" value="{{$business->description}}">
    @if ($errors->has('description'))<span class="help-block"><strong>{{ $errors->first('description') }}</strong></span>@endif
  </div>
  <div class="col-md-6 form-group">
    <label>{{trans('ibusiness::businesses.title.phone')}}:</label>
    <input type="text" name="phone" required class="form-control" id="phone" required placeholder="Phone to contact business" value="{{$business->phone}}">
    @if ($errors->has('phone'))<span class="help-block"><strong>{{ $errors->first('phone') }}</strong></span>@endif
  </div>
  <div class="col-md-6 form-group">
    <label>{{trans('ibusiness::businesses.title.nit')}}:</label>
    <input type="text" name="nit" required class="form-control" id="nit" required placeholder="Tax identification number" value="{{$business->nit}}">
    @if ($errors->has('nit'))<span class="help-block"><strong>{{ $errors->first('nit') }}</strong></span>@endif
  </div>
  <div class="col-md-6 form-group">
    <label>{{trans('ibusiness::businesses.title.email')}}:</label>
    <input type="text" name="email" required class="form-control" required placeholder="E-mail to contact business" value="{{$business->email}}">
    @if ($errors->has('email'))<span class="help-block"><strong>{{ $errors->first('email') }}</strong></span>@endif
  </div>
  <div class="col-md-6 form-group">
    <label>{{trans('ibusiness::businesses.title.limit_budget')}}:</label>
    <input type="number" required class="form-control" required name="budget" step="0.01" min="1" value="{{$business->budget}}">
    @if ($errors->has('budget'))<span class="help-block"><strong>{{ $errors->first('budget') }}</strong></span>@endif
  </div>
  <div class="col-md-6 form-group">
    <label>{{trans('ibusiness::businesses.title.person_first_name')}}:</label>
    <input type="text" required class="form-control" required name="person_firstname" placeholder="First name of the legal representative" value="{{$business->person_firstname}}">
    @if ($errors->has('person_firstname'))<span class="help-block"><strong>{{ $errors->first('person_firstname') }}</strong></span>@endif
  </div>
  <div class="col-md-6 form-group">
    <label>{{trans('ibusiness::businesses.title.person_last_name')}}:</label>
    <input type="text" required class="form-control" required name="person_lastname" placeholder="Last name of the legal representative" value="{{$business->person_lastname}}">
    @if ($errors->has('person_lastname'))<span class="help-block"><strong>{{ $errors->first('person_lastname') }}</strong></span>@endif
  </div>
</div>
