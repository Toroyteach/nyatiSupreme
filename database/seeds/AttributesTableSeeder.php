<?php

use App\Models\Attribute;
use Illuminate\Database\Seeder;

class AttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create a size attribute
        Attribute::create([
            'code'          =>  'size',
            'name'          =>  'Size',
            'frontend_type' =>  'select',
            'is_filterable' =>  1,
            'is_required'   =>  1,
        ]);

    }
}