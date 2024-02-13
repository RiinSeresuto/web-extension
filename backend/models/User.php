<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $password_hash
 * @property string $auth_key
 * @property int|null $confirmed_at
 * @property string|null $unconfirmed_email
 * @property int|null $blocked_at
 * @property string|null $registration_ip
 * @property int $created_at
 * @property int $updated_at
 * @property int $flags
 *
 * @property Advisory[] $advisories
 * @property Article[] $articles
 * @property CmsCategory[] $cmsCategories
 * @property CmsCategory[] $cmsCategories0
 * @property CmsConnectedAgencies[] $cmsConnectedAgencies
 * @property CmsConnectedAgencies[] $cmsConnectedAgencies0
 * @property CmsField[] $cmsFields
 * @property CmsField[] $cmsFields0
 * @property CmsFileAttachment[] $cmsFileAttachments
 * @property CmsFileAttachment[] $cmsFileAttachments0
 * @property CmsForm[] $cmsForms
 * @property CmsForm[] $cmsForms0
 * @property CmsMenu[] $cmsMenus
 * @property CmsMenu[] $cmsMenus0
 * @property CmsPages[] $cmsPages
 * @property CmsPages[] $cmsPages0
 * @property CmsPost[] $cmsPosts
 * @property CmsPost[] $cmsPosts0
 * @property CmsYear[] $cmsYears
 * @property CmsYear[] $cmsYears0
 * @property Content[] $contents
 * @property Events[] $events
 * @property News[] $news
 * @property Profile $profile
 * @property ProgramProject[] $programProjects
 * @property SocialAccount[] $socialAccounts
 * @property TbldesignationUserHistory[] $tbldesignationUserHistories
 * @property TbldivisionUserHistory[] $tbldivisionUserHistories
 * @property TblpositionUserHistory[] $tblpositionUserHistories
 * @property TblsectionUserHistory[] $tblsectionUserHistories
 * @property TblserviceUserHistory[] $tblserviceUserHistories
 * @property Token[] $tokens
 * @property UserInfo $userInfo
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['username', 'email', 'password_hash', 'auth_key', 'created_at', 'updated_at'], 'required'],
            [['confirmed_at', 'blocked_at', 'created_at', 'updated_at', 'flags'], 'integer'],
            [['username', 'email', 'unconfirmed_email'], 'string', 'max' => 255],
            [['password_hash'], 'string', 'max' => 60],
            [['auth_key'], 'string', 'max' => 32],
            [['registration_ip'], 'string', 'max' => 45],
            [['email'], 'unique'],
            [['username'], 'unique'],
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
            'password_hash' => 'Password Hash',
            'auth_key' => 'Auth Key',
            'confirmed_at' => 'Confirmed At',
            'unconfirmed_email' => 'Unconfirmed Email',
            'blocked_at' => 'Blocked At',
            'registration_ip' => 'Registration Ip',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'flags' => 'Flags',
        ];
    }

    /**
     * Gets query for [[Advisories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAdvisories()
    {
        return $this->hasMany(Advisory::className(), ['user' => 'id']);
    }

    /**
     * Gets query for [[Articles]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getArticles()
    {
        return $this->hasMany(Article::className(), ['user' => 'id']);
    }

    /**
     * Gets query for [[CmsCategories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsCategories()
    {
        return $this->hasMany(CmsCategory::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[CmsCategories0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsCategories0()
    {
        return $this->hasMany(CmsCategory::className(), ['user_update_id' => 'id']);
    }

    /**
     * Gets query for [[CmsConnectedAgencies]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsConnectedAgencies()
    {
        return $this->hasMany(CmsConnectedAgencies::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[CmsConnectedAgencies0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsConnectedAgencies0()
    {
        return $this->hasMany(CmsConnectedAgencies::className(), ['user_update_id' => 'id']);
    }

    /**
     * Gets query for [[CmsFields]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsFields()
    {
        return $this->hasMany(CmsField::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[CmsFields0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsFields0()
    {
        return $this->hasMany(CmsField::className(), ['user_update_id' => 'id']);
    }

    /**
     * Gets query for [[CmsFileAttachments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsFileAttachments()
    {
        return $this->hasMany(CmsFileAttachment::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[CmsFileAttachments0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsFileAttachments0()
    {
        return $this->hasMany(CmsFileAttachment::className(), ['user_update_id' => 'id']);
    }

    /**
     * Gets query for [[CmsForms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsForms()
    {
        return $this->hasMany(CmsForm::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[CmsForms0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsForms0()
    {
        return $this->hasMany(CmsForm::className(), ['user_update_id' => 'id']);
    }

    /**
     * Gets query for [[CmsMenus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsMenus()
    {
        return $this->hasMany(CmsMenu::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[CmsMenus0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsMenus0()
    {
        return $this->hasMany(CmsMenu::className(), ['user_update_id' => 'id']);
    }

    /**
     * Gets query for [[CmsPages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsPages()
    {
        return $this->hasMany(CmsPages::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[CmsPages0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsPages0()
    {
        return $this->hasMany(CmsPages::className(), ['user_update_id' => 'id']);
    }

    /**
     * Gets query for [[CmsPosts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsPosts()
    {
        return $this->hasMany(CmsPost::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[CmsPosts0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsPosts0()
    {
        return $this->hasMany(CmsPost::className(), ['user_update_id' => 'id']);
    }

    /**
     * Gets query for [[CmsYears]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsYears()
    {
        return $this->hasMany(CmsYear::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[CmsYears0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCmsYears0()
    {
        return $this->hasMany(CmsYear::className(), ['user_update_id' => 'id']);
    }

    /**
     * Gets query for [[Contents]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContents()
    {
        return $this->hasMany(Content::className(), ['user' => 'id']);
    }

    /**
     * Gets query for [[Events]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getEvents()
    {
        return $this->hasMany(Events::className(), ['user' => 'id']);
    }

    /**
     * Gets query for [[News]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNews()
    {
        return $this->hasMany(News::className(), ['user' => 'id']);
    }

    /**
     * Gets query for [[Profile]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProfile()
    {
        return $this->hasOne(Profile::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[ProgramProjects]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProgramProjects()
    {
        return $this->hasMany(ProgramProject::className(), ['user' => 'id']);
    }

    /**
     * Gets query for [[SocialAccounts]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSocialAccounts()
    {
        return $this->hasMany(SocialAccount::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[TbldesignationUserHistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTbldesignationUserHistories()
    {
        return $this->hasMany(TbldesignationUserHistory::className(), ['USER_ID' => 'id']);
    }

    /**
     * Gets query for [[TbldivisionUserHistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTbldivisionUserHistories()
    {
        return $this->hasMany(TbldivisionUserHistory::className(), ['USER_ID' => 'id']);
    }

    /**
     * Gets query for [[TblpositionUserHistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblpositionUserHistories()
    {
        return $this->hasMany(TblpositionUserHistory::className(), ['USER_ID' => 'id']);
    }

    /**
     * Gets query for [[TblsectionUserHistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblsectionUserHistories()
    {
        return $this->hasMany(TblsectionUserHistory::className(), ['USER_ID' => 'id']);
    }

    /**
     * Gets query for [[TblserviceUserHistories]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTblserviceUserHistories()
    {
        return $this->hasMany(TblserviceUserHistory::className(), ['USER_ID' => 'id']);
    }

    /**
     * Gets query for [[Tokens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTokens()
    {
        return $this->hasMany(Token::className(), ['user_id' => 'id']);
    }

    /**
     * Gets query for [[UserInfo]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserInfo()
    {
        return $this->hasOne(UserInfo::className(), ['user_id' => 'id']);
    }
}
