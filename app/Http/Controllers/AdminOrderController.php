<?php

namespace App\Http\Controllers;

use App\Order;
use App\Orders_detail;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AdminOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::orderBy('id', 'desc')->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function detail($id){
        $orders = Orders_detail::where('orders_id', $id)->get();
        return view('admin.orders.details', compact('orders'));
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\AdminOrder  $adminOrder
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\AdminOrder  $adminOrder
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $order = Order::find($id);
        return view('admin.orders.update', compact('order'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\AdminOrder  $adminOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $order = Order::find($id);
        $order->update($request->all());
        foreach($order->orders_detail as $item){
            $item->update($request->all());
        }
        if($request->get('status') == "Đang giao hàng") {
            $data = ['order' => $order];
            Mail::send('emails.shipping', $data, function ($message) use ($order) {
                $message->to($order->email)->subject('[Sachngoaivan.com] Đơn hàng của bạn đang được giao');
            });
        }
        //$order->orders_detail->update($request->all());
        //foreach($order as $order->)
        return redirect('/admin/order');
        //$order = $order_detail->
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\AdminOrder  $adminOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::find($id);
        foreach($order->orders_detail as $item){
            $product = Product::find($item->products_id);
            $product->update(['quantity' => $product->quantity + $item->quantity]);
        }
        $order->delete();
        return redirect('/admin/order');
    }
}
