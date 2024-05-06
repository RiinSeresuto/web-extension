<?php

use common\helpers\Carousel;
use yii\helpers\Html;

?>

<!-- DILG Systems Banner-->
<div class="dilg-info-systems slider">
  <?php $systems = Carousel::getInfoSystem() ?>
  <?php foreach ($systems as $system): ?>
    <div class="dilg-systems-item">
      <?php
      echo Html::img(Yii::$app->urlManager->createUrl(['carousel/image-dilg-system/', 'item_id' => $system->id]), ['style' => 'width: 115px; height: 50px;']);
      ?>
    </div>
  <?php endforeach; ?>
</div>

<?php

$script = <<<JS
$(".dilg-info-systems").slick({
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
  ]
});
JS;

$this->registerJs($script);
?>