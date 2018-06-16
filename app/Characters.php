<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Characters extends Model {

    protected $connection = 'characters';

    protected $fillable = ['guid', 'name', 'gender', 'class', 'race', 'level'];

    public function comments() {
        return $this->belongsTo(Comment::class);
    }

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

    private static function verificationTranslation($Reason) {
        $ErrorTypes = array(
            '20012Title' => __('account.service_error_one_title'),
            '20012Desc' => __('account.service_error_one_desc'),
            '20016Title' => __('account.service_error_two_title'),
            '20016Desc' => __('account.service_error_two_desc'),
            '20032Title' => __('account.service_error_20032Title'),
            '20032Desc' => __('account.service_error_20032Desc'),
            '20033Title' => __('account.service_error_20033Title'),
            '20033Desc' => __('account.service_error_20033Desc'),
            '20034Title' => __('account.service_error_five_title'),
            '20034Desc' => __('account.service_error_five_desc'),
            '20057Title' => __('account.service_error_20057Title'),
            '20057Desc' => __('account.service_error_20057Desc'),
            '20064Title' => __('account.service_error_20064Title'),
            '20064Desc' => __('account.service_error_20064Desc'),
            'unknown' => __('account.service_error_unknown')
        );
        if(array_key_exists($Reason, $ErrorTypes))
            return $ErrorTypes[$Reason];
        else
            return $ErrorTypes['unknown'];
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

    public static function userCharacters($name) {
        $characters = \DB::connection('characters')->table('characters')->where('name', '=', $name)->get()[0];
        $characters->side = self::getSideByRaceID($characters->race)['name'];
        return $characters;
    }

    public static function activeUserCharacters($id) {
        $characters = \DB::connection('characters')->table('characters')->where('guid', '=', $id)->get()[0];
        $characters->side = self::getSideByRaceID($characters->race)['name'];
        return $characters;
    }

    public static function ifCharacters($id) {
        $characters = \DB::connection('characters')->table('characters')->where('guid', '=', $id)->get();
        if ($characters) {
            return true;
        } return false;
    }

    public static function getSideByRaceID($RaceID)
    {
        $HordeRaces = array(2, 5, 6, 8, 9, 10, 26, 28, 29);
        if(in_array($RaceID, $HordeRaces))
            return array('id' => '1', 'name' => 'horde');
        else
            return array('id' => '0', 'name' => 'alliance');
    }

}