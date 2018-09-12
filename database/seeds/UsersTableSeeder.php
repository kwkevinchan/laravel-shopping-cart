<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Product;
use App\Models\ProductClass;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()['cache']->forget('spatie.permission.cache');

        $product_class = ProductClass::get();

        // create permissions
        //管理者
        Permission::create(['name' => '商品類別']);

        //使用者
        Permission::create(['name' => '使用者_檢視']);
        Permission::create(['name' => '使用者_修改']);
        Permission::create(['name' => '使用者_新增']);
        Permission::create(['name' => '使用者_刪除']);

        //店家
        Permission::create(['name' => '商品']);

        //買方
        Permission::create(['name' => '購物車']);


        $role_admin = Role::create(['name' => '管理員']);
        $role_admin->givePermissionTo(Permission::all());

        $role_store = Role::create(['name' => '店家']);
        $role_store->givePermissionTo([
            '商品'
        ]);

        $admin_users = [
            'kevin',
            'admin1',
            'admin2',
            'admin3',
            'admin4',
        ];
        
        foreach($admin_users as $user){
            $admin_create = User::create([
                'name' => $user,
                'email' => 'bombbomb.chickenbomb@gmail.com',
                'password' => bcrypt('123456'),
            ]);
            $admin_create->assignRole($role_admin);
            for($i=0; $i<5; $i++){
                Product::create([
                    'user_id' => $admin_create->id,
                    'productclass_id' => $product_class[rand(0, 8)]->id,
                    'name' => $admin_create->name . '商品' . $i,
                    'price' => 100,
                    'volume' => 10,
                ]);
            }
        }

        for($i=1;$i<11;$i++){
            $store_create = User::create([
                'name' => 'store'. $i,
                'email' => 'bombbomb.chickenbomb@gmail.com',
                'password' => bcrypt('123456'),
            ]);
            $store_create->assignRole($role_store);
            for($a=0; $a<5; $a++){
                Product::create([
                    'user_id' => $store_create->id,
                    'productclass_id' => $product_class[rand(0, 8)]->id,
                    'name' => $store_create->name . '商品' . $a,
                    'price' => 100,
                    'volume' => 10,
                ]);
            }
        }

        for($i=1;$i<21;$i++){
            $user_create = User::create([
                'name' => 'user'. $i,
                'email' => 'bombbomb.chickenbomb@gmail.com',
                'password' => bcrypt('123456'),
            ]);
        }

    }
}
