<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AddNetwork;

class AddNetworkController extends Controller
{
    public function index()
    {
        $username = auth()->user()->prenom;
        $name = auth()->user()->nom;
        return view('addnetwork', ['username' => $username, 'name' => $name]);
    }

    public function addnetwork(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();

        try {
            $request->image->move(public_path('app/public/images'), $imageName);
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de l\'ajout de l\'image.');
        }
        
        return redirect()->route('network')
            ->with('success', 'Réseau crée avec suucès.');

    }
}