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

    public static function LoadInventory($guid) {
        $inv = DB::connection('characters')->select('SELECT ii.guid, ii.itemEntry, ii.creatorGuid, ii.giftCreatorGuid, ii.count, ii.duration, ii.charges, ii.flags, ii.enchantments, ii.randomPropertyType, ii.randomPropertyId, ii.durability, ii.playedTime, ii.text, ii.upgradeId, ii.battlePetSpeciesId, ii.battlePetBreedData, ii.battlePetLevel, ii.battlePetDisplayId, ii.context, ii.bonusListIDs, iit.itemModifiedAppearanceAllSpecs, iit.itemModifiedAppearanceSpec1, iit.itemModifiedAppearanceSpec2, iit.itemModifiedAppearanceSpec3, iit.itemModifiedAppearanceSpec4, iit.spellItemEnchantmentAllSpecs, iit.spellItemEnchantmentSpec1, iit.spellItemEnchantmentSpec2, iit.spellItemEnchantmentSpec3, iit.spellItemEnchantmentSpec4, ig.gemItemId1, ig.gemBonuses1, ig.gemContext1, ig.gemScalingLevel1, ig.gemItemId2, ig.gemBonuses2, ig.gemContext2, ig.gemScalingLevel2, ig.gemItemId3, ig.gemBonuses3, ig.gemContext3, ig.gemScalingLevel3, im.fixedScalingLevel, im.artifactKnowledgeLevel, bag, slot FROM character_inventory ci JOIN item_instance ii ON ci.item = ii.guid LEFT JOIN item_instance_gems ig ON ii.guid = ig.itemGuid LEFT JOIN item_instance_transmog iit ON ii.guid = iit.itemGuid LEFT JOIN item_instance_modifiers im ON ii.guid = im.itemGuid WHERE ci.bag = 0 AND ci.slot < 19 AND ci.guid = ?  ORDER BY (ii.flags & 0x80000) ASC, bag ASC, slot ASC', [$guid]);
        foreach($inv as $item) {
            self::$m_items[$item->slot] = $item;
            self::$m_items[$item->slot] = new Item();
            self::$m_items[$item->slot]->LoadFromDB($item);
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
        $item_data = DB::connection('mysql')->table('item_prototypes')->where('entry', $item->GetEntry())->get();
        $info = $item_data;
        
        if(!$info) {
            return false;
        }
        $item_data = array(
            'item_id'           => $item->GetEntry(),
            'name'              => $item->GetItemName($item->GetEntry()),
            'guid'              => $item->GetGUID(),
            'quality'           => $item->QualityItem(),
            'item_level'        => $item->GetItemLevel(),
            'bonding'           => $item->GetBonding(),
            'maxcount'          => $item->GetMaxCount(),
            'requiredlevel'     => $item->GetRequiredLevel(),
            'description'       => $item->GetDescription(),
            'icon'              => $item->GetItemIcon(0, $item->GetEntry()),
            'slot_id'           => $item->GetSlot(),
            'enchid'            => $item->GetEnchantmentId(),
            'g0'                => $item->GetSocketInfo(1),
            'g1'                => $item->GetSocketInfo(2),
            'g2'                => $item->GetSocketInfo(3),
            'can_ench'          => !in_array($item->GetSlot(), array(3, 17, 18, 12, 13, 1, 16, 10, 11, 1, 5))
        );

        return $item_data;
    }

}