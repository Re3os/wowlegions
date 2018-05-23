<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\ItemPrototype;

use \DB;

class ItemController extends Controller
{

    public function tooltip($id) {
        $item = ItemPrototype::where('ID', $id)->limit(1)->get()[0];
        $ssd = DB::connection('mysql')->table('ssd')->where('entry', $item['ScalingStatDistribution'])->get();
        $ssd_level = 110;
        if(isset($_GET['pl'])) {
            $ssd_level = (int) $_GET['pl'];
            if(is_array($ssd) && $ssd_level > $ssd['MaxLevel']) {
                $ssd_level = $ssd['MaxLevel'];
            }
        }
        $ssv = DB::connection('mysql')->table('ssv')->where('level', $ssd_level)->get();
        return view('item.tooltip', ['item' => $item, 'ssd' => $ssd, 'ssv' => $ssv, 'level' => $ssd_level]);
    }
}