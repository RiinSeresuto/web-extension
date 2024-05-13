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
      echo Html::img(Yii::$app->urlManager->createUrl(['carousel/image-banner/', 'item_id' => $banner->id]), ['style' => 'width: 150px; height: 75px;']);
      ?>
    </div>
  <?php endforeach; ?>
</div>

<?php

$script = <<<JS
$(".dilg-systems").slick({
  dots: false,
  infinite: false,
  // speed: 400,
  slidesToShow: 7,
  // slidesToScroll: 1,
  arrows: false,
  autoplay: true,
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
  ]});

JS;

$this->registerJs($script);
?>