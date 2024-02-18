<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderUpdateRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderController extends Controller
{
    public function update(OrderUpdateRequest $request, Order $order = null): JsonResource
    {
        $order = $order ?? Order::create();

        $orderItem = OrderItem::firstOrCreate(['wine_id' => $request->input('wine_id'), 'order_id' => $order->id]);

        if (!$orderItem->wasRecentlyCreated) {
            $orderItem->update(['qty' => $orderItem->qty + 1]);
        }

        return OrderResource::make($order->load('orderItems.wine.wineImages'));
    }

    public function removeUpdate(OrderUpdateRequest $request, Order $order): JsonResource
    {
        $orderItem = OrderItem::where(['wine_id' => $request->input('wine_id'), 'order_id' => $order->id])->first();

        if ($orderItem) {
            if ($orderItem->qty - 1 === 0) {
                $orderItem->delete();
            } else {
                $orderItem->update(['qty' => $orderItem->qty - 1]);
            }
        }

        return OrderResource::make($order->load('orderItems.wine.wineImages'));
    }
}
