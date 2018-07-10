<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Characters;
use App\Account;
use App\Services\Characters as Inventory;
use App\Services\Achievements as Achievements;
use \DB;
class CharactersController extends Controller
{

    public function charactersAchi($characters) {
        $char = Characters::userCharacters($characters);
        $charInfo = Inventory::getCharInfo($characters);
        $info = new Inventory();
        $info->LoadInventory(true);
        $info->CalculateAverageItemLevel();
        Achievements::Initialize($char->guid);
        return view('characters.charactersAchi', ['char' => $char]);
    }

    public function charactersPvp($characters) {
        $char = Characters::userCharacters($characters);
        $charInfo = Inventory::getCharInfo($characters);
        $info = new Inventory();
        $info->LoadInventory(true);
        $info->CalculateAverageItemLevel();
        Achievements::Initialize($char->guid);
        return view('characters.charactersPvp', ['char' => $char]);
    }

    public function list() {
        $char = Account::userGameCharacters(Account::userGameAccount()[0]->id);
        return view('characters.charactersList', ['char' => $char]);
    }

    public function characters($characters) {
        $char = Characters::userCharacters($characters);
        $info = new Inventory();
        $info->LoadInventory($char->guid);
        $info->CalculateAverageItemLevel();
        Achievements::Initialize($char->guid);
        return view('characters.charactersView', ['char' => $char]);
    }

}
