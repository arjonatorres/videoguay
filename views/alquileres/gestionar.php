<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var $this \yii\web\View */
/** @var $model \app\models\GestionarForm */
?>

<div class="row">
    <div class="col-md-6">
        <?php $form = ActiveForm::begin() ?>

            <?= $form->field($model, 'numero') ?>

            <div class="form-group">
                <?= Html::submitButton('Buscar', ['class' => 'btn btn-success']) ?>
            </div>

        <?php ActiveForm::end() ?>
    </div>
    <div class="col-md-6">
        <h3><?= Html::encode($socio->nombre) ?></h3>
        <h3><?= Html::encode($socio->telefono) ?></h3>
    </div>
</div>

<div class="row">
    <table class="table">
        <thead>
            <th>Número</th>
            <th>Nombre</th>
            <th>Fecha de alquiler</th>
        </thead>
        <tbody>
            <?php if (isset($socio)): ?>
                <?php foreach ($socio->getPendientes()->with('pelicula')->all() as $alquiler): ?>
                    <tr>
                        <td><?= Html::encode($alquiler->pelicula->codigo) ?></td>
                        <td><?= Html::encode($alquiler->pelicula->titulo) ?></td>
                        <td><?= Html::encode($alquiler->created_at) ?></td>
                    </tr>
                <?php endforeach ?>
            <?php endif ?>
        </tbody>
    </table>
</div>
