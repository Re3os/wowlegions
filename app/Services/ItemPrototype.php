<?php

namespace App\Services;

use Illuminate\Support\Facades\{Cache, DB};

class ItemPrototype {

    public $Flags;


    public function LoadItem($item_entry, $itemGuid = 0, $ownerGuid = 0) {
        $item_row = DB::connection('mysql')->table('item_prototypes')->where('entry', $item_entry)->get()[0];
        if(!$item_row) {
            return false;
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
        $this->icon = $iconName[0]->iconname ?? 'no_item';  

        $this->sub = DB::connection('mysql')->table('item_subclass')->where('ID', $this->entry)->get()[0];
        $itemsublcass = DB::connection('mysql')
        ->table('item_subclass_name')
        ->where('subclass', $this->sub->SubClass)
        ->where('class', $this->sub->Class)
        ->get()[0];
        $this->subclass_name = $itemsublcass->subclass_name;
        $this->class_name = $itemsublcass->class_name;
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