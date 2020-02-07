<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

use App\Services\ZaloraService;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;

class ScrapeZaloraItem extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scrape:zalora:items {--offset=0} {--max=999} {--sleep=10}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Scrape items from Zalora';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    protected $categories;

    protected $brands;

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $offset = $this->option('offset');
        $max = $this->option('max');
        $sleep = $this->option('sleep');

        $bar = $this->output->createProgressBar($max);
        $bar->setMessage('Starting to scrape items...');
        $bar->setFormat("%message% \n\n %current%/%max% [<fg=magenta>%bar%</>] <info>%elapsed%</info>");
        $bar->setBarCharacter('<fg=green>⚬</>');
        $bar->setEmptyBarCharacter("<fg=red>⚬</>");
        $bar->setProgressCharacter("<fg=green>➤</>");
        $bar->start();

        $this->categories = Category::orderBy('id')->pluck('id');
        $this->brands = Brand::orderBy('id')->get();

        for ($i = $offset; $i < $max + $offset; $i += 99) {
            $zalora = new ZaloraService();
            $response = collect($zalora->items($i));
            $response->each(function ($item) use ($bar) {
                $bar->setMessage('Processing '.$item->meta->name.'...');

                try {
                    DB::transaction(function () use ($item, $bar) {
                        $meta = $item->meta;

                        $product = new Product();
                        $product->id = $meta->id_catalog_config;
                        $product->name = $meta->name;
                        $product->spu = $meta->sku;
                        $product->price = str_replace(',', '', $meta->max_price);
                        $product->market_price = str_replace(',', '', $meta->max_price);
                        $product->promote_price = str_replace(',', '', $meta->max_special_price);
                        $product->is_on_sale = true;
                        $product->is_promote = rand(1,100) > 90 ? false : true;
                        $product->description = 'No description available';
                        $product->details = $this->makeDetails($meta);
                        $product->category_id = $this->getCategory($meta->categories);
                        $product->brand_id = $this->getBrand($meta->brand);
                        $product->save();

                        collect($item->available_sizes)->each(function ($item) use ($product) {
                            $shelfLoc = ['A', 'B', 'C', 'D', 'E'];
                            Inventory::create([
                                'product_id' => $product->id,
                                'product_attr' => $item->label,
                                'sku' => $product->spu.'_'.$item->label,
                                'qty' => rand(0, 999),
                                'shelf' => $shelfLoc[rand(0,4)].'-0'.rand(1,9).'-0'.rand(1,5)
                            ]);
                        });

                        $bar->setMessage('Downloading image for '.$item->meta->name.'...');

                        $product->addMediaFromUrl(
                            $this->getRawImg($item->image)
                        )->toMediaCollection('gallery');

                        collect($item->image_extra)->each(function ($item) use ($product) {
                            $product->addMediaFromUrl(
                                $this->getRawImg($item->url)
                            )->toMediaCollection('gallery');
                        });
                    });
                } catch (\Exception $e) {
                    $bar->setMessage('Error adding product '.$item->meta->id_catalog_config.'.');
                }

                $bar->advance();
            });
            $bar->setMessage('Waiting for next page...');
            sleep($sleep);
        }

        $bar->finish();
    }

    private function makeDetails($meta) {
        return '<p><strong><strong>DETAILS</strong></strong></p><p><table class="table"><tbody><tr><td>SKU (simple) <br></td><td>'.$meta->sku.'</td></tr><tr><td>Colour</td><td>'.$meta->color_family.'</td></tr><tr><td>Label</td><td>Machine wash warm<br>Do not tumble dry<br>Iron on low<br>Do not dry clean                                </td></tr></tbody></table><br></p><p><strong><strong>RETURNABLE</strong></strong></p><p>Not 100% satisfied with your item? We offer 30 days free returns, no questions asked.</p>\n\n<p>There are only 4 easy steps to return your item online!</p>\n\n<p>For more information, check out our FAQ <a href="https://www.zalora.com.hk/faq/" target="_blank">HERE</a>.</p><p><br></p><p><strong>DELIVERY INFO<br></strong></p><p>- You can enjoy free shipping on this product if you buy products up to HKD$200 per seller. \n<br>*For details, please refer to our <a href="http://support.zalora.com.hk/hc/en-us/articles/209452398-SHIPPING-FEE">FAQ</a>\n</p>\n<p>- Items are shipped directly from the supplier and will be delivered separately.</p> \n<p>- Please take note that the delivery lead time is between 3 - 5 working days from the date that the order is made.</p>';
    }

    private function getCategory($categories) {
        return $this->categories->intersect(explode('|', $categories))->first();
    }

    private function getBrand($brand) {
        return $this->brands->firstWhere('name', $brand)->id;
    }

    private function getRawImg($url) {
        return substr($url, strpos($url, "http://"));
    }
}
