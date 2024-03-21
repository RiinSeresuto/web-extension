<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user_info".
 *
 * @property int $user_id
 * @property string|null $EMP_N
 * @property string $LAST_M
 * @property string $FIRST_M
 * @property string $MIDDLE_M
 * @property string $SUFFIX
 * @property string $BIRTH_D
 * @property string $SEX_C
 * @property int|null $OFFICE_C
 * @property int|null $DIVISION_C
 * @property int|null $SECTION_C
 * @property int|null $POSITION_C
 * @property int|null $DESIGNATION
 * @property string $REGION_C
 * @property string $PROVINCE_C
 * @property string $CITYMUN_C
 * @property string $MOBILEPHONE
 * @property string|null $LANDPHONE
 * @property string|null $FAX_NO
 * @property string|null $EMAIL
 * @property string|null $PHOTO
 * @property string|null $ALTER_EMAIL
 * @property string|null $BARANGAY_C
 * @property string|null $EMP_STATUS
 * @property int|null $PARENT_ID
 *
 * @property Tbloffice $oFFICEC
 * @property User $user
 */
class UserInfo extends \niksko12\auditlogs\classes\ModelAudit
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['LAST_M', 'FIRST_M', 'MIDDLE_M', 'SUFFIX', 'BIRTH_D', 'SEX_C', 'REGION_C', 'PROVINCE_C', 'CITYMUN_C', 'MOBILEPHONE'], 'required'],
            [['BIRTH_D'], 'safe'],
            [['OFFICE_C', 'DIVISION_C', 'SECTION_C', 'POSITION_C', 'DESIGNATION', 'PARENT_ID'], 'integer'],
            [['EMP_N', 'EMAIL', 'PHOTO', 'ALTER_EMAIL'], 'string', 'max' => 100],
            [['LAST_M', 'FIRST_M', 'MIDDLE_M', 'SUFFIX'], 'string', 'max' => 255],
            [['SEX_C'], 'string', 'max' => 7],
            [['REGION_C', 'EMP_STATUS'], 'string', 'max' => 2],
            [['PROVINCE_C', 'CITYMUN_C', 'BARANGAY_C'], 'string', 'max' => 3],
            [['MOBILEPHONE', 'LANDPHONE', 'FAX_NO'], 'string', 'max' => 20],
            [['OFFICE_C'], 'exist', 'skipOnError' => true, 'targetClass' => Tbloffice::className(), 'targetAttribute' => ['OFFICE_C' => 'OFFICE_C']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'EMP_N' => 'Emp N',
            'LAST_M' => 'Last M',
            'FIRST_M' => 'First M',
            'MIDDLE_M' => 'Middle M',
            'SUFFIX' => 'Suffix',
            'BIRTH_D' => 'Birth D',
            'SEX_C' => 'Sex C',
            'OFFICE_C' => 'Office C',
            'DIVISION_C' => 'Division C',
            'SECTION_C' => 'Section C',
            'POSITION_C' => 'Position C',
            'DESIGNATION' => 'Designation',
            'REGION_C' => 'Region C',
            'PROVINCE_C' => 'Province C',
            'CITYMUN_C' => 'Citymun C',
            'MOBILEPHONE' => 'Mobilephone',
            'LANDPHONE' => 'Landphone',
            'FAX_NO' => 'Fax No',
            'EMAIL' => 'Email',
            'PHOTO' => 'Photo',
            'ALTER_EMAIL' => 'Alter Email',
            'BARANGAY_C' => 'Barangay C',
            'EMP_STATUS' => 'Emp Status',
            'PARENT_ID' => 'Parent ID',
        ];
    }

    /**
     * Gets query for [[OFFICEC]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOFFICEC()
    {
        return $this->hasOne(Tbloffice::className(), ['OFFICE_C' => 'OFFICE_C']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
