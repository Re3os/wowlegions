<?php

namespace App\Services;

class Utils {

    public static function dirsize($directory) {
        if( ! is_dir( $directory ) ) return - 1;
        $size = 0;
        if( $DIR = opendir( $directory ) ) {
            while ( ($dirfile = readdir( $DIR )) !== false ) {
                if( @is_link( $directory . '/' . $dirfile ) || $dirfile == '.' || $dirfile == '..' ) continue;
                if( @is_file( $directory . '/' . $dirfile ) ) $size += filesize( $directory . '/' . $dirfile );
                else if( @is_dir( $directory . '/' . $dirfile ) ) {
                    $dirSize = self::dirsize( $directory . '/' . $dirfile );
                    if( $dirSize >= 0 ) $size += $dirSize;
                    else return - 1;
                }
            }
            closedir( $DIR );
        }
        return $size;
    }

    public static function formatSize($file_size) {
        if( !$file_size OR $file_size < 1) return '0 b';
        $prefix = array("b", "Kb", "Mb", "Gb", "Tb");
        $exp = floor(log($file_size, 1024)) | 0;
        return round($file_size / (pow(1024, $exp)), 2).' '.$prefix[$exp];
    }

    public static function clearCache() {
        $fdir = opendir( CACHE . '/' );
        while ( $file = readdir( $fdir ) ) {
            if( $file != '.' AND $file != '..' ) {
                @unlink( CACHE . '/' . $file );
            }
        }

        $fdir = opendir( CACHE . '/' );
        while ( $file = readdir( $fdir ) ) {
            if(!is_dir($file) ) {
                @unlink( CACHE . '/' . $file );
            }
        }

        self::clear_cache();

        $buffer = "The script cache is successfully cleared.";
        return $buffer;
    }

    protected static function clear_cache($cache_areas = false) {
        if ( $cache_areas ) {
            if(!is_array($cache_areas)) {
                $cache_areas = array($cache_areas);
            }
        }
        $fdir = opendir( CACHE . '/' );
        while ( $file = readdir( $fdir ) ) {
            if(!is_dir($file)) {
                if( $cache_areas ) {
                    foreach($cache_areas as $cache_area) if( stripos( $file, $cache_area ) === 0 ) @unlink( CACHE . '/' . $file );
                } else {
                    @unlink( CACHE . '/' . $file );
                }
            }
        }
        return true;
    }

    public static function getNotLicense() {
        $data = file_get_contents("https://forum.wowlegions.ru/extras/notlicense.php?domain=". App::$app->config->setConfig('server_url') ."&version=" . VERSION);
        return "";
    }

    public static function getActivateScript($data) {
        $domain = preg_replace( "#https?://#i", '', App::$app->config->setConfig('server_url'));
        $domain = preg_replace( "#/#i", '', $domain);
        $messages = "";
        $curl_handle=curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, "https://forum.wowlegions.ru/applications/nexus/interface/licenses/?activate&key=" . $data['key'] . "&identifier=" . $domain);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_USERAGENT, 'WoWLegions');
        $querys = curl_exec($curl_handle);
        $query = json_decode($querys, true);
        curl_close($curl_handle);
        if(isset($query['response']) == "OKAY") {
        $messages .= "Thank you for purchasing our script. We hope that working with him will bring you only pleasure !!! In case of detection of any errors in the distribution, let us know about it on E-Mail: support@wowlegions.ru";
        } elseif($query['errorCode'] == "BAD_KEY_OR_ID") {
        $messages .= "Activation was not performed, the installed data does not correspond to the required ones, or the given copy was already activated on another domain.";
        } elseif($query['errorCode'] == "MAX_USES") {
        $messages .= "This key has already been activated. Contact your site administrator. E-Mail: support@wowlegions.ru";
        }
        return $messages;
    }

    public static function getCheckLicense() {
        $domain = preg_replace( "#https?://#i", '', App::$app->config->setConfig('server_url'));
        $domain = preg_replace( "#/#i", '', $domain);
        $curl_handle=curl_init();
        curl_setopt($curl_handle, CURLOPT_URL, "https://forum.wowlegions.ru/applications/nexus/interface/licenses/?check&key=" . KEY . "&identifier=" . $domain . "&usage_id=" . USER_ID);
        curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
        curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl_handle, CURLOPT_USERAGENT, 'WoWLegions');
        $query = curl_exec($curl_handle);
        curl_close($curl_handle);
        return json_decode($query, true);
    }

    public static function getCheckUpdates() {
        header("Content-type: text/html; charset=utf-8");
        $data = file_get_contents("https://forum.wowlegions.ru/extras/updates.php?version_id=".$_REQUEST['versionid']."&key=");
        if ( !$data ) {
            echo App::$app->lang->get('lng.no_update', '');
        } else {
            if (strtolower("utf-8") == "utf-8") {
                if( function_exists( 'mb_convert_encoding' ) ) {
                    $data = mb_convert_encoding( $data, "utf-8", "windows-1251" );
                } elseif( function_exists( 'iconv' ) ) {
                    $data = iconv("windows-1251", "utf-8", $data);
                }
            }
            echo $data;
        }
    }

}