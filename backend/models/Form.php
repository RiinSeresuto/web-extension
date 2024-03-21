<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "cms_form".
 *
 * @property int $id
 * @property int $category_id
 * @property string $description
 * @property int $status_id
 * @property int $year
 * @property int $field
 * @property int $user_id
 * @property int $user_update_id
 * @property string $date_created
 * @property string $date_updated
 *
 * @property Field $field
 * @property Category $category
 * @property Status $status
 * @property User $user
 * @property User $userUpdate
 * @property Post[] $cmsPosts
 */
class Form extends \niksko12\auditlogs\classes\ModelAudit
{
    public $field;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cms_form';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'status_id', 'year'], 'required'],
            [['id', 'category_id', 'status_id', 'year'], 'integer'],
            [['user_id', 'user_update_id', 'date_created', 'date_updated', 'field'], 'safe'],
            [['description', 'field'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::className(), 'targetAttribute' => ['status_id' => 'id']],
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
            'category_id' => 'Category',
            'description' => 'Description',
            'status_id' => 'Status',
            'year_id' => 'Year',
            'field' => 'Field',
            'user_id' => 'Created By',
            'user_update_id' => 'Updated By',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
        ];
    }

    /**
     * Gets query for [[Field]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getField()
    {
        return $this->hasOne(Field::className(), ['id' => 'field']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::className(), ['id' => 'status_id']);
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
     * Gets query for [[CmsPosts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsPosts()
    {
        return $this->hasMany(Post::className(), ['forms_id' => 'id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);

        $fields = explode(",", $this->field);

        if ($fields) {
            foreach ($fields as $field) {
                
                $model = new FormField();
                $model->form_id = $this->id;
                $model->field_id = $field;
                $model->save();
            }
        }
    }

    public function getFormField()
    {
        return $this->hasMany(FormField::className(), ['form_id' => 'id']);
    }

}
