<?php

/* @var $this yii\web\View */
/* @var $allowfullscreen bool */
/* @var $latitude string */
/* @var $longitude string */
/* @var $width string */
/* @var $height string */

?>

<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d8537.78719837467!2d<?= $latitude ?>!3d<?= $longitude ?>49999995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sru!2sru!4v1519909241917"
        width="<?= $width ?>" height="<?= $height ?>" frameborder="0" style="border:0"
        <? if ($allowfullscreen) { ?>allowfullscreen><? } ?></iframe>