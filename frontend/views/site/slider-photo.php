<?php

use yii\helpers\Html;

?>

<!-- Slider Photo -->
<div class="slider-photo slider">
        <div>
            <?= Html::a(
                        Html::img('@web/images/slider/sp1.png')
                    ); ?>
        </div>
        <div>
            <?= Html::a(
                        Html::img('@web/images/slider/sp2.png')
                    ); ?>
        </div>
        <div>
            <?= Html::a(
                        Html::img('@web/images/slider/sp3.png')
                    ); ?>
        </div>
        <div>
            <?= Html::a(
                        Html::img('@web/images/slider/sp4.png')
                    ); ?>
        </div>
        <div>
            <?= Html::a(
                        Html::img('@web/images/slider/sp5.png')
                    ); ?>
        </div>
        
    </div>

<?php 

$script = <<<JS
$(".slider-photo").slick({
          centerMode: true,
          autoplay: true,
          autoplaySpeed: 3000,
          centerPadding: "60px",
          slidesToShow: 3,
          responsive: [
            {
              breakpoint: 768,
              settings: {
                arrows: false,
                centerMode: true,
                centerPadding: "40px",
                slidesToShow: 3,
              },
            },
            {
              breakpoint: 480,
              settings: {
                arrows: false,
                centerMode: true,
                centerPadding: "40px",
                slidesToShow: 1,
              },
            },
          ],
        });
JS;

$this->registerJs($script);
?>