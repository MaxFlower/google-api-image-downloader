<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Image;

/**
 * QueryForm is the model behind the query form.
 */
class QueryForm extends Model
{
    public $query;
    public $dataProvider;
    
    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            //query is required
            [['query'], 'required'],           
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }    
}
