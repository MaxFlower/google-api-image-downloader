<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * QueryForm is the model behind the query form.
 */
class QueryForm extends Model
{
    public $query;
    
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
