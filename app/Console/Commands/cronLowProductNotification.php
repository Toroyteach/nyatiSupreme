<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use DB;
use App\Models\ProductAttribute;
use App\Events\LowCount;


class cronLowProductNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send low product count notification to admin';

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
        $lowProductItems = null; //$this->getProductDetails();

        //fire the event here
        event(new LowCount($lowProductItems));

    }

    public function getProductDetails()
    {
        $lowProductArrayData = array();


        $productsWithoutAttributes = DB::table("products")->select('id', 'name', 'quantity')->whereNotIn('id',function($query) {

            $query->select('product_id')->from('product_attributes');
         
         })->whereRaw('low_quantity_count > quantity')->get();
         

         $productswithAttributes = ProductAttribute::select('product_id','value','name','product_attributes.quantity')->join('products', 'product_attributes.product_id', '=', 'products.id')->where('low_attribute_quantity_count', '>', 'quantity')->get();
         //dd($productsWithoutAttributes);

         //dd($productsWithoutAttributes->where('low_quantity_count', '>', 'quantity')->toArray());

         //$lowProductArrayData = Arr::only($productsWithoutAttributes->toArray(), 'id');

         array_push($lowProductArrayData, [$productswithAttributes->toArray(), $productsWithoutAttributes->toArray()]);

         //dd($lowProductArrayData);
         $collapsed = Arr::flatten($lowProductArrayData);
         //dd($lowProductArrayData);
         return $lowProductArrayData;
    }
}
