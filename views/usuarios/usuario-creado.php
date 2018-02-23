<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Cuenta creada';
?>
<div class="usuario-creado">

    <div class="alert alert-success">
        Su cuenta ha sido creada correctamente. Para activar su cuenta pulse en el enlace del email que se le ha enviado.
    </div>

    <?= Html::a('Home', '/site/index', ['class' => 'btn btn-primary']) ?>


</div>
