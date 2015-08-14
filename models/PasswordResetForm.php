<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\helpers\Url;

/**
 * PasswordResetForm is the model behind the password reset form form.
 */
class PasswordResetForm extends Model
{
    public $email;
    private $_user = false;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['email'], 'email'],
        ];
    }

    /**
     * Finds user by [[email]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === false) {
            $this->_user = User::findByEmail($this->email);
        }

        return $this->_user;
    }
    
    /**
     * Send reset link to email
     * @return boolean whether the reset token link sending is successfull
     */
    public function reset()
    {
        $this->getUser();
        
        if ($this->_user) {
            
            $token = Yii::$app->security->generateRandomString(32);
            $link = '<a href="' . Url::toRoute(["user/resetpassword", "token" => $token], TRUE) . '">' . Url::toRoute(["user/resetpassword", "token" => $token], TRUE) . '</a>';

            $this->_user->reset_token = $token;
            
            $this->_user->password_confirm = $this->_user->password;
            
            $userUpdated = $this->_user->save();

            if ($userUpdated) {
                $to = $this->email;
                $msgTitle = Yii::t("app", "Password Reset");
                
                $msg = '<p>Dear '.$this->_user->name.',</p>
                    <p></p>
                    <p>You have requested a password reset link on Vital.</p>
                    <p>Click on the following link and enter your new password.</p><p>' . $link . '. </p>
                    <p>This link will expire in 24 hours.</p>
                    <p></p>
                    <p>Vital</p>
                    <p><a href="http://www.simyan.info">www.simyan.info</a></p>';
                
                $sent = Yii::$app->mailer->compose()
                    ->setTo($to)
                    ->setFrom(['admin@simyan.info' => 'Vital'])
                    ->setSubject($msgTitle)
                    ->setHtmlBody($msg)
                    ->send();
                
                if ($sent) {
                    Yii::$app->session->setFlash('token_sent', 'Link for password reset was send on '.$this->email.'. Please check your e-mail and follow the instructions.');
                    return true;
                } else {
                    $this->addError("email", Yii::t("app", "Unable to send email."));
                    return false;
                }
            } else {
                $this->addError("email", Yii::t("app", "Error. Please try again later."));
                return false;
            }
        
        } else {
            $this->addError("email", Yii::t("app", "E-mail is not registered."));
            return false;
        }
        
    }
}
