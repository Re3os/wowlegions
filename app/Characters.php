<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Characters extends Model {

    protected $connection = 'characters';

    protected $fillable = ['guid', 'name', 'gender', 'class', 'race', 'level'];

    public static function verifyEligibility($character, $service) {
        $Eligible = false;
        $HasMail = false;
        $IsOnline = false;
        $Reasons = array();

        if(self::checkCharacterInbox($character)) {
            $HasMail = true;
        }
        if(self::checkIfCharacterOnline($character)) {
            $IsOnline = true;
        }
        if(!$HasMail && !$IsOnline)
            return array('eligible' => true, 'reasons' => array());
        else
            if($HasMail && !$IsOnline)
        return array('eligible' => false, 'reasons' => array(self::verificationTranslation('20016Title')));
            elseif(!$HasMail && $IsOnline)
        return array('eligible' => false, 'reasons' => array(self::verificationTranslation('20034Title')));
            elseif($HasMail && $IsOnline)
        return array('eligible' => false, 'reasons' => array(self::verificationTranslation('20034Title')));
    }

    private static function checkCharacterInbox($character) {
        $result = \DB::connection('characters')->select('SELECT m.*, c.name FROM mail m, characters c WHERE m.receiver = c.guid AND c.name = ?', [$character]);
        if(empty($result))
            return false;
        else
            return true;
    }

    private static function checkIfCharacterOnline($character) {
        $result = \DB::connection('characters')->select('SELECT online FROM characters WHERE name = ?', [$character]);
        if($result[0]->online == 0)
            return false;
        else
            return true;
    }

    public static function userGameCharacters($id) {
        return \DB::connection('characters')->table('characters')->where('account', '=', $id)->get();
    }

    public static function activeUserCharacters($id) {
        return \DB::connection('characters')->table('characters')->where('guid', '=', $id)->get()[0];
    }

}