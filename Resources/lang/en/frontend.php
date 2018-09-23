<?php

return [

    'uri' => 'business',
    'single' => 'Pre-Order',
    'plural' => 'Pre-Orders',
    'title' => [
        'preorder' => 'Pre-Orders',
        'create preorder' => 'Create Pre-Order',
        'approvers' => 'Approvers',
        'billing_address'=>'Billing address',
        'shipping_address'=>'Shipping address',
        'approversCheck' => 'Save Order Status'
    ],

    'table' => [
        'firstname' => 'Firstname',
        'lastname' => 'Lastname',
        'created_at' => 'Created At',
        'updated_at' => 'Updated At',
        'comment' =>'Comment',
        'total'=>'Total',
        'payment_methods'=>'Payment methods',
        'status'=>'Status',
        'page' => 'Page',
        'showing'=>'Showing',
        'records of'=>'Records of'


    ],

    'buttons'=>[
        'create preorder' => 'Create PreOrder',
        'see' => 'See',
        'pay' => 'Pay',
        'back' => 'Back',
        'add_to_order'=>'Add to order',
        'generate_preorder'=>'Generate Pre-order',
        'update_preorder'=>'Update Pre-order',
        'save'=> 'Save',
        'rows'=>'Rows',
        'search'=>'Search',
        'edit' => 'Edit'


    ],
    'status' => [
        'approved' => 'Approved'
    ],
    'form' => [
      'total_preorder'=>'Total of the PreOrder'
    ],
    'messages' => [
      'update preorder success' => 'Pre-order successfully updated'
      
    ],
    'validation' => [
      'business_no_products'=>'This company has no associated products',
      'product_already_order_list'=>'This product is already added to the order list',
      'not_rol_approver'=>'This company does not have users with role approved approver',
      'orders_product_exceed_limit' => 'The last product of the order has been eliminated, for exceeding the budget',
      'payment_method_required'=>'You must select a payment method'

    ],

];
