<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'About';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        This is a content management system (CMS) prototype Web Application that allows the School authorized personnel to create
         and manage content for the SCMA Interactive Student Handbook website and app.  
    </p>
    <p>
        Users can be assigned different roles which have different functionality associated with them.
    </p>
    <p>
    <ul>
        <li>
            A 'Content Creator' can add content by creating 'Posts' which contains text content as well as image and video content.
            A Content creator can update and delete only their own Posts.
        </li>

        <li>
            An 'Admin' can do everything a Content Creator can do and more! An Admin can update or/and delete Posts of everyone else.
        </li>

        <li>
            A 'Super Admin' can do everything an Admin can do and more! A super admin can create Admin and Content Creator user accounts.
        </li>

    </ul>
    </p>

</div>
