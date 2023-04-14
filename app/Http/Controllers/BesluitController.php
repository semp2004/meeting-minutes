<?php

namespace App\Http\Controllers;

use App\Models\Besluit;
use Illuminate\Http\Request;

class BesluitController extends Controller
{
    public function view($id)
    {
        return view('besluiten.Besluit',[
            'id' => $id
        ]);
    }

    public function store(Request $request, $id)
    {
        $data = $request -> validate([
            'besluit' => 'required|string|max:600',
        ]);

        $besluit = $data['besluit'];

        $NewBesluit = new Besluit();
        $NewBesluit->besluit = $besluit;
        $NewBesluit->agenda_item_id = $id;
        $NewBesluit->save();

        return redirect(route('dashboard'));
    }

    public function besluiten() {
        $Besluiten = Besluit::all();

        return view('besluiten.Besluiten', [
            'besluiten' => $Besluiten
        ]);
    }
}
