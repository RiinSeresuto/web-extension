<?php

namespace common\modules\wfh;
use common\modules\wfh\models\SupervisorDashboard;
use niksko12\user\models\UserInfo;
use common\modules\usermanagement\models\HrisUser;

/**
 * wfh module definition class
 */
class Module extends \yii\base\Module
{
	private $userinfo;
	private $supervisorDashboard;
	private $messageHRIS = "Good day! 

This is to inform you that your Intranet Account is not linked to a HRIS Profile. You may continue to use this system however, your attendance records and encoded tasks <u>will not show up on your Supervisor's Dashboard</u>.

Having your account linked to the HRIS has the added benefit of allowing you to maintain your Personnel Data Sheet online through the HRIS.

<b>To have your Intranet account linked, please follow the following steps:</b>
<b>Step 1.</b> Contact Personnel Division for the creation of your HRIS Profile. You may send an email to <a href='mailto:ewbspd@gmail.com'>ewbspd@gmail.com</a>
<b>Step 2.</b> Once your HRIS profile has been created, inform ISTMS on having your Intranet account linked to your HRIS Profile. You may send an email to <a href='mailto:intranet.support@dilg.gov.ph'>intranet.support@dilg.gov.ph</a>
";
	
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'common\modules\wfh\controllers';

	public $defaultRoute = '/record/index';
	
    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
		if(!$this->userinfo){
			$userinfo = \Yii::$app->user->identity->userinfo;
			$this->userinfo = $userinfo;
		}
        // custom initialization code goes here
    }
		
	public function beforeAction($action)
	{
		$userinfo = $this->userinfo;
		$hrisUser = HrisUser::find()->andWhere(['user_id'=>$this->userinfo->user_id])->one();
		if(empty($hrisUser)){
			\Yii::$app->session->setFlash('warning', nl2br($this->messageHRIS));
		}
		
		$this->layout = 'main';
		return parent::beforeAction($action);
	}
	
	public function getIsSupervisor()
	{
		$userinfo = $this->userinfo;
		if($userinfo->userdesignation && $userinfo->userdesignation->designation){
			$designation = $userinfo->userdesignation->designation;
			if($designation->office_id == 5 && in_array($designation->id, [1,2,3,4])){
				return true;
			}
		}
		return false;
	}
	
	public function getSupervisorDashboard()
	{
		if(empty($this->supervisorDashboard)){
			$this->supervisorDashboard = new SupervisorDashboard(['user_id'=>\Yii::$app->user->id]);
		}
		return $this->supervisorDashboard;
	}
}
