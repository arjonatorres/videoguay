<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Cuenta activada';
?>
<div class="usuario-validado">

    <div class="alert alert-success">
        Su cuenta ha sido activada correctamente.
    </div>

    <?= Html::a('Login', '/site/login', ['class' => 'btn btn-primary']) ?>


</div>
