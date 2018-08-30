<pre> 
    
    - Buscar usuario (Autocomplete) ( Creo que JqueryUI no esta por defecto) <br>
    - Asignar Usuario (Via AJAX)<br>
    - Recargar la tabla

    - Eliminar Usuario (Probar la forma de asgard o por Ajax)
    - Recargar la tabla
       
</pre>

<div id="searchUser">

    <div class="input-group">
        <input type="text" class="form-control" placeholder="{{trans('ibusiness::userbusinesses.table.search the user')}}">
            <span class="input-group-btn">
            <button type="button" class="btn btn-info btn-flat">{{trans('ibusiness::userbusinesses.button.asign user')}}</button>
        </span>
    </div>

</div>

@push('js-stack')

<script type="text/javascript">

    $(function(){ 

        
       
    });

</script>


@endpush