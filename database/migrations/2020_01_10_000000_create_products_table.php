<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'products';

    /**
     * Run the migrations.
     * @table products
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 45);
            $table->string('spu', 45);
            $table->decimal('price', 32, 2);
            $table->decimal('market_price', 32, 2)->nullable();
            $table->decimal('promote_price', 32, 2)->nullable();
            $table->unsignedTinyInteger('is_on_sale');
            $table->unsignedTinyInteger('is_promote')->nullable();
            $table->string('description')->nullable();
            $table->text('details')->nullable();
            $table->timestamps();

            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('brand_id')->nullable();

            $table->index(["brand_id"], 'fk_products_brands1_idx');

            $table->index(["category_id"], 'fk_products_categories1_idx');

            $table->foreign('category_id', 'fk_products_categories1_idx')
                ->references('id')->on('categories')
                ->onDelete(DB::raw('set null'))
                ->onUpdate('cascade');

            $table->foreign('brand_id', 'fk_products_brands1_idx')
                ->references('id')->on('brands')
                ->onDelete(DB::raw('set null'))
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->set_schema_table);
     }
}
