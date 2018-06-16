<?php

namespace App\Services;

use Illuminate\Support\Facades\{Cache, DB};
use App\Services\{Races, Classes};

class Item {

    private $entry        = 0;
    private $equipped     = false;
    private $loaded       = false;
    private $m_bag        = 0;
    private $m_count      = 0;
    private $m_guid       = 0;
    private $m_ench       = array();
    private $m_ilvl       = 0;
    private $m_owner      = 0;
    private $m_proto      = null;
    private $m_server     = 0;
    private $m_slot       = 0;
    private $m_socketInfo = array();
    private $m_values     = array();
    private $tc_data      = null;
    private $tc_ench      = null;
    private $bonding      = 0;
    private $itemset_o    = 0;
    private $maxcount     = 0;
    private $itemset      = 0;
    private $itempieces   = null;
    private $bonuses      = array();

    public function GetEntry() {
        return $this->entry;
    }

    public function GetItemSetID() {
        return $this->itemset;
    }

    public function GetOriginalItemSetID() {
        return $this->itemset_o;
    }

    public function GetCurrentDurability() {
        return $this->tc_data->durability;
    }

    public function GetMaxDurability() {
        return $this->tc_data->maxdurability;
    }

    public function GetItemDurability() {
        return array('current' => $this->GetCurrentDurability(), 'max' => $this->GetMaxDurability());
    }

    public function GetGUID() {
        return $this->m_guid;
    }

    public function GetSlot() {
        return $this->m_slot;
    }

    public function GetEnchantmentId() {
        return $this->m_ench;
    }

    public function GetItemLevel() {
        return $this->m_ilvl;
    }

    public function GetBonding() {
        return $this->bonding;
    }

    public function GetMaxCount() {
        return $this->maxcount;
    }

    public function GetRequiredLevel() {
        return $this->requiredlevel;
    }

    public function GetDescription() {
        return $this->description;
    }

    public function LoadFromDB($data, $owner_guid) {
        $this->m_owner = $owner_guid;
        $this->m_guid = $data->item;
        $this->tc_data = DB::connection('characters')->table('item_instance')->where('guid', $this->m_guid)->where('owner_guid', $this->m_owner)->get()[0];
        if(!$this->tc_data) {
            return false;
        }
        $this->entry = $this->tc_data->itemEntry;
        $item_data = DB::connection('mysql')->table('item_prototypes')->where('entry', $this->tc_data->itemEntry)->get();
        $this->tc_data->maxdurability = "";
        $this->m_count = $this->tc_data->count;
        if($data->bag == 0 && $data->slot < '19') {
            $this->equipped = true;
        }
        $this->m_slot = $data->slot;
        $this->m_bag = $data->bag;
        $this->m_socketInfo = array();
        $this->m_ilvl = $item_data[0]->ItemLevel;
        $this->itemset_o = $item_data[0]->ItemSet;
        $this->bonding = $item_data[0]->Bonding;
        $this->maxcount = $item_data[0]->MaxCount;
        $this->requiredlevel = $item_data[0]->RequiredLevel;
        $this->description = $item_data[0]->Description;
        $this->loaded = true;
        return true;
    }

    public function GetSocketInfo($num, $enchant_id_only = false) {
        if($num <= 0 || $num > 4) {
            return 0;
        }
        if(isset($this->m_socketInfo[$num])) {
            return $enchant_id_only ? $this->m_socketInfo[$num]['enchant_id'] : $this->m_socketInfo[$num];
        }
        $data = array();
        $socketfield = array(
            1 => 6,
            2 => 9,
            3 => 12
        );
        $socketInfo = $this->tc_ench[$socketfield[$num]];
        if($socketInfo > 0) {
            if($enchant_id_only) {
                return $socketInfo;
            }
            $gemData = DB::Wow()->selectRow("SELECT `text_%s` AS `text`, `gem` FROM `DBPREFIX_enchantment` WHERE `id`=%d", WoW_Locale::GetLocale(), $socketInfo);
            $data['enchant_id'] = $socketInfo;
            $data['item'] = $gemData['gem'];
            $data['icon'] = Items::GetItemIcon($data['item']);
            $data['enchant'] = $gemData['text'];
            $data['quality'] = DB::World()->selectCell("SELECT `Quality` FROM `item_template` WHERE `entry` = %d", $data['item']);
            $data['name'] = WoW_Items::GetItemName($data['item']);
            $data['color'] = DB::Wow()->selectCell("SELECT `color` FROM `DBPREFIX_gemproperties` WHERE `spellitemenchantement`=%d", $socketInfo);
            $this->m_socketInfo[$num] = $data; // Is it neccessary?
            return $data;
        }
        return false;
    }

    public function GetItemName($entry) {
        $name = DB::connection('mysql')->table('item_prototypes')->where('entry', $entry)->limit(1)->get(['name']);
        return $name[0]->name;
    }

    public function GetItemIcon($entry, $displayid = 0) {
        if($displayid == 0) {
            $displayid = DB::connection('mysql')->table('item_prototypes')->where('entry', $entry)->get(['displayid']);
        }
        if(!$displayid) {
            return false;
        }
        $dat = DB::connection('mysql')->table('icons')->where('id', $displayid)->get(['iconname']);
        if(empty($dat)) {
            return $dat[0]->iconname;
        } else {
            return "inv_shoulder_plate_raidpaladin_s_01";
        }
    }

    public static function AllowableClasses($mask) {
        $classes_data = array();
        $i = 1;
        while($mask & 1) {
            $classes_data[$i] = Classes::$classes[$mask];
            $i++;
        }
        return $classes_data;
    }

    public static function AllowableRaces($mask) {
        $mask &= 0x7FF;
        if($mask == 0x7FF || $mask == 0) {
            return true;
        }
        $races_data = array();
        $i = 1;
        while($mask) {
            if($mask & 1) {
                $races_data[$i] = Races::$races[$mask];
            }
            $mask >>= 1;
            $i++;
        }
        return $races_data;
    }

    public function LoadSsd($data) {
        return DB::connection('mysql')->table('ssd')->where('entry', $data)->get();
    }

    public function LoadSsv($data) {
        return DB::connection('mysql')->table('ssv')->where('level', $data)->get();
    }
}