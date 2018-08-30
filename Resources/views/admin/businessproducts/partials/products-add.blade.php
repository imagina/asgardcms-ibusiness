<pre> 
    OJO: Se puede EDITAR el precio de un Producto <br>

    - Opcion 1: Hacerlo antes de Asignar (Despues de la busqueda) <br>
    - Opcion 2: Agregar un boton dentro de la tabla para Editar precio (Ya se ha asignado el Producto)<br>
    - Opcion X: ???
   
</pre>

<div id="searchUser">

    <div class="input-group">
        <input type="text" class="form-control" placeholder="{{trans('ibusiness::businessproducts.table.search product')}}">
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