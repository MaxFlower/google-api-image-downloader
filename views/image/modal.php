<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Image */
?>

<div class="container" style="width: 100%">    

    <?php
       if ($model->link!='') {
         echo '<img style="width: 100%" src="'.Yii::$app->homeUrl.'uploads/'.basename($model->link).'">';
       }    
    ?>

</div>