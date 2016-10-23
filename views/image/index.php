<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ImageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Images';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,        
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'title',            
            'link',
            'bytesSize',
            'thumbnailLink',
            // [
            //     'attribute' => 'Image',
            //     'format' => 'raw',
            //     'value' => function ($model) {   
            //         if ($model->thumbnailLink!='') {
            //             return '<img src="'. $model->thumbnailLink .'" width="50px" height="auto">'; else return 'no image';
            //         }
            //     },
            // ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
