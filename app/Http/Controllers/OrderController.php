<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Notifications\NewOrderNotification;
use Illuminate\Support\Facades\Notification;
use App\Events\CreateOrder;
//use App\Http\Controllers\CreateOrder;
use App\Mail\BasicEmail;
use Illuminate\Support\Facades\Mail;
use Validator;



 


class OrderController extends Controller
{
    
    //for api show orders
    public function index()
    {
        $userId = auth()->user()->id; 
        $orders = Order::where('user_id', $userId)->get(); 
    
        return response()->json([
            'success'=> true,
            'message'=> 'Order',
            'orders'=> $orders  // odrers
        ]);
    }

    //for Api
    public function storeOrderApi(Request $request)
    {
        $userId = auth()->user()->id; 
        
        $input = $request->all();
        $validator =Validator::make($input,[
           'location' => 'required|string|max:255',
            'size' => 'required|string|max:255',
            'weight' => 'required|numeric',
            'pickup_time' => 'nullable|date',
            'delivery_time' => 'nullable|date',
        ]);
        $input['status'] = $input['status'] ?? 'pending';
        $input['user_id'] = $userId;

        if($validator->fails()){
            return response()->json([
                'fail'=> false,
                'message'=> 'Sorry not stored',
                'error'=> $validator->errors()
            ]);
        }

        //sotre order
        $orders = Order::create($input);
    
        return response()->json([
            'success'=> true,
            'message'=> 'Order created successfully',
            'odrers'=> $orders
        ]);
    }
    
    
    
    
    public function create()
    {
        return view('user.create');
    }

    public function showOrders($id)
    {

        $userId = auth()->id();

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
            ->where('orders.user_id', $userId)  
            ->get();


 
      return view('User.order', ['orders' => $orders]);
    }

public function store(Request $request)
    {
        $request->validate([
            'location' => 'required|string|max:255',
            'size' => 'required|string|max:255',
            'weight' => 'required|numeric',
            'pickup_time' => 'nullable|date',
            'delivery_time' => 'nullable|date',
        ]);

        $order = new Order($request->all());
        $order->user_id = auth()->id();
        $order->save();

        Mail::to("fahdnahralharbi@gmail.com")->send(new BasicEmail("Fahad"));
        

        return redirect()->route('user.orders', ['id' => $order->id]);

       

       


         
    }    
}