<?php

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Brackets\AdminAuth\Models\AdminUser::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'password' => bcrypt($faker->password),
        'remember_token' => null,
        'activated' => true,
        'forbidden' => $faker->boolean(),
        'language' => 'en',
        'deleted_at' => null,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
    ];
});/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Product::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'spu' => $faker->sentence,
        'price' => $faker->randomNumber(5),
        'market_price' => $faker->randomNumber(5),
        'promote_price' => $faker->randomNumber(5),
        'is_on_sale' => $faker->boolean(),
        'is_promote' => $faker->boolean(),
        'description' => $faker->sentence,
        'details' => $faker->text(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        'category_id' => $faker->sentence,
        'brand_id' => $faker->sentence,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Category::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Brand::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Inventory::class, static function (Faker\Generator $faker) {
    return [
        'product_id' => $faker->sentence,
        'product_attr' => $faker->sentence,
        'sku' => $faker->sentence,
        'qty' => $faker->sentence,
        'shelf' => $faker->sentence,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Cart::class, static function (Faker\Generator $faker) {
    return [
        'sku' => $faker->sentence,
        'inventory_id' => $faker->sentence,
        'user_id' => $faker->sentence,
        'qty' => $faker->sentence,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, static function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'email' => $faker->email,
        'password' => bcrypt($faker->password),
        'remember_token' => null,
        'activated' => $faker->boolean(),
        'forbidden' => $faker->boolean(),
        'language' => $faker->sentence,
        'deleted_at' => null,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Order::class, static function (Faker\Generator $faker) {
    return [
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\OrderItem::class, static function (Faker\Generator $faker) {
    return [
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Orderitem::class, static function (Faker\Generator $faker) {
    return [
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Order::class, static function (Faker\Generator $faker) {
    return [
        'po_number' => $faker->sentence,
        'created_at' => $faker->dateTime,
        'completed_at' => $faker->sentence,
        'total_price' => $faker->randomNumber(5),
        'user_id' => $faker->sentence,
        
        
    ];
});
/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\OrderItem::class, static function (Faker\Generator $faker) {
    return [
        'price' => $faker->randomNumber(5),
        'total_price' => $faker->randomNumber(5),
        'qty' => $faker->sentence,
        'inventory_id' => $faker->sentence,
        'order_id' => $faker->sentence,
        
        
    ];
});
