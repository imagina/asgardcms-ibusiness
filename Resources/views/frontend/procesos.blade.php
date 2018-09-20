@extends('layouts.master')

@section('title')
    Title | @parent
@stop


@section('content')
    
<div class="container">

    <div class="my-5"></div>

    <div class="row"><h2> Frontend - Procesos </h2></div>

    <div class="my-5"></div>

    <div class="row">

        <div class="col">
            <div class="card">
                <div class="card-header">INDEX</div>
                <div class="card-body">
                    <p class="card-text mb-3">- Listar PreOrdenes - <span class="text-light bg-primary p-1">buyer</span>, <span class="text-light bg-dark p-1"> approver </span> </p>
                    <p class="card-text mb-3">- Crear PreOrden (btn) - <span class="text-light bg-primary p-1">buyer</span> </p>
                    <p class="card-text">- Ver PreOrden (btn) - <span class="text-light bg-primary p-1">buyer</span> <span class="text-light bg-dark p-1"> approver </span> </p> <br>
                    <p class="card-text">- Pagar (btn) - <span class="text-light bg-primary p-1">buyer</span> : Se activa cuando la orden tiene estatus "PROCESSING", es decir que ya se puede pagar y pasa directamente al metodo de pago </p>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card">
                <div class="card-header"> Crear PREORDEN - <span class="text-light bg-primary p-1"> Buyer </span> </div>
                <div class="card-body">
                    <p class="card-text">- Listar / Seleccionar Empresa</p>
                    <p class="card-text">- Listar / Seleccionar Productos </p>
                    <p class="card-text">- Listar / Seleccionar Metodos de Pago</p>
                    <p class="card-text">- Pagar (btn) / Generar Orden (Status PENDING) </p>
                    <p class="card-text">- Enviar Email notificacion al aprobador o aprobadores (approver)</p>
                    <br>
                    <div class="alert alert-warning" role="alert">
                        Recordar que cada Empresa tiene un LIMITE de presupuesto para Comprar
                    </div>
                </div>
            </div>
        </div>

    </div>
    
    <div class="my-5"></div>

    <div class="row">

        <div class="col">
            <div class="card">
                <div class="card-header"> Ver PREORDEN - <span class="text-light bg-primary p-1"> Buyer </span></div>
                <div class="card-body">
                    <p class="card-text">- Mostrar Informacion de la Orden (Incluyendo los estatus de los approvers)</p>
                </div>
            </div>
        </div>

        <div class="col">

            <div class="card">
                <div class="card-header"> Ver PREORDEN - <span class="text-light bg-dark p-1">Approver</span></div>
                <div class="card-body">
                    <p class="card-text">- Cambiar el Edo de la Orden ( PROCESSING o CANCELED) </p>
                    <p class="card-text">- Actualizar Orden</p>
                    <p class="card-text">- Enviar Email notificacion al comprador (buyer) </p>
                </div>
            </div>
            
        </div>

    </div>

    <div class="my-5"></div>

    <div class="row">

        <div class="col">
            <div class="card border-danger">
                <div class="card-header text-white bg-danger"> DUDAS</div>
                <div class="card-body">

                    <p class="card-text">
                        - Exportacion de Codigo en un archivo trapeq <br>
                        D = Esto es exportar todas las ordenes? Que ROL tendria disponible esta opcion (Comprador o Aprobador)
                    </p>

                </div>
            </div>
        </div>
    
    </div>

    <div class="my-5"></div>
  
</div>
 
@stop

@section('scripts')
    @parent
    <script>
     
     
    </script>
@stop
