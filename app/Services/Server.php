<?php

namespace App\Services;

use Illuminate\Support\Facades\{Cache, DB};

class Server
{
    public static function status()
    {
        $status = Cache::remember('realm_status', 0.1 , function () {
            return static::getServerStatus();
        });

        return $status;
    }

    public static function playersOnline()
    {
        $online = Cache::remember('players_online', 0.1 , function () {
            return static::getOnlinePlayers();
        });

        return $online;
    }

    public static function uptime()
    {
        $uptime = Cache::remember('server_uptine', 0.1 , function () {
            return static::getServerUptime();
        });

        return $uptime;
    }

    private static function getServerStatus() {

        $realms = DB::connection('auth')->table('realmlist')->get();
        $i = 0;
        foreach($realms as $realm) {
            $realm[$i]['status'] = @fsockopen($realm[$i]['address'], $realm[$i]['port'], $errNum, $errMsg, 1) === false ? 'up' : 'down';
            switch($realm[$i]['icon'] ) {
                default:
                case 0:
                case 4:
                    $realm[$i]['type'] = 'PvE';
                    break;
                case 1:
                    $realm[$i]['type'] = 'PvP';
                    break;
                case 6:
                    $realm[$i]['type'] = 'RP';
                    break;
                case 8:
                    $realm[$i]['type'] = 'RP PvP';
                    break;
            }
            switch($realm[$i]['timezone']) {
                default:
                    $realm[$i]['language'] = 'Development';
                    break;
                case 8:
                    $realm[$i]['language'] = 'English';
                    break;
                case 9:
                    $realm[$i]['language'] = 'German';
                    break;
                case 10:
                    $realm[$i]['language'] = 'Francais';
                    break;
                case 11:
                    $realm[$i]['language'] = 'Espanol';
                    break;
                case 12:
                    $realm[$i]['language'] = 'Русский';
                    break;
            }
            $i++;
        }
        return $realm;
    }

    private static function getOnlinePlayers()
    {
        $playersOnline = DB::connection('characters')->table('characters')->where('online', 1)->get(['name', 'race', 'class', 'level']);

        $allianceOnline = $playersOnline->whereIn('race', [1,3,4,7,11])->count();
        $hordeOnline    = $playersOnline->whereIn('race', [2,5,6,8,10])->count();

        $playersOnline->transform(function ($item, $key) {
            $item->faction = static::extractFaction($item->race);
            return $item;
        });

        return (object) array('all' => $playersOnline, 'horde' => $hordeOnline, 'alliance' => $allianceOnline);
    }

    private static function getServerUptime()
    {
        $uptime = DB::connection('auth')->table('uptime')->orderBy('starttime', 'desc')->limit(1)->get(['uptime']);

        if ($uptime->isEmpty())
            $uptime_object = (object) array('days' => 0, 'hours' => 0, 'minutes' => 0, 'seconds' => 0);
        else
        {
            $uptime = $uptime->first()->uptime;
            $sec = $uptime%60;

            $uptime = intval($uptime/60);
            $min = $uptime%60;

            $uptime = intval($uptime/60);
            $hours = $uptime%24;

            $uptime = intval($uptime/24);
            $days = $uptime;

            $uptime_object = (object) array('days' => $days, 'hours' => $hours, 'minutes' => $min, 'seconds' => $sec);
        }

        return $uptime_object;
    }

    private static function extractFaction($race)
    {
        $horde = array(2, 5, 6, 8, 10);

        return in_array($race, $horde) ? 'horde' : 'alliance';
    }

}
