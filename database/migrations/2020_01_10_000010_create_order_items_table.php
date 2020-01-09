<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderItemsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'order_items';

    /**
     * Run the migrations.
     * @table order_items
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('price', 32, 2)->nullable()->default(null);
            $table->decimal('total_price', 32, 2)->nullable()->default(null);
            $table->bigInteger('qty')->nullable()->default(null);
            $table->unsignedBigInteger('inventory_id');
            $table->unsignedBigInteger('order_id');

            $table->index(["inventory_id"], 'fk_order_items_inventories1_idx');

            $table->index(["order_id"], 'fk_order_items_orders1_idx');


            $table->foreign('inventory_id', 'fk_order_items_inventories1_idx')
                ->references('id')->on('inventories')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('order_id', 'fk_order_items_orders1_idx')
                ->references('id')->on('orders')
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
