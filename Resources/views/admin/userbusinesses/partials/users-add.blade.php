<div id="searchUser">

    {!! Form::open(['route' => ['admin.ibusiness.userbusiness.addUsers', $business->id], 'method' => 'post']) !!}
	
	<div class="row">
        <div class="col-sm-10">
            <div class="form-group">
                <select id="users_ids" name="users_ids[]" class="form-control" multiple style="width:100%;" required>
                                
                </select>
                        
            </div>
        </div> 
        
        <div class="col-sm-2">
            <button type="submit" class="btn btn-info btn-flat">{{trans('ibusiness::userbusinesses.button.asign user')}}</button>
        </div>
   </div>

   {!! Form::close() !!}

</div>

<link href="{{asset('modules/bcrud/vendor/select2/select2.css')}}" rel="stylesheet" type="text/css" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="{{asset('modules/bcrud/vendor/select2/select2-bootstrap-dick.css') }}" rel="stylesheet" type="text/css" />


@push('js-stack')

<script src="{{ asset('modules/bcrud/vendor/select2/select2.js') }}"></script>
@if(locale()=="es")
    <script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/i18n/es.js"></script>
@endif

<script type="text/javascript">

    
    $(function(){ 

        $("#users_ids").each(function (i, obj) {
            if (!$(obj).hasClass("select2-hidden-accessible"))
            {
	            $(obj).select2({
	                theme: 'bootstrap',
	                multiple: true,
	                placeholder: "{{trans('ibusiness::userbusinesses.table.search the user')}}",
	                minimumInputLength: "2",
	                language:"{{locale()}}",
	                
                    ajax: {
		                url: "{{route('admin.ibusiness.userbusiness.searchUsers')}}",
		                dataType: 'json',
		                quietMillis: 250,
		                data: function (params) {
		                    return {
                                q: params.term, // search term
                                page: params.page,
								business_id: {{$business->id}}
                            };
		                },
		                
                        processResults: function (data, params) {
							params.page = params.page || 1;
								   

							return {
		                        results: $.map(data.data, function (item) {
                                    
                                    titl = item["first_name"]+" "+item["last_name"]+" - "+item["email"];
		                           
		                            return {
		                                text: titl,
		                                id: item["id"]
		                            }

		                        }),
		                        more: data.current_page < data.last_page
		                    };
		                },
		                cache: true
	                },

	            });
	        }
        });
       
    });

</script>


@endpush