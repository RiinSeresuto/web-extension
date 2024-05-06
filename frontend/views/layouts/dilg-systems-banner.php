<?php

use common\helpers\Carousel;
use yii\helpers\Html;

?>

<!-- Banner-->
<div class="dilg-systems slider">
  <?php $banners = Carousel::getBanner() ?>
  <?php foreach ($banners as $banner): ?>
    <div class="dilg-systems-banner-item">
      <?php
      echo Html::img(Yii::$app->urlManager->createUrl(['carousel/image-banner/', 'item_id' => $banner->id]), ['style' => 'width: 115px; height: 50px;']);
      ?>
    </div>
  <?php endforeach; ?>
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
  speed: 400,
  slidesToShow: 10,
  slidesToScroll: 10,
  arrows: false,
  autoplay: false,
  autoplaySpeed: 3000,
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