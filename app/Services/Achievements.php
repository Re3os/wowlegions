<?php

namespace App\Services;

use Illuminate\Support\Facades\{Cache, DB};

class Achievements {

    private static $guid = 0;
    private static $achievements_points = 0;
    private static $achievements_count  = 0;
    private static $achievements_storage = array();
    private static $criterias_storage = array();
    private static $isAchievementsLoaded = false;
    private static $achievement_ids = array();
    private static $sorted_storage = array();
    private static $achievement_id = 0;
    private static $template_category = 0;
    private static $categories_names = array();

    public static function Initialize($uid) {
        self::$guid = $uid;
        self::LoadAchievements();
        self::CountAchievements();
        self::CalculateAchievementPoints();
        //self::SortAchievements();
        return true;
    }

    private static function IsLoaded() {
        return self::$isAchievementsLoaded;
    }

    private static function LoadAchievements() {
        if(self::IsLoaded()) {
            return true;
        }
        self::$achievements_storage = DB::connection('characters')->table('character_achievement')->where('guid', self::$guid)->orderBy('date', 'desc')->get();
        if(!self::$achievements_storage) {
            return false;
        }
        self::$criterias_storage = DB::connection('characters')->table('character_achievement_progress')->where('guid', self::$guid)->get();
        if(!self::$criterias_storage) {
            WoW_Log::WriteError('%s : criterias for character %s (GUID: %d) were not found!', __METHOD__, WoW_Characters::GetName(), WoW_Characters::GetGUID());
        }
        self::$isAchievementsLoaded = true;
        return true;
    }

    private static function CountAchievements() {
        if(!self::IsLoaded()) {
            self::LoadAchievements();
        }
        self::$achievements_count = count(self::$achievements_storage);
        return true;
    }

    private static function CalculateAchievementPoints() {
        if(!self::IsLoaded()) {
            self::LoadAchievements();
        }
        self::$achievements_points = DB::connection('mysql')->table('achievement')->whereIn('id', self::GetAchievementsIDs())->sum('points');
        //dd(self::GetAchievementsIDs());
        return true;
    }

    private static function GetAchievementsIDs() {
        if(!self::IsLoaded()) {
            self::LoadAchievements();
        }
        if(!self::$achievement_ids) {
            self::$achievement_ids = array();
            foreach(self::$achievements_storage as $achievement) {
                self::$achievement_ids[] = $achievement->achievement;
            }
        }
        return self::$achievement_ids;
    }

    public static function GetAchievementsPoints() {
        return self::$achievements_points;
    }

    public static function GetAchievementsCount() {
        return self::$achievements_count;
    }
}