<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use App\Models\Product;
use App\Models\ProductAttribute;

class cronLowProductNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send low product count notification cron';

    public $productArrayData = [];

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
     * @return int
     */
    public function handle()
    {
        $this->init();
        return 0;
    }

    /**
     * Method initialized called in handle method
     * 
     *  */
    public function init()
    {
        $dataItems = $this->getProductDetails();

        $filtered = Arr::where($dataItems, function ($value, $key) {
            return is_string($value);
        });
    }

    public function getProductDetails()
    {
        $products = Product::all();
        //$productArrayData = [];

        foreach ($products as $product)
         {
            $this->productArrayData[] = $product->only(['name', 'quantity']);
         }

         dd($this->productArrayData);

         return $this->productArrayData;
    }
}
