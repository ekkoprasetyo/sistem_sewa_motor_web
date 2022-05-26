<?php

namespace App\Helpers;
use App\Model\UsersModel;
use Session;

class UserAuthorization {

    public static function getUserID() {
        return Session::get('user_id');
    }

    public static function getEmail() {
        return Session::get('user_email');
    }

    public static function getUnitID() {
        return Session::get('user_unit_id');
    }

    public static function getAreaID() {
        return Session::get('user_area_id');
    }

    public static function getRoleID() {
        return Session::get('user_role_id');
    }

    public static function getPositionID() {
        return Session::get('user_position_id');
    }

    public static function getAreaCode() {
        return Session::get('user_area_code');
    }

    public static function getDirectorateID() {
        return Session::get('user_directorate_id');
    }

    public static function isAllowed($permission) {
        if (Session::has($permission)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}
