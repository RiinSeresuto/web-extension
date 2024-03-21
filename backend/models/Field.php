<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cms_field".
 *
 * @property int $id
 * @property string $label
 * @property int $data_type_id
 * @property int $widget_type_id
 * @property int $user_id
 * @property int $user_update_id
 * @property string $date_created
 * @property string $date_updated
 *
 * @property DataType $dataType
 * @property WidgetType $widgetType
 * @property User $user
 * @property User $userUpdate
 * @property Form[] $cmsForms
 * @property Post[] $cmsPosts
 */
class Field extends \niksko12\auditlogs\classes\ModelAudit
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_field';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['label', 'data_type_id', 'widget_type_id'], 'required'],
            [['id', 'data_type_id', 'widget_type_id', 'user_id', 'user_update_id'], 'integer'],
            [['user_id', 'user_update_id', 'date_created', 'date_updated'], 'safe'],
            [['label'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['data_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => DataType::className(), 'targetAttribute' => ['data_type_id' => 'id']],
            [['widget_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => WidgetType::className(), 'targetAttribute' => ['widget_type_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['user_update_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_update_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'label' => 'Label',
            'data_type_id' => 'Data Type',
            'widget_type_id' => 'Widget Type',
            'user_id' => 'Created By',
            'user_update_id' => 'Updated By',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
        ];
    }

    /**
     * Gets query for [[DataType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDataType()
    {
        return $this->hasOne(DataType::className(), ['id' => 'data_type_id']);
    }

    /**
     * Gets query for [[WidgetType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getWidgetType()
    {
        return $this->hasOne(WidgetType::className(), ['id' => 'widget_type_id']);
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

    /**
     * Gets query for [[UserUpdate]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserUpdate()
    {
        return $this->hasOne(User::className(), ['id' => 'user_update_id']);
    }

    /**
     * Gets query for [[CmsForms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsForms()
    {
        return $this->hasMany(Form::className(), ['field_id' => 'id']);
    }

    /**
     * Gets query for [[CmsPosts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsPosts()
    {
        return $this->hasMany(Post::className(), ['field_id' => 'id']);
    }
}
