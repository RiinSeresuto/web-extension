<?php

namespace common\modules\wfh\models;
use yii\data\ArrayDataProvider;
use niksko12\user\models\UserInfo;
use niksko12\user\models\ServiceUserHistory;
use niksko12\user\models\DivisionUserHistory;
use niksko12\user\models\SectionUserHistory;
use common\modules\usermanagement\models\HrisUser;
use yii\helpers\ArrayHelper;
use Yii;

class SupervisorDashboard extends \Yii\base\Model
{
	public $user_id;
	public $reference_date;
	public $ceil_date;
	public $floor_date = '1900-01-01';
	
	private $userinfo;
	private $summary;
	private $employeeObject;
	private $employeeList;
	
	public function init()
	{
		$this->ceil_date = date('Y-m-d', strtotime('+10 years'));
		$this->userinfo = UserInfo::find()->andWhere(['user_id'=>$this->user_id])->one();
	}

	public function getTaskSummary()
	{		
		$employeeIds = $this->myStaff;

		if(!$employeeIds){
			// no employees under. no tasks summary
			return;
		}

		if(!$this->summary){
			$dataProvider = new ArrayDataProvider([
				'allModels' => UserInfo::find()
									->select(['concat('.UserInfo::tableName().'.LAST_M, ",  ", '.UserInfo::tableName().'.FIRST_M, " ", '.UserInfo::tableName().'.MIDDLE_M) as name',
											UserInfo::tableName().'.user_id',
											'ongoing.count as ongoing',
											'onhold.count as onhold',
											'completed.count as completed',
											'cancelled.count as cancelled',
									])
									->leftJoin(['ongoing'=>Task::find()->select(['count(*) as count', 'user_id'])->andWhere(['status'=>'Ongoing'])->groupBy(['user_id'])], 'ongoing.user_id = user_info.user_id')
									->leftJoin(['onhold'=>Task::find()->select(['count(*) as count', 'user_id'])->andWhere(['status' => 'On Hold'])->groupBy(['user_id'])], 'onhold.user_id = user_info.user_id')
									->leftJoin(['completed'=>Task::find()->select(['count(*) as count', 'user_id'])->andWhere(['status' => 'Completed'])->groupBy(['user_id'])], 'completed.user_id = user_info.user_id')
									->leftJoin(['cancelled'=>Task::find()->select(['count(*) as count', 'user_id'])->andWhere(['status' => 'Cancelled'])->groupBy(['user_id'])], 'cancelled.user_id = user_info.user_id')
									->andWhere([UserInfo::tableName().'.user_id' => $employeeIds])
									->orderBy('name')
									->asArray()
									->all(),
				'pagination' => false,

			]);
			$this->summary = $dataProvider;
		}
		return $this->summary;
	}
	
	public function getMyStaff($returnType = null)
	{
		$employees = [];

		$userinfo = $this->userinfo;
		if($userinfo->userdesignation && $userinfo->userdesignation->designation){
			$designation = $userinfo->userdesignation->designation;

			if($designation->office_id == 5){
				if(in_array($designation->id, [1, 2]) && $userinfo->userservice->SERVICE_C){
					// director
					$employees = UserInfo::find()->joinWith(['user', 'userservice'])
												->innerJoin(HrisUser::tableName(), UserInfo::tableName().'.user_id = '.HrisUser::tableName().'.user_id')
												->andWhere(['blocked_at'=>null, 'PARENT_ID'=>null])
												->andWhere([ServiceUserHistory::tableName().'.service_c'=>$userinfo->userservice->SERVICE_C])
												->orderBy(['LAST_M'=>SORT_ASC, 'FIRST_M'=>SORT_ASC, 'MIDDLE_M'=>SORT_ASC]);
				}else if($designation->id == 3 && $userinfo->userdivision->DIVISION_C){
					// dc
					$employees = UserInfo::find()->joinWith(['user', 'userdivision'])
												->innerJoin(HrisUser::tableName(), UserInfo::tableName().'.user_id = '.HrisUser::tableName().'.user_id')
												->andWhere(['blocked_at'=>null, 'PARENT_ID'=>null])
												->andWhere([DivisionUserHistory::tableName().'.division_c'=>$userinfo->userdivision->DIVISION_C])
												->orderBy(['LAST_M'=>SORT_ASC, 'FIRST_M'=>SORT_ASC, 'MIDDLE_M'=>SORT_ASC]);
				}else if($designation->id == 4 && $userinfo->usersection->SECTION_C){
					// sc
					$employees = UserInfo::find()->joinWith(['user', 'usersection'])
												->innerJoin(HrisUser::tableName(), UserInfo::tableName().'.user_id = '.HrisUser::tableName().'.user_id')
												->andWhere(['blocked_at'=>null, 'PARENT_ID'=>null])
												->andWhere([SectionUserHistory::tableName().'.section_c'=>$userinfo->usersection->SECTION_C])
												->orderBy(['LAST_M'=>SORT_ASC, 'FIRST_M'=>SORT_ASC, 'MIDDLE_M'=>SORT_ASC]);
				}
			}else{
				// regional level
			}
			
			if($employees){
				if($returnType == 'object'){
					if(empty($this->employeeObject)){
						 $this->employeeObject = ($employees) ? $employees->all() : [];
					}
					return $this->employeeObject; 
				}else{
					if(empty($this->employeeList)){
						$employees = $employees->select([UserInfo::tableName().'.user_id'])->andWhere(['!=', UserInfo::tableName().'.user_id', $this->user_id])->asArray()->all();
						$this->employeeList = ($employees) ? ArrayHelper::getColumn($employees, 'user_id') : [];						
					}
					return $this->employeeList; 
				}			
			}else{
				return [];
			}
		}
	}
}