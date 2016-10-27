<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\bootstrap\Modal;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ImageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Images';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php Pjax::begin(['id' => 'imagesTable', 'enablePushState' => false]); ?>

    <?php
    if ($dataProvider) {
        echo GridView::widget([
            'dataProvider' => $dataProvider,        
            'columns' => [
                'id',
                'title',                
                'bytesSize',                
                [
                    'attribute' => 'Image',
                    'format' => 'raw',
                    'value' => function ($model, $key) {                     
                        return Html::a( '<img src="'. $model->thumbnailLink .'" width="50px" height="auto">', '#', [
                            'class' => 'view-link',                                
                            'data-toggle'=>'modal',
                            'title' => Yii::t('yii', 'View'),
                            'data-target'=>'#modal',
                            'data-id' => $key,
                            'data-pjax' => '0',                             
                        ]);
                    },
                ],

                ['class' => 'yii\grid\ActionColumn',
                    'template' => '{view} {update}',
                    'buttons' => [
                        'view' => function ($url, $model, $key) {                           
                            return Html::a( '<span class="glyphicon glyphicon-eye-open"></span>', $url);
                        },
                        'update' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url);
                        },                        
                    ],
                ],
                
            ],
        ]);
    } else {
        echo Alert::widget([
            'options' => [
                'class' => 'alert-danger'
            ],
            'body' => '<b>Error!</b> DB is empty!'
        ]);
    }
    ?>
    <?php Pjax::end(); ?>
</div>

<?php 
Modal::begin([    
    'id'=>'modal',
    'size'=>'modal-lg',    
]);

echo "<div id='modalContent'></div>";

Modal::end(); ?>