<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $customer = new Customer();
        $customer->name = "John Doe";
        $customer->phone_number = 4556;
        $customer->email = "johndoe123@gmail.com";
        $customer->email_verified_at = now();
        $customer->password = Hash::make('123');
        $customer->remember_token = Str::random(10);
        $customer->save();

        $order = new Order();
        $order->customer_id = $customer->id;
        $order->save();


        $order_detail = new OrderDetail();
        $order_detail->order_id = $order->id;
        $order_detail->product_id = 1;
        $order_detail->category_id = 1;
        $order_detail->quantity = 1;
        $order_detail->product_price = 20000;
        $order_detail->total_amount = 20000;
        $order_detail->save();

        $order_detail = new OrderDetail();
        $order_detail->order_id = $order->id;
        $order_detail->product_id = 2;
        $order_detail->category_id = 2;
        $order_detail->quantity = 2;
        $order_detail->product_price = 3000;
        $order_detail->total_amount = 6000;
        $order_detail->save();
        
    }
}
