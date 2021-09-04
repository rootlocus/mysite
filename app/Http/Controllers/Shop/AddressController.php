<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop\Address;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AddressController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Playground/Shop/Address', [
            'addresses' => Address::query()->get()
        ]);
    }

    public function store(Request $request)
    {
        //add validation
        $address = Address::firstOrNew([
            'user_id' => auth()->user()->id,
            'name' => $request->name,
        ],[
            'contact_name' => $request->contact_name,
            'contact_phone_no' => $request->contact_phone_no,
            'address_line' => $request->address_line,
            'postcode' => $request->postcode,
            'state' => $request->state,
            'country' => $request->country,
            'is_default' => false,
        ]);

        $address->save();

        return redirect()->route('playground.shop.address.index');
    }

}
