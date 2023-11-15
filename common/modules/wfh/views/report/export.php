<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;
use kartik\select2\Select2;

$newDate = '';
$recent = '';

?>

<div class="record-search">
    <div class="row" >
        <table class="table tbl-title">
            <tr>
                <td align="center">ACCOMPLISHMENT REPORT</td>
            </tr>
            <tr>
                <td align="center"><?= date('F d, Y', strtotime($startDate)) ?> - <?= date('F d, Y ', strtotime($endDate)) ?></td>
            </tr>
        </table>
    </div>
    <br>
    <br>
    <div class="row" >
        <?php if ($result) : ?>
            <table class="table mainTable table-striped table-bordered" cellpadding="0" width="100%" style="font-family: Calibri; font-size: 9pt;">
                <tr>
                    <th width="30%" style="padding: 10px;" align="center">Date</th>
                    <th width="70%" style="padding: 10px;" align="left">Task Description</th>
                </tr>
                <?php foreach ($result as $key => $rec) { ?>
                    <?php $newDate = date('F d, Y ', strtotime($rec['start_date']));?>
                    <tr>
                        <?php if ($recent != $newDate) :?>
                            <td style="padding: 10px;" align="center"><?= $newDate ?></td>
                            <?php $recent = $newDate; ?>
                        <?php else : ?>
                            <td style="padding: 10px;" align="center"></td>
                        <?php endif ?>
                        
                        <td style="padding: 10px;"><?= Yii::$app->formatter->asHtml($rec['description']) ?></td>
                    </tr>
                <?php } ?>
            </table>
        <?php endif ?>
    </div>

    <div class="row" align="center">
        <table class="table footer-table" cellpadding="0" width="100%" style="font-family: Calibri; font-size: 9pt;">
            <tr>
                <td  width="50%" align="left"><?= strtoupper('Submitted By:') ?></td>
                <td  width="50%" align="left"><?= strtoupper('Noted By:') ?></td>
            </tr>
        </table>
        <br>
        <table class="table footer-table" cellpadding="0" width="100%" style="font-family: Calibri; font-size: 9pt;">
            <tr>
                <td  width="50%" align="left"><?= ($user_name) ? strtoupper(Yii::$app->formatter->asHtml($user_name)) : '' ?> </td>
                <td  width="50%" align="left"><?= ($details) ? strtoupper(Yii::$app->formatter->asHtml($details->approval_name)) : '' ?></td>
            </tr>
            <tr>
                <td  width="50%" align="left"><?= ($details) ? strtoupper(Yii::$app->formatter->asHtml($details->employee_position)) : '' ?></td>
                <td  width="50%" align="left"><?= ($details) ? strtoupper(Yii::$app->formatter->asHtml($details->approval_position)) : '' ?></td>
            </tr>
        </table>
    </div>
</div>
