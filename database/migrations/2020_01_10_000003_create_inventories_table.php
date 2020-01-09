<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInventoriesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'inventories';

    /**
     * Run the migrations.
     * @table inventories
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->string('product_attr', 45)->nullable()->default(null);
            $table->string('sku', 45)->nullable()->default(null);
            $table->string('qty', 45)->nullable()->default(null);
            $table->string('shelf', 45)->nullable()->default(null);

            $table->index(["product_id"], 'fk_inventory_goods_idx');

            $table->foreign('product_id', 'fk_inventory_goods_idx')
                ->references('id')->on('products')
                ->onDelete('no action')
                ->onUpdate('no action');
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
