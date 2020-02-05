<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'carts';

    /**
     * Run the migrations.
     * @table carts
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('sku', 45)->nullable()->default(null);
            $table->unsignedBigInteger('inventory_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('qty')->default(1);

            $table->index(["user_id"], 'fk_carts_users1_idx');

            $table->index(["inventory_id"], 'fk_carts_inventory1_idx');

            $table->foreign('inventory_id', 'fk_carts_inventory1_idx')
                ->references('id')->on('inventories')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('user_id', 'fk_carts_users1_idx')
                ->references('id')->on('users')
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
