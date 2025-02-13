<?php

use yii\helpers\Html;

use common\helpers\Carousel;

?>

<!-- Slider Photo -->
<div class="slider-photo slider">
  <?php $carousel_images = Carousel::getPhoto() ?>
  <?php foreach ($carousel_images as $carousel_image): ?>
    <div class="slider-photo-item slick-slide.slick-center">
      <?php
      echo Html::img(Yii::$app->urlManager->createUrl(['carousel/image-slider/', 'item_id' => $carousel_image->id]), ['style' => 'width: 380px; height: 250px;']);
      ?>
    </div>
  <?php endforeach; ?>
</div>

<?php

$script = <<<JS
$(".slider-photo").slick({
          centerMode: true,
          autoplay: true,
          autoplaySpeed: 3000,
          centerPadding: "480px",
          slidesToShow: 1,
          arrows: false,
          responsive: [
            {
              breakpoint: 768,
              settings: {
                arrows: false,
                centerMode: true,
                centerPadding: "40px",
                slidesToShow: 1,
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