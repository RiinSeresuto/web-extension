<?php

namespace common\modules\wfh\controllers;

use yii\web\Controller;

/**
 * Default controller for the `wfh` module
 */
class DefaultController extends \niksko12\auditlogs\classes\ControllerAudit
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
}
