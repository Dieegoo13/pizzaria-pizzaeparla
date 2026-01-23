<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'zip_code' => 'required',
            'street' => 'required',
            'number' => 'nullable',
            'neighborhood' => 'required',
            'city' => 'required',
        ]);

        auth()->user()->addresses()->create([
            'zip_code' => $request->zip_code,
            'street' => $request->street,
            'number' => $request->number,
            'neighborhood' => $request->neighborhood,
            'city' => $request->city,
        ]);

        return back()->with('success', 'Endereço adicionado com sucesso ');
    }
}
