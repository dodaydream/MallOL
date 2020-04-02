<?php
use \koolreport\widgets\koolphp\Table;
?>

<div class="row">
<div class="col">
    <?php
    \koolreport\widgets\google\BarChart::create(array(
        "title"=>"Most sold products",
        "dataSource"=>$this->dataStore("best_sale_products"),
        "columns"=>array(
            "name",
            "purchase"=>array("label"=>"Amount","type"=>"number"),
        ),
    ));
    \koolreport\widgets\koolphp\Table::create([
        "dataSource"=>$this->dataStore("best_sale_products"),
        'columns' => [
            'product_id' => ['type' => 'string', 'label' => 'Product ID'],
            'name' => ['type' => 'string', 'label' => 'Name'],
            'purchase' => ['type' => 'number', 'label' => 'Amount'],
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
            "total"=>array("label"=>"Amount","type"=>"number"),
        ),
    ));
    \koolreport\widgets\koolphp\Table::create([
        "dataSource"=>$this->dataStore("best_profit_products"),
        'columns' => [
            'product_id' => ['type' => 'string', 'label' => 'Product ID'],
            'name' => ['type' => 'string', 'label' => 'Name'],
            'total' => ['type' => 'number', 'label' => 'Amount', 'prefix' => 'MOP$ '],
        ]
    ]);
    ?>
</div>
</div>
