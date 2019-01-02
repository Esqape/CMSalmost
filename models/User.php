<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property int $role
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email','role'], 'required'],
            [['username','email'], 'unique'],
            [['role'], 'integer'],
            [['username', 'email'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'email' => 'Email',
            'role' => 'Role',
        ];
    }

    public static function findIdentity($id) {
        $user = self::find()
                ->where([
                    "id" => $id
                ])
                ->one();
    /*    if (!count($user)) {
            return null;
        }
    */
        return new static($user);
    }
     
    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $userType = null) {
     
        $user = self::find()
                ->where(["accessToken" => $token])
                ->one();

    /*    if (!count($user)) {
            return null;
        }
        */
        return new static($user);
    }
     
    /**
     * Finds user by username
     *
     * @param  string      $username
     * @return static|null
     */
    public static function findByUsername($username) {
        $user = self::find()
                ->where([
                    "username" => $username
                ])
                ->one();
     /*   if (!count($user)) {
            return null;
        }

        */
        return new static($user);
    }
     
    public static function findByUser($username) {
        $user = self::find()
                ->where([
                    "username" => $username
                ])
                ->one();
        if (!count($user)) {
            return null;
        }
        return $user;
    }
     
    /**
     * @inheritdoc
     */
    public function getId() {
        return $this->id;
    }
     
    /**
     * @inheritdoc
     */
    public function getAuthKey() {
        return $this->authKey;
    }
     
    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey) {
        return $this->authKey === $authKey;
    }
     
    /**
     * Validates email
     *
     * @param  string  $email email to validate
     * @return boolean if email provided is valid for current user
     */
    public function validateEmail($email) {
        return ($this->email ===  ($email));
    }
     
    }

