<?php

namespace app\controllers;

use Yii;
use app\models\Posts;
use app\models\UploadForm;
use app\models\PostsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\UploadedFile;

/**
 * PostsController implements the CRUD actions for Posts model.
 */
class PostsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [

            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['index'],
                        'roles' => ['createPost'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view'],
                        'roles' => ['createPost'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create'],
                        'roles' => ['createPost'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['update'],
                        'roles' => ['updatePost'],
                        'roleParams' => function() {
                            return ['posts' => Posts::findOne(['post_id' => Yii::$app->request->get('id')])];
                        },
                    ],
                    [
                        'allow' => true,
                        'actions' => ['delete'],
                        'roles' => ['deletePost'],
                        'roleParams' => function() {
                            return ['posts' => Posts::findOne(['post_id' => Yii::$app->request->get('id')])];
                        },
                    ],
                ],
            ],


            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    //disable CSRF vlaidation to upload video
    //Get responses in JSON format
    public function beforeAction($action)
    {
        $this->enableCsrfValidation = false;
        //Yii::$app->reponse->format=\yii\web\Response::FORMAT_JSON;
        return parent::beforeAction($action);
    }

    /**
     * Lists all Posts models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Posts model.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }



    /**
     * Creates a new Posts model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {

        $model1 = new UploadForm();

        $imgfname="";
        $vidfname="";
    
        
        if ($model1->load(Yii::$app->request->post())) {


            $model1->file = UploadedFile::getInstance($model1, 'file');
            $model1->vidfile = UploadedFile::getInstance($model1, 'vidfile');
    
            if ($model1->file && $model1->validate()) {                
                $model1->file->saveAs('uploads/' . $model1->file->baseName .'-'.Yii::$app->formatter->asTimestamp(date(date('Y-m-d H:i:s'))). '.' . $model1->file->extension);
                $imgfname='uploads/'.$model1->file->baseName .'-'.Yii::$app->formatter->asTimestamp(date(date('Y-m-d H:i:s'))). '.' . $model1->file->extension;
            
            }

            

            if ($model1->vidfile) {                
                $model1->vidfile->saveAs('uploads/' . $model1->vidfile->baseName .'-'.Yii::$app->formatter->asTimestamp(date(date('Y-m-d H:i:s'))). '.' . $model1->vidfile->extension);
                $vidfname='uploads/'.$model1->vidfile->baseName .'-'.Yii::$app->formatter->asTimestamp(date(date('Y-m-d H:i:s'))). '.' . $model1->vidfile->extension;
            }

        }


        $model = new Posts();

        //assign the upload filename to the model attributes
        $model->image_url=$imgfname;
        $model->video_url=$vidfname;
 

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->post_id]);
        }

        return $this->render('create', [
            'model' => $model,
            'model1' =>$model1,
        ]);
    }

    /**
     * Updates an existing Posts model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {

        //handle file changes
        $model1 = new UploadForm();
        $model = $this->findModel($id);

        $imgfname="";
        $vidfname="";

        $imgfname=$model->image_url;
        $vidfname=$model->video_url;
    
        
        if ($model1->load(Yii::$app->request->post())) {


            $model1->vidfile = UploadedFile::getInstance($model1, 'vidfile');
            $model1->file = UploadedFile::getInstance($model1, 'file');
    
            if ($model1->file && $model1->validate()) {                
                $model1->file->saveAs('uploads/' . $model1->file->baseName .'-'.Yii::$app->formatter->asTimestamp(date(date('Y-m-d H:i:s'))). '.' . $model1->file->extension);
                $imgfname='uploads/'.$model1->file->baseName .'-'.Yii::$app->formatter->asTimestamp(date(date('Y-m-d H:i:s'))). '.' . $model1->file->extension;
            
            }

            if ($model1->vidfile) {                
                $model1->vidfile->saveAs('uploads/' . $model1->vidfile->baseName .'-'.Yii::$app->formatter->asTimestamp(date(date('Y-m-d H:i:s'))). '.' . $model1->vidfile->extension);
                $vidfname='uploads/'.$model1->vidfile->baseName .'-'.Yii::$app->formatter->asTimestamp(date(date('Y-m-d H:i:s'))). '.' . $model1->vidfile->extension;
            }

            
        }

        //assign the upload filename to the model attributes
        $model->image_url=$imgfname;
        $model->video_url=$vidfname;


        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->post_id]);
        }

        return $this->render('update', [
            'model' => $model,
            'model1' =>$model1,
        ]);
    }

    /**
     * Deletes an existing Posts model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Posts model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Posts the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Posts::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
