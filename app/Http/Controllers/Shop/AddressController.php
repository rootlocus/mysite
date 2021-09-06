<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Shop\Address;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AddressController extends Controller
{
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

        return redirect()->route('playground.shop.profile.index');
    }

    public function update(Request $request, Address $address)
    {
        $address->update([
            'name' => $request->name,
            'contact_name' => $request->contact_name,
            'contact_phone_no' => $request->contact_phone_no,
            'address_line' => $request->address_line,
            'postcode' => $request->postcode,
            'state' => $request->state,
            'country' => $request->country,
        ]);

        return redirect()->route('playground.shop.profile.index');
    }

    public function setDefault(Request $request, Address $address)
    {
        Address::query()->update([
            'is_default' => false
        ]);

        $address->update([
            'is_default' => $request->is_default
        ]);

        return redirect()->route('playground.shop.profile.index');
    }

}
