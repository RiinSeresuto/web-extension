<?php

namespace common\modules\wfh\controllers;

use Yii;
use common\modules\wfh\models\Task;
use common\modules\wfh\models\TaskSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\modules\wfh\models\ReportDetails;

use kartik\mpdf\Pdf;

/**
 * RecordController implements the CRUD actions for Record model.
 */
class ReportController extends \niksko12\auditlogs\classes\ControllerAudit
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionGenerate($d, $s)
    {
        Yii::$app->response->format = 'json';

        $user   = Yii::$app->user->id;
        $date   = explode(" - ", $d);
        $status = explode(",", $s);

        $startDate = date('Y-m-d 00:00:00', strtotime($date['0']));
        $endDate   = date('Y-m-d 23:23:59', strtotime($date['1']));

        $result = Task::find()->where(['user_id' => $user])
                ->andWhere(['>=', 'start_date', $startDate])
                ->andFilterWhere(['<=', 'start_date', $endDate])
                ->andWhere(['status' => $status])
                ->orderBy(['start_date' => SORT_ASC])
                ->all();

        $data = [
            'result' => ($result) ? $result : '0',
            'date'   => date('F d, Y', strtotime($date['0'])) . " - " .date('F d, Y', strtotime($date['1']))
        ];
        return $data;
       
    }

    public function actionExport($d = null, $s = null)
    {
        $user   = Yii::$app->user->id;
        $date   = explode(" - ", $d);
        $status = explode(",", $s);

        $info   = Yii::$app->user->identity->userinfo;
        $lname  =  $info->LAST_M;
        $fname  =  $info->FIRST_M;
        $mname  = ($info->MIDDLE_M) ? substr($info->MIDDLE_M, 0, 1) . '. ' : ' ';
        $user_name = $fname . ' ' . $mname . ' ' . $lname;

        $startDate = date('Y-m-d 00:00:00', strtotime($date['0']));
        $endDate   = date('Y-m-d 23:23:59', strtotime($date['1']));

        $result = Task::find()->where(['user_id' => $user])
                ->andWhere(['>=', 'start_date', $startDate])
                ->andFilterWhere(['<=', 'start_date', $endDate])
                ->andWhere(['status' => $status])
                ->orderBy(['start_date' => SORT_ASC])
                ->all();

        $details = ReportDetails::find()->where(['user_id' => $user])->one();

        // return $this->render('export' , ['result' => $result, 'startDate' => $date['0'], 'endDate' => $date['1'], 'user_name' => $user_name]);
        $content = $this->renderPartial('export' , ['result' => $result, 'startDate' => $date['0'], 'endDate' => $date['1'], 'user_name' => $user_name, 'details' => ($details) ? $details : '']);
       
       
        $date = date('F j, Y h:i:s',strtotime(date('Y-m-d h:i:s')));
        $pdf = new Pdf([
            'mode' => Pdf::MODE_CORE,
            'filename' => 'Sample.pdf',
            'format' => Pdf::FORMAT_A4, 
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            'destination' => Pdf::DEST_BROWSER, 
            'content' => $content,  
            'marginLeft' => 20,
            'marginRight' => 20,
            'cssInline' => 
                '
                .tbl-title td {
                    color: black;
                    font-size : 14px;
                }

                .mainTable td, {
                    border: 1px solid black;
                    color: black;
                }

                .mainTable td, {
                    font-size : 13px;
                }

                .footer-table td {
                    color: black;
                    font-size : 14px;
                }

                .div-footer {
                    color: black;
                }
                ', 
            // 'options' => ['title' => 'Official\'s Profile'],
            'methods' => [ 
                'SetHeader'=>false, 
                'SetFooter'=> '',
            ]
        ]);

        $response = Yii::$app->response;
        $response->format = \yii\web\Response::FORMAT_RAW;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'application/pdf');
        return $pdf->render(); 
    }
}