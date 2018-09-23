<?php

return [

    'uri' => 'business',
    'single' => 'Pedido',
    'plural' => 'Pedidos',
    'title' => [
        'preorder' => 'Pedidos',
        'create preorder' => 'Crear Pedido',
        'payment_methods'=>'Métodos de pago',
        'billing_address'=>'Dirección de envío',
        'shipping_address'=>'Dirección de facturación'
    ],

    'table' => [
        'see' => 'Ver',
        'firstname' => 'Nombre',
        'lastname' => 'Apellido',
        'comment' =>'Comment',
        'total'=>'Total',
        'payment_methods'=>'Payment methods',
        'status'=>'Estado'
    ],

    'buttons'=>[
        'create preorder' => 'Crear Pedido',
        'add_to_order'=>'Agregar al pedido',
        'generate_preorder'=>'Generar Pedido',
        'update_preorder'=>'Actualizar Pedido',
        'save'=> 'Guardar',
        'see' => 'Ver',
        'pay' => 'Pagar',
        'back' => 'Volver',
        'rows'=>'Registros',
        'search'=>'Buscar',
        'page' => 'Página',
        'showing'=>'Mostrando',
        'records of'=>'Registros de',
        'edit' => 'Editar'

    ],

    'form' => [
      'total_preorder'=>'Total del Pedido'

    ],
    'messages' => [
      'update preorder success' => 'Pedido actualizado satisfactoriamente.'

    ],
    'validation' => [
      'business_no_products'=>'Esta empresa no tiene productos asociados',
      'product_already_order_list'=>'Este producto ya se encuentra agregado a la lista de orden',
      'not_rol_approver'=>'Esta empresa no posee usuarios con rol aprobador creados',
      'orders_product_exceed_limit' => 'Se ha eliminado el ultimo producto de la orden, por superar el presupuesto',
      'payment_method_required'=>'Debes seleccionar un método de pago'
    ],

];
