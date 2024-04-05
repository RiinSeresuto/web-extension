<?php

use yii\helpers\Html;

?>

<div class="dilg-info-system slider">
    <div class="card">
        <div class="card-header">
            <h3>Advisory</h3>
        </div>
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
          arrows: false,
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