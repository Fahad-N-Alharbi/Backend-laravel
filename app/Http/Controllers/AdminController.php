<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function showOrders()
    {
        // جلب جميع الطلبات من قاعدة البيانات
       // $orders = Order::all();

       $userId = auth()->id();
        
        // كتابة استعلام للانضمام بين الجدولين مع إضافة شرط على user_id
        $orders = DB::table('orders')
            ->join('users', 'orders.user_id', '=', 'users.id')
            ->select(
                'orders.id as order_id',
                'orders.location',
                'orders.size',
                'orders.weight',
                'orders.pickup_time',
                'orders.delivery_time',
                'orders.status',
                'users.name as user_name',
                'users.email as user_email'
            )
           
            ->get();

 
        return view('admin.orders', compact('orders'));
    }

    public function updateOrder(Request $request, Order $order)
    {
        // تحديث حالة الطلب
        $order->status = $request->input('status');
        $order->save();

        return redirect()->back()->with('success', 'تم تحديث حالة الطلب بنجاح');
    }
}
