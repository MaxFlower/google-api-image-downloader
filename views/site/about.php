<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\UserQuery */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\grid\GridView;
use yii\widgets\Pjax;


$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        Do request. First 10 images from Google-Search will be saved under 'upload' folder.<br/>
        See results on the 'Result page':
    </p>

    <?php $form = ActiveForm::begin([
        'id' => 'query-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'query')->textInput(['autofocus' => true]) ?>        

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Query', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>

    <?php ActiveForm::end(); ?>

    <?php 
        if ($dataProvider) {
            echo "<h3>Request results:</h3><br /> \n";
            foreach ($dataProvider as $item) {    
              echo '<div class="results-img"><img src="' . $item['image']['thumbnailLink'] . '" ></div>';      
            }
        }
    ?>
</div>



