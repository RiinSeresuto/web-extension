<?php

use yii\helpers\Html;

?>

<!-- DILG Systems Banner-->

<div class="dilg-systems slider">
        <div>
            <?= Html::a(
                        Html::img('@web/images/dilg-systems/citizens-charter.png')
                    ); ?>
        </div>
        <div>
            <?= Html::a(
                        Html::img('@web/images/dilg-systems/citizens-charter.png')
                    ); ?>
        </div>
        <div>
            <?= Html::a(
                        Html::img('@web/images/dilg-systems/citizens-charter.png')
                    ); ?>
        </div>
        <div>
            <?= Html::a(
                        Html::img('@web/images/dilg-systems/citizens-charter.png')
                    ); ?>
        </div>
        <div>
            <?= Html::a(
                        Html::img('@web/images/dilg-systems/citizens-charter.png')
                    ); ?>
        </div>
        <div>
            <?= Html::a(
                        Html::img('@web/images/dilg-systems/citizens-charter.png')
                    ); ?>
        </div>
        <div>
            <?= Html::a(
                        Html::img('@web/images/dilg-systems/citizens-charter.png')
                    ); ?>
        </div>
        <div>
            <?= Html::a(
                        Html::img('@web/images/dilg-systems/citizens-charter.png')
                    ); ?>
        </div>
        <div>
            <?= Html::a(
                        Html::img('@web/images/dilg-systems/citizens-charter.png')
                    ); ?>
        </div>
        <div>
            <?= Html::a(
                        Html::img('@web/images/dilg-systems/citizens-charter.png')
                    ); ?>
        </div>
        <div>
            <?= Html::a(
                        Html::img('@web/images/dilg-systems/citizens-charter.png')
                    ); ?>
        </div>
        <div>
            <?= Html::a(
                        Html::img('@web/images/dilg-systems/citizens-charter.png')
                    ); ?>
        </div>
        <div>
            <?= Html::a(
                        Html::img('@web/images/dilg-systems/citizens-charter.png')
                    ); ?>
        </div>
        <div>
            <?= Html::a(
                        Html::img('@web/images/dilg-systems/citizens-charter.png')
                    ); ?>
        </div>
        <div>
            <?= Html::a(
                        Html::img('@web/images/dilg-systems/citizens-charter.png')
                    ); ?>
        </div>
</div>

<?php 

$script = <<<JS
$(".dilg-systems").slick({
          // centerMode: true,
          // autoplay: true,
          // autoplaySpeed: 3000,
          // centerPadding: "60px",
          // slidesToShow: 3,
          // arrows: false,
          // responsive: [
          //   {
          //     breakpoint: 768,
          //     settings: {
          //       arrows: false,
          //       centerMode: true,
          //       centerPadding: "40px",
          //       slidesToShow: 3,
          //     },
          //   },
          //   {
          //     breakpoint: 480,
          //     settings: {
          //       arrows: false,
          //       centerMode: true,
          //       centerPadding: "40px",
          //       slidesToShow: 1,
          //     },
          //   },
          // ],

          // $('.responsive').slick({
  dots: false,
  infinite: false,
  speed: 300,
  slidesToShow: 10,
  slidesToScroll: 10,
  arrows: false,
  autoplay: true,
  autoplaySpeed: 2000,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 3,
        slidesToScroll: 3,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 2
      }
    },
    {
      breakpoint: 480,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }
    // You can unslick at a given breakpoint now by adding:
    // settings: "unslick"
    // instead of a settings object
  ]
});

        //});
JS;

$this->registerJs($script);
?>