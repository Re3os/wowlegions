<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Characters;

class CharactersController extends Controller
{

    public function characters($characters) {
        $char = Characters::where('name', $characters)->firstOrFail();
        return view('characters.charactersView', ['char' => $char]);
    }

}
