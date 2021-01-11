<?php
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run()
    {
        $permissions = [
            'category-list',
            'category-create',
            'category-edit',
            'category-delete',
            'product-list',
            'product-create',
            'product-edit',
            'product-delete',
            'attribute-list',
            'attribute-create',
            'attribute-edit',
            'attribute-delete',
            'orders-list',
            'orders-show',
            'orders-edit',
            'feedback-show',
            'feedback-edit',
            'feedback-list',
            'notifications-list',
            'settings-edit',
            'settings-profile',
            'users-list',
            'users-create',
            'users-edit',
            'users-delete',
            ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
