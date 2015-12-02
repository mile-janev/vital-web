<?php

namespace app\components;
use app\models\Role;

use Yii;
use yii\helpers\Url;

class Functions {
    
    public static function isRole($role)
    {
        if (Yii::$app->user->isGuest) {
            return FALSE;
        } else if(Yii::$app->user->identity->role->name == $role) {
            return TRUE;
        }
    }
    
    public static function formatSign($sign) 
    {
        $sign = preg_replace("/_/", " ", $sign);
        $sign = ucfirst($sign);
        
        return $sign;
    }
    
    public static function avpu()
    {
        $avpu = [
            0 => "Alert",
            1 => "React to Voice",
            2 => "React to Pain",
            4 => "Unresponsive"
        ];
        
        return $avpu;
    }
    
}
