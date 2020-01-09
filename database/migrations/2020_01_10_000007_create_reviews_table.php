<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'reviews';

    /**
     * Run the migrations.
     * @table reviews
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('inventory_id');
            $table->decimal('rating', 1, 1);
            $table->mediumText('comments')->nullable()->default(null);
            $table->unsignedBigInteger('user_id');

            $table->index(["inventory_id"], 'fk_reviews_inventories1_idx');

            $table->index(["user_id"], 'fk_reviews_users1_idx');

            $table->index(["product_id"], 'fk_reviews_product1_idx');


            $table->foreign('product_id', 'fk_reviews_product1_idx')
                ->references('id')->on('products')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('inventory_id', 'fk_reviews_inventories1_idx')
                ->references('id')->on('inventories')
                ->onDelete('no action')
                ->onUpdate('no action');

            $table->foreign('user_id', 'fk_reviews_users1_idx')
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
