<?php

use yii\helpers\Html;
use common\helpers\Footer;
use yii\helpers\FileHelper;

?>
<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-md-3 seal-ph">

                <?= Html::a(
                    Html::img('@web/images/coat-ph.png', ['class' => 'footer-seal']),
                    'https://www.officialgazette.gov.ph/'
                ); ?>
                <h6><strong>Republic of the Philippines</strong></h6>
                <div class="seal-caption">All content is in the public domain unless otherwise stated.</div>
            </div>

            <div class="col-md-9">
                <div class="row">
                    <div class="col-md-6 info-system">
                        <div class="info-systems-gap">
                            <div class="info-systems-logo">
                                <?php $info_systems = Footer::getInfoSystem() ?>
                                <?php foreach ($info_systems as $info_system): ?>
                                    <?php
                                    echo Html::img(Yii::$app->urlManager->createUrl(['footer/image-info-system/', 'id' => $info_system->id]), ['class' => 'footer-dilg-system-logos m-1']);
                                    ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="agencies-gap"><strong>Attached Agencies</strong>
                            <!-- <div class="agencies-logo d-flex" style="width: 100px; height: 100px; "> -->
                            <div class="agencies-logo d-flex">
                                <?php $attached_agencies = Footer::getAttachedAgencies() ?>
                                <?php foreach ($attached_agencies as $attached_agency): ?>
                                    <div class="flex-row footer-dilg-attached-agencies-logo">
                                        <?php
                                        // echo Html::img(Yii::$app->urlManager->createUrl(['footer/image-attached-agencies/', 'id' => $attached_agency->id]), ['class' => 'w-100 h-100 m-1']);
                                        echo Html::img(Yii::$app->urlManager->createUrl(['footer/image-attached-agencies/', 'id' => $attached_agency->id]), ['class' => 'footer-agency-logos m-1']);
                                        ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="partners-gap"><strong>Partners</strong>
                            <div class="partners-logo">
                                <?php $partners = Footer::getPartners() ?>
                                <?php foreach ($partners as $partner): ?>
                                    <?php
                                    echo Html::img(Yii::$app->urlManager->createUrl(['footer/image-partners/', 'id' => $partner->id]), ['class' => 'footer-partners-logos m-1']);
                                    ?>
                                <?php endforeach; ?>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                <strong>About GOVPH</strong>
                                <div class="footer-gov">Learn more about the Philippine government, its structure, how
                                    government works and the people behind it.</div>
                                <ul>
                                    <li><a href="https://www.officialgazette.gov.ph/" class="footer-links">Official
                                            Gazette</a></li>
                                    <li><a href="https://data.gov.ph/" class="footer-links">Open Data Portal</a></li>
                                    <li><a href="https://www.gov.ph/feedback/idulog/" class="footer-links">Send us your
                                            feedback</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6"><strong>Government Links</strong>
                                <ul>
                                    <li><a href="https://op-proper.gov.ph/" class="footer-links">Office of the
                                            President</a></li>
                                    <li><a href="https://www.ovp.gov.ph/" class="footer-links">Office of the Vice
                                            President</a></li>
                                    <li><a href="https://legacy.senate.gov.ph/" class="footer-links">Senate of the
                                            Philippines</a></li>
                                    <li><a href="https://www.congress.gov.ph/" class="footer-links">House of
                                            Representatives</a></li>
                                    <li><a href="https://sc.judiciary.gov.ph/" class="footer-links">Supreme Court</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <div>&nbsp;</div>
                                <ul>
                                    <li><a href="https://ca.judiciary.gov.ph/" class="footer-links">Court of Appeals</a>
                                    </li>
                                    <li><a href="https://sb.judiciary.gov.ph/" class="footer-links">Sandiganbayan</a>
                                    </li>
                                    <li><a href="https://www.gppb.gov.ph/" class="footer-links">Government Procurement
                                            Policy Board</a></li>
                                    <li><a href="https://www.phcc.gov.ph/" class="footer-links">Philippine Competition
                                            Commission</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div><strong>Connect with us</strong></div>
                                <div class="footer-social">Be updated about DILG</div>
                                <div class="footer-social">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="12" width="12"
                                        viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path fill="#ffffff"
                                            d="M504 256C504 119 393 8 256 8S8 119 8 256c0 123.8 90.7 226.4 209.3 245V327.7h-63V256h63v-54.6c0-62.2 37-96.5 93.7-96.5 27.1 0 55.5 4.8 55.5 4.8v61h-31.3c-30.8 0-40.4 19.1-40.4 38.7V256h68.8l-11 71.7h-57.8V501C413.3 482.4 504 379.8 504 256z" />
                                    </svg>
                                    Like us on Facebook
                                </div>
                                <div class="footer-social">
                                    <svg xmlns="http://www.w3.org/2000/svg" height="12" width="12"
                                        viewBox="0 0 512 512"><!--!Font Awesome Free 6.5.1 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2024 Fonticons, Inc.-->
                                        <path fill="#ffffff"
                                            d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z" />
                                    </svg>
                                    Follow us on X
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</footer>