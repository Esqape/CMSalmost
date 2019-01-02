<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Posts */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="posts-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->post_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->post_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'post_id',
            'title',
            'body:ntext',
            'created_at',
            'updated_at',
            'author',
            'image_url',
            'video_url',
        ],
    ]) ?>

</div>


<div>
<?php
    if(!($model->image_url==""))
    {
 ?>

        
        <div class="split left" style="height:250px;float:left; margin:10px;">
        <h5><b>Image Preview</b></h5>
        <img src="/<?= $model->image_url ?>"  style="max-height:250px;max-width:100%">
        </div>

        



<?php

    }

    if(!($model->video_url==""))
    {
?>



<div class="split right" style="float:left; margin:10px;">
<h5><b>Play Video</b></h5>
        <?= 
        //VideoJS extension used to play videos
        //https://github.com/perminder-klair/yii2-videojs
        
        \kato\VideojsWidget::widget([
                            'options' => [
                                'class' => 'video-js vjs-default-skin vjs-big-play-centered',
                                'poster' => 'vidPreview.jpg',
                                'controls' => true,
                                'preload' => 'auto',
                                'width' => '485',
                                'height' => '200',
                                'data-setup' => '{ "plugins" : { "resolutionSelector" : { "default_res" : "360" } } }',
                            ],
                            'tags' => [
                                'source' => [
                                    ['src' => '/'.$model->video_url, 'type' => 'video/mp4', ],
                                ],
                            ],
                            'multipleResolutions' => true,
                        ]); ?>
        </div>



<?php
    }

    ?>

</div>