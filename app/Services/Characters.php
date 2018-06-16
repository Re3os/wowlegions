<?php

namespace App\Services;

use Illuminate\Support\Facades\{Cache, DB};

use App\Services\Item;

class Characters {

    private static $guid           = 0;
    private static $level          = 0;
    private static $item_level     = array();
    private static $result_characters_data = [];
    private static $resultGamesList = [];
    private static $characters_loaded = false;
    private static $active_character = array();
    private static $m_items        = array();

    public static function getCharInfo($userName) {
        $Result = DB::connection('characters')->table('characters')->where('name', $userName)->get();
        if(!empty($Result)) {
            self::$guid = $Result[0]->guid;
        } else return 0;
    }

    public static function GetAverageItemLevel() {
        return array('avg' => self::GetAVGItemLevel(), 'avgEquipped' => self::GetAVGEquippedItemLevel());
    }

    public static function GetAVGItemLevel() {
        return self::$item_level['avg'];
    }

    public static function GetAVGEquippedItemLevel() {
        return self::$item_level['avgEquipped'];
    }

    public static function GetLevel() {
        return self::$level;
    }

    public static function GetItem($slot) {
        return isset(self::$m_items[$slot]) ? self::$m_items[$slot] : null;
    }

    public static function CalculateAverageItemLevel() {
        if(!self::IsInventoryLoaded()) {
            if(!self::LoadInventory(true)) {
                self::$item_level = array('avgEquipped' => 0, 'avg' => 0);
                return true;
            }
        }
        $total_iLvl = 0;
        $maxLvl = 0;
        $minLvl = 500;
        $i = 0;
        self::$item_level = array('avgEquipped' => 0, 'avg' => 0);
        foreach(self::$m_items as $item) {
            if(!in_array($item->GetSlot(), array(3, 18))) {
                if($item->GetItemLevel() > 0) {
                    $total_iLvl += $item->GetItemLevel();
                    if($item->GetItemLevel() < $minLvl) {
                        $minLvl = $item->GetItemLevel();
                    }
                    if($item->GetItemLevel() > $maxLvl) {
                        $maxLvl = $item->GetItemLevel();
                    }
                    $i++;
                }
            }
        }
        if($i == 0) {
            return true;
        }
        self::$item_level['avgEquipped'] = round(($maxLvl + $minLvl) / 2);
        self::$item_level['avg'] = round($total_iLvl / $i);
        return true;
    }

    public static function LoadInventory($reload = false) {
        if(self::IsInventoryLoaded() && !$reload) {
            return true;
        }
        $inv = DB::connection('characters')
            ->table('character_inventory')
            ->where('bag', '=', 0)
            ->where('slot', '<', 19)
            ->where('guid', self::$guid)
            ->get(['item', 'slot', 'bag'])
        ;
        foreach($inv as $item) {
            self::$m_items[$item->slot] = new Item();
            self::$m_items[$item->slot]->LoadFromDB($item, self::$guid);
        }
        return true;
    }

    private static function IsInventoryLoaded() {
        return is_array(self::$m_items);
    }

    public static function GetEquippedItemInfo($slot) {
        $item = self::GetItem($slot);

        if(!$item) {
            return false;
        }
        $item_data = DB::connection('mysql')->table('item_prototypes')->where('entry', $item->GetEntry())->get()[0];
        $info = $item_data;

        if(!$info) {
            return false;
        }
        $item_data = array(
            'item_id'    => $item->GetEntry(),
            'name'       => $item->GetItemName($item->GetEntry()),
            'guid'       => $item->GetGUID(),
            'quality'    => $info->Quality,
            'item_level' => $item->GetItemLevel(),
            'bonding'    => $item->GetBonding(),
            'maxcount'   => $item->GetMaxCount(),
            'requiredlevel'   => $item->GetRequiredLevel(),
            'description'   => $item->GetDescription(),
            'icon'       => $item->GetItemIcon(0, $info->entry),
            'slot_id'    => $item->GetSlot(),
            'enchid'     => $item->GetEnchantmentId(),
            'g0'         => $item->GetSocketInfo(1),
            'g1'         => $item->GetSocketInfo(2),
            'g2'         => $item->GetSocketInfo(3),
            'can_ench'   => !in_array($item->GetSlot(), array(3, 17, 18, 12, 13, 1, 16, 10, 11, 1, 5))
        );
        // Itemset check
        $itemset_original = $item->GetOriginalItemSetID();
        $itemset_changed = $item->GetItemSetID();
        $itemsetID = 0;
        $pieces_string = null;
        if($itemset_original > 0) {
            $itemsetID = $itemset_original;
        }
        if($itemset_changed > 0) {
            $itemsetID = $itemset_changed;
        }
        /* if($itemsetID > 0) {
            $pieces = $item->GetItemSetPieces();
            $setpieces = explode(',', $pieces);
            if(isset($setpieces[1])) {
                $prev = false;
                foreach($setpieces as $piece) {
                    if(self::IsItemEquipped($piece)) {
                        if($prev) {
                            $pieces_string .= ',';
                        }
                        $pieces_string .= $piece;
                        $prev = true;
                    }
                }
            }
        } */
        return $item_data;
    }

}