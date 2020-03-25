<?php

return [
    'admin-user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
            'edit_profile' => 'Edit Profile',
            'edit_password' => 'Edit Password',
        ],

        'columns' => [
            'id' => 'ID',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'email' => 'Email',
            'password' => 'Password',
            'password_repeat' => 'Password Confirmation',
            'activated' => 'Activated',
            'forbidden' => 'Forbidden',
            'language' => 'Language',
                
            //Belongs to many relations
            'roles' => 'Roles',
                
        ],
    ],

    'product' => [
        'title' => 'Products',

        'actions' => [
            'index' => 'Products',
            'create' => 'New Product',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'spu' => 'Spu',
            'price' => 'Price',
            'market_price' => 'Market price',
            'promote_price' => 'Promote price',
            'is_on_sale' => 'Is on sale',
            'is_promote' => 'Is promote',
            'description' => 'Description',
            'details' => 'Details',
            'category_id' => 'Category',
            'brand_id' => 'Brand',
            
        ],
    ],

    'category' => [
        'title' => 'Categories',

        'actions' => [
            'index' => 'Categories',
            'create' => 'New Category',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            
        ],
    ],

    'brand' => [
        'title' => 'Brands',

        'actions' => [
            'index' => 'Brands',
            'create' => 'New Brand',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            
        ],
    ],

    'inventory' => [
        'title' => 'Inventories',

        'actions' => [
            'index' => 'Inventories',
            'create' => 'New Inventory',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'product_id' => 'Product',
            'product_attr' => 'Product attr',
            'sku' => 'Sku',
            'qty' => 'Qty',
            'shelf' => 'Shelf',
            
        ],
    ],

    'cart' => [
        'title' => 'Carts',

        'actions' => [
            'index' => 'Carts',
            'create' => 'New Cart',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'sku' => 'Sku',
            'inventory_id' => 'Inventory',
            'user_id' => 'User',
            'qty' => 'Qty',
            
        ],
    ],

    'user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'activated' => 'Activated',
            'forbidden' => 'Forbidden',
            'language' => 'Language',
            
        ],
    ],

    'order' => [
        'title' => 'Order',

        'actions' => [
            'index' => 'Order',
            'create' => 'New Order',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            
        ],
    ],

    'order-item' => [
        'title' => 'Orderitems',

        'actions' => [
            'index' => 'Orderitems',
            'create' => 'New Orderitem',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            
        ],
    ],

    'orderitem' => [
        'title' => 'Orderitem',

        'actions' => [
            'index' => 'Orderitem',
            'create' => 'New Orderitem',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            
        ],
    ],

    'order-item' => [
        'title' => 'Order Item',

        'actions' => [
            'index' => 'Order Item',
            'create' => 'New Order Item',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            
        ],
    ],

    'order' => [
        'title' => 'Orders',

        'actions' => [
            'index' => 'Orders',
            'create' => 'New Order',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'po_number' => 'Po number',
            'completed_at' => 'Completed at',
            'total_price' => 'Total price',
            'user_id' => 'User',
            
        ],
    ],

    'order-item' => [
        'title' => 'Order Items',

        'actions' => [
            'index' => 'Order Items',
            'create' => 'New Order Item',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => 'ID',
            'price' => 'Price',
            'total_price' => 'Total price',
            'qty' => 'Qty',
            'inventory_id' => 'Inventory',
            'order_id' => 'Order',
            
        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];