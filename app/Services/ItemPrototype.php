<?php

namespace App\Services;

use Illuminate\Support\Facades\{Cache, DB};

class ItemPrototype {

    public $entry;
    public $class;
    public $subclass;
    public $unk0;
    public $Name;
    public $displayid;
    public $Quality;
    public $Flags;
    public $Flags2;     // MaNGOS field
    public $FlagsExtra; // Trinity Core field
    public $BuyCount;
    public $BuyPrice;
    public $SellPrice;
    public $InventoryType;
    public $AllowableClass;
    public $AllowableRace;
    public $ItemLevel;
    public $RequiredLevel;
    public $RequiredSkill;
    public $RequiredSkillRank;
    public $requiredspell;
    public $requiredhonorrank;
    public $RequiredCityRank;
    public $RequiredReputationFaction;
    public $RequiredReputationRank;
    public $maxcount;
    public $stackable;
    public $ContainerSlots;
    public $StatsCount;
    public $stat_type1;
    public $stat_value1;
    public $stat_type2;
    public $stat_value2;
    public $stat_type3;
    public $stat_value3;
    public $stat_type4;
    public $stat_value4;
    public $stat_type5;
    public $stat_value5;
    public $stat_type6;
    public $stat_value6;
    public $stat_type7;
    public $stat_value7;
    public $stat_type8;
    public $stat_value8;
    public $stat_type9;
    public $stat_value9;
    public $stat_type10;
    public $stat_value10;
    public $ScalingStatDistribution;
    public $ScalingStatValue;
    public $dmg_min1;
    public $dmg_max1;
    public $dmg_type1;
    public $dmg_min2;
    public $dmg_max2;
    public $dmg_type2;
    public $armor;
    public $holy_res;
    public $fire_res;
    public $nature_res;
    public $frost_res;
    public $shadow_res;
    public $arcane_res;
    public $delay;
    public $ammo_type;
    public $RangedModRange;
    public $spellid_1;
    public $spelltrigger_1;
    public $spellcharges_1;
    public $spellppmRate_1;
    public $spellcooldown_1;
    public $spellcategory_1;
    public $spellcategorycooldown_1;
    public $spellid_2;
    public $spelltrigger_2;
    public $spellcharges_2;
    public $spellppmRate_2;
    public $spellcooldown_2;
    public $spellcategory_2;
    public $spellcategorycooldown_2;
    public $spellid_3;
    public $spelltrigger_3;
    public $spellcharges_3;
    public $spellppmRate_3;
    public $spellcooldown_3;
    public $spellcategory_3;
    public $spellcategorycooldown_3;
    public $spellid_4;
    public $spelltrigger_4;
    public $spellcharges_4;
    public $spellppmRate_4;
    public $spellcooldown_4;
    public $spellcategory_4;
    public $spellcategorycooldown_4;
    public $spellid_5;
    public $spelltrigger_5;
    public $spellcharges_5;
    public $spellppmRate_5;
    public $spellcooldown_5;
    public $spellcategory_5;
    public $spellcategorycooldown_5;
    public $bonding;
    public $description;
    public $PageText;
    public $LanguageID;
    public $PageMaterial;
    public $startquest;
    public $lockid;
    public $Material;
    public $sheath;
    public $RandomProperty;
    public $RandomSuffix;
    public $block;
    public $itemset;
    public $MaxDurability;
    public $area;
    public $Map;
    public $BagFamily;
    public $TotemCategory;
    public $socketColor_1;
    public $socketContent_1;
    public $socketColor_2;
    public $socketContent_2;
    public $socketColor_3;
    public $socketContent_3;
    public $socketBonus;
    public $GemProperties;
    public $RequiredDisenchantSkill;
    public $ArmorDamageModifier;
    public $Duration;
    public $ItemLimitCategory;
    public $HolidayId;
    public $ScriptName;
    public $DisenchantID;
    public $FoodType;
    public $minMoneyLoot;
    public $maxMoneyLoot;
    public $ExtraFlags;

    public $ItemStat = array();
    public $DamageType = array();
    public $Spells = array();
    public $Socket = array();

    public $icon = null;
    public $class_name = null;
    public $subclass_name = null;
    public $InventoryType_name = null;

    private $loaded  = false;
    private $m_guid  = 0;
    private $m_owner = 0;

    public function LoadItem($item_entry, $itemGuid = 0, $ownerGuid = 0) {
        $item_row = DB::connection('mysql')->table('item_prototypes')->where('entry', $item_entry)->get()[0];
        if(!$item_row) {
            return false;
        }
        if(isset($item_row->FlagsExtra)) {
            $item_row->Flags2 = $item_row->FlagsExtra;
            unset($item_row->FlagsExtra);
        }
        foreach($item_row as $field => $value) {
            $this->{$field} = $value;
        }
        for($i = 0; $i < 10+1; $i++) {
            $key = $i+1;
            if(isset($this->{'ItemStatType_' . $key})) {
                $this->ItemStat[$i] = array(
                    'type'  => $this->{'ItemStatType_'  . $key},
                    'value' => $this->{'ItemStatValue_' . $key});
            }
        }
        for($i = 0; $i < 2+1; $i++) {
            $key = $i+1;
            if(isset($this->{'dmg_type' . $key})) {
                $this->DamageType[$i] = array(
                    'type' => $this->{'dmg_type' . $key},
                    'min'  => $this->{'dmg_min'  . $key},
                    'max'  => $this->{'dmg_max'  . $key});
            }
        }
        for($i = 0; $i < 5+1; $i++) {
            $key = $i+1;
            if(isset($this->{'spellid_' . $key})) {
                $this->Spells[$i] = array(
                    'spellid'          => $this->{'spellid_'               . $key},
                    'trigger'          => $this->{'spelltrigger_'          . $key},
                    'charges'          => $this->{'spellcharges_'          . $key},
                    'ppmRate'          => $this->{'spellppmRate_'          . $key},
                    'cooldown'         => $this->{'spellcooldown_'         . $key},
                    'category'         => $this->{'spellcategory_'         . $key},
                    'categorycooldown' => $this->{'spellcategorycooldown_' . $key}
                );
            }
        }
        for($i = 0; $i < 3+1; $i++) {
            $key = $i + 1;
            if(isset($this->{'socketColor_' . $key})) {
                $this->Socket[$i] = array(
                    'color'   => $this->{'socketColor_'   . $key},
                    'content' => $this->{'socketContent_' . $key}
                );
            }
        }
        $iconName = DB::connection('mysql')->table('icons')->where('id', $this->entry)->get(['iconname']);
        if(empty($iconName)) {
            $this->icon = $iconName[0]->iconname;
        } else {
           $this->icon = "inv_shoulder_plate_raidpaladin_s_01";
        }
        $this->m_guid  = $itemGuid;  // Can be NULL.
        $this->m_owner = $ownerGuid; // Can be NULL.
        $this->loaded  = true;
        return true;
    }

    public function IsCorrect() {
        if($this->entry > 0 && $this->loaded == true) {
            return true;
        }
        return false;
    }

    public function getFeralBonus($extraDPS = 0) {
        if($this->class == ITEM_CLASS_WEAPON && (1 << $this->subclass) & 0x02A5F3) {
            $bonus = ($extraDPS + $this->getDPS()*14.0) - 767;
            if($bonus < 0) {
                $bonus = 0;
            }
            return $bonus;
        }
        return 0;
    }

    public static function getMoneyFormat($amount) {
        $money_format['gold'] = floor($amount/(100*100));
        $amount = $amount-$money_format['gold']*100*100;
        $money_format['silver'] = floor($amount/100);
        $amount = $amount-$money_format['silver']*100;
        $money_format['copper'] = floor($amount);
        return $money_format;
    }

    public static function getDPSMod($ssv, $mask) {
        if(!is_array($ssv)) {
            return 0;
        }
        if($mask & 0x7E00) {
            if($mask & 0x00000200) {
                return $ssv['dpsMod_0'];
            }
            if($mask & 0x00000400) {
                return $ssv['dpsMod_1'];
            }
            if($mask & 0x00000800) {
                return $ssv['dpsMod_2'];
            }
            if($mask & 0x00001000) {
                return $ssv['dpsMod_3'];
            }
            if($mask & 0x00002000) {
                return $ssv['dpsMod_4'];
            }
            if($mask & 0x00004000) {
                return $ssv['dpsMod_5'];   // not used?
            }
        }
        return 0;
    }

    public function getDPS() {
        if($this->delay == 0) {
            return 0;
        }
        $temp = 0;
        for($i = 0; $i < MAX_ITEM_PROTO_DAMAGES; $i++) {
            $temp += $this->Damage[$i]['min'] + $this->Damage[$i]['max'];
        }
        return $temp * 500 / $this->delay;
    }

    // Not used now.
    public function GetItemQualityColor() {
        $colors_array = array(
            '#c9c9c9',        //GREY
            '#ffffff',        //WHITE
            '#00FF00',        //GREEN
            '#0070DD',        //BLUE
            '#A335EE',        //PURPLE
            '#ff8000',        //ORANGE
            '#7e7046',        //LIGHT YELLOW
            '#7e7046'         //LIGHT YELLOW
        );
        return (isset($colors_array[$this->Quality])) ? $colors_array[$this->Quality] : $colors_array[1];
    }
}