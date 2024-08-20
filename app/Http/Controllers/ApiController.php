<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use Auth;

class ApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        
        $orders = Order::where('user_id', $id)->get(); 
    
        return response()->json([
            'success'=> true,
            'message'=> 'Order',
            'orders'=> $orders  // odrers
        ]);
    }

    public function register(Request $request){
        $this->validate($request,[
            'name'=> 'required',
            'email'=> 'required|email',
            'password'=> 'required'

        ]);
        $user =User::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=>bcrypt ($request->password)
        ]);
        $token = $user->createToken('token')->plainTextToken;
        return response()->json(['token'=> $token],200);
    }

    public function login(Request $request){
        if(!Auth::attempt([
            'email' => $request->email, 
            'password' => $request->password
            ])){
            return response()->json([
                "success"=>false,
                "status"=>401
            ]);

        }
        $user = auth()->user();
        $token = $user->createToken('token')->plainTextToken;

        return response()->json([
                    'user_id' => $user->id,
                    'token'=> $token
                ],200);

    }

    public function getUser() {
        $user = User::all();
        return response()->json([
           'success'=>true,
           'data'=>$user,
           'status'=>200 
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
