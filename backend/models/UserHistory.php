<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_history".
 *
 * @property int $id
 * @property int|null $user_id
 * @property string $username
 * @property string $email
 * @property string $auth_key
 * @property string|null $registration_ip
 * @property int|null $confirmed_at
 * @property int|null $blocked_at
 * @property int $created_at
 * @property int $updated_at
 */
class UserHistory extends \niksko12\auditlogs\classes\ModelAudit
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_history';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'confirmed_at', 'blocked_at', 'created_at', 'updated_at'], 'integer'],
            [['username', 'email', 'auth_key', 'created_at', 'updated_at'], 'required'],
            [['username', 'email'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['registration_ip'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'username' => 'Username',
            'email' => 'Email',
            'auth_key' => 'Auth Key',
            'registration_ip' => 'Registration Ip',
            'confirmed_at' => 'Confirmed At',
            'blocked_at' => 'Blocked At',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
