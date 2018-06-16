<?php

namespace App\Services;

use Illuminate\Support\Facades\{Cache, DB};

class Server
{
    public static function status()
    {
        return static::getServerStatus();
    }

    public static function playersOnline()
    {
        return static::getOnlinePlayers();
    }

    public static function uptime()
    {
        return static::getServerUptime();
    }

    private static function getServerStatus() {
        $realms = config('server.realms');

        $result = @fsockopen($realms[0]['ip'], $realms[0]['port'], $errNum, $errMsg, 1) === false ? false : true;

        return (object) array(
        'status' => $result,
        'name' => $realms[0]['name'],
        );
    }

    private static function getOnlinePlayers()
    {
        $playersOnline = DB::connection('characters')->table('characters')->where('online', 1)->get(['name', 'race', 'class', 'level']);

        $allianceOnline = $playersOnline->whereIn('race', [1,3,4,7,11,22,30,29,24,25])->count();
        $hordeOnline    = $playersOnline->whereIn('race', [2,5,6,8,9,10,28,27,26])->count();

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
