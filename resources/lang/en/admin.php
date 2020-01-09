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

    // Do not delete me :) I'm used for auto-generation
];