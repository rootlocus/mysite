<?php

namespace App\Actions\Shop;

use App\Models\Shop\CartItem;
use Lorisleiva\Actions\Concerns\AsAction;

class UpdateCartQuantity
{
    use AsAction;

    public function handle($data)
    {
        $data = collect($data);
        
        $item = CartItem::firstOrNew([
            'cart_id' => $data->get('cart_id'),
            'product_id' => $data->get('product_id'),
        ],
        [
            'price' => $data->get('price'),
            'quantity' => 0,
        ]);
        
        $item->save();

        $quantity = $data->get('quantity') ?? ($data->get('type') == 'add' ? $item->quantity + 1 : $item->quantity - 1);

        $quantity <= 0 ? $item->delete() : $item->update(['quantity' => $quantity]);
    }

}