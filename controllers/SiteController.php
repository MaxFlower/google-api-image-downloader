<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\QueryForm;
use app\models\Image;
use \Google_Client;
use \Google_Service_Customsearch;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        $model = new QueryForm();
        $image = new Image();

        $client = new Google_Client();
        $client->setApplicationName('TEST-APP');
        $client->setDeveloperKey('AIzaSyDiGsDRa-u8XWydPdqYWmE0yqHan3NLMTw');        

        $customerSearch = new Google_Service_Customsearch($client);
        $cse = $customerSearch->cse;

        if ($model->load(Yii::$app->request->post())) {
            Image::deleteAll();

            $files = glob('uploads/*'); // get all file names
            foreach($files as $file){
              if(is_file($file))
                unlink($file); // delete file
            }

            $results = $cse->listCse($model['query'], [                      
                'num' => '3',
                'searchType' => 'image',
                'cx' => '002574095571881191860:dd6urzagoou',
            ]);            

            $dataProvider = $results['items'];

            foreach ($dataProvider as $key => $item) {          
                $image = new Image();
                $image->title = $item->title;
                $image->htmlTitle = $item->htmlTitle;
                $image->link = $item->link;

                $imageObject = $item->image;
                $image->bytesSize = $imageObject->byteSize;
                $image->thumbnailLink = $imageObject->thumbnailLink;

                $image->save();

                $url = $item->link;
                $name = basename($url);
                $data = file_get_contents($url);                
                file_put_contents("uploads/$name", $data);
            }                                   
        }

        return $this->render('about', [
            'model' => $model,
            'dataProvider' => $dataProvider
        ]);
    }
}
