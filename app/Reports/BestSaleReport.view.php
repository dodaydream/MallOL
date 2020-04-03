<?php
use \koolreport\widgets\koolphp\Table;
?>

<div class="row">
    <div class="col">
        <?php
    \koolreport\widgets\google\LineChart::create(array(
        "title"=>"Sales trend",
        "dataSource"=>$this->dataStore("daily_sales_trend"),
        "columns"=>array(
            "date" => [ 'label' => 'Date', 'type' => 'date'],
            "total"=>array("label"=>"Sales","type"=>"number", 'prefix' => 'MOP$ '),
        ),
    ));?>
    </div>
</div>
<div class="row">
<div class="col">
    <?php
    \koolreport\widgets\google\BarChart::create(array(
        "title"=>"Most sold products",
        "dataSource"=>$this->dataStore("best_sale_products"),
        "columns"=>array(
            "name",
            "purchase"=>array("label"=>"Qty","type"=>"number"),
        ),
    ));
    \koolreport\widgets\koolphp\Table::create([
        "dataSource"=>$this->dataStore("best_sale_products"),
        'columns' => [
            'product_id' => ['type' => 'string', 'label' => 'Product ID'],
            'name' => ['type' => 'string', 'label' => 'Name'],
            'purchase' => ['type' => 'number', 'label' => 'Qty'],
        ]
    ]);
    ?>
</div>
    <div class="col">
    <?php
    \koolreport\widgets\google\BarChart::create(array(
        "title"=>"Most profit products",
        "dataSource"=>$this->dataStore("best_profit_products"),
        "columns"=>array(
            "name",
            "total"=>array("label"=>"Sales","type"=>"number"),
        ),
    ));
    \koolreport\widgets\koolphp\Table::create([
        "dataSource"=>$this->dataStore("best_profit_products"),
        'columns' => [
            'product_id' => ['type' => 'string', 'label' => 'Product ID'],
            'name' => ['type' => 'string', 'label' => 'Name'],
            'total' => ['type' => 'number', 'label' => 'Sales', 'prefix' => 'MOP$ '],
        ]
    ]);
    ?>
</div>
</div>
