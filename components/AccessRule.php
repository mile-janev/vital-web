<?php

namespace app\components;

class AccessRule extends \yii\filters\AccessRule {

    /**
     * @inheritdoc
     */
    protected function matchRole($user)
    {
        if (!$user->getIsGuest()) {
            $user_role = \Yii::$app->user->identity->role_id;
        }
        
        $roles = (is_array($this->roles[0])) ? $this->roles[0] : $this->roles;

        foreach ($roles as $role) {

            if ($role === '?') {
                if ($user->getIsGuest()) {
                    return true;
                }
            } elseif ($role === '@') {
                if (!$user->getIsGuest()) {
                    return true;
                }
            // Check if the user is logged in, and the roles match
            } elseif (!$user->getIsGuest() && $role->id === $user_role) {
                return true;
            }
        }

        return false;
    }
}