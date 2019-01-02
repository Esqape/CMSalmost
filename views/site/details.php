<?php

/* @var $this yii\web\View */
/* @var $model app\models\User */

use yii\helpers\Html;
use app\widgets\Alert;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

$this->title = 'User details';

?>

<div class=body-content>
        <div>

            <h2>
                <b><?php echo $model->username; ?></b>
            </h2>
            <h5>
            <label>User Email : </label>  <label> <?= $model->email; ?> </label>
            </h5>
            <h5>
            <label>User Role : </label>  <label><?= Yii::$app->getUser()->identity->role; ?></label> 
            
            </h5>
        </div>

        <div class=jumbotron>
        <p class="lead">Click here to view Posts that you have created.</p>
        <p><a class="btn btn-sm btn-primary" href="/posts?PostsSearch%5Bpost_id%5D=&PostsSearch%5Btitle%5D=&PostsSearch%5Bbody%5D=&PostsSearch%5Bcreated_at%5D=&PostsSearch%5Bupdated_at%5D=&PostsSearch%5Bauthor%5D=<?= $model->username ?>&PostsSearch%5Bimage_url%5D=&PostsSearch%5Bvideo_url%5D=">Your Posts</a></p>
        </div>

        <div>
            <p>
                <label>Role Legend : <br> 3 --> Content Creator <br>  2 --> Admin <br>   1 --> Super Admin </label>
            </p>
        </div>
</div>