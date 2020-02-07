<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Services\ZaloraService;

use App\Models\Category;
use App\Models\Brand;

class ScrapeZalora extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:zalora:base';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape contents from Zalora (for education purpose)';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $zalora = new ZaloraService();
        $categories = $zalora->categories(); 
        $this->info(count($categories).' categories obtained.');

        $bar = $this->output->createProgressBar(count($categories));
        $bar->start();

        collect($categories)->each(function ($item) use ($bar) {
            try {
                DB::transaction(function () use ($item, $bar) {
                    $category = new Category();
                    $category->id = $item->id_catalog_category;
                    $category->name = $item->name;
                    $category->save();
                    $bar->setMessage('Saving '.$item->name.'.');
                });
            } catch (\Exception $e) {
                $bar->setMessage($e->getMessage());
            }
            $bar->advance();
        });

        $bar->finish();
        $this->info("\nSaving categories successfully.");

        $brands = $zalora->brands();
        $this->info(count($brands).' brands obtained.');

        $bar = $this->output->createProgressBar(count($categories));
        $bar->start();

        collect($brands)->each(function ($item) use ($bar) {
            try {
                DB::transaction(function () use ($item, $bar) {
                    $brand = new Brand();
                    $brand->id = $item->id_catalog_brand;
                    $brand->name = $item->name;
                    $brand->save();
                    $bar->setMessage('Saving '.$item->name.'.');
                });
            } catch (\Exception $e) {
                $bar->setMessage($e->getMessage());
            }
            $bar->advance();
        });

        $bar->finish();
        $this->info("\nSaving brands successfully.");
    }
}
