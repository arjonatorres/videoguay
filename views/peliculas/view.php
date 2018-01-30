<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Peliculas */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Peliculas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peliculas-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'codigo',
            'titulo',
            'precio_alq',
        ],
    ]) ?>

    <h3>Últimos alquileres de esta película</h3>

    <table class="table">
        <thead>
            <th>Número</th>
            <th>Nombre</th>
            <th>Fecha de alquiler</th>
            <th>Fecha de devolución</th>
        </thead>
        <tbody>
            <?php foreach ($alquileres as $alquiler): ?>
                <tr>
                    <td><?= Html::encode($alquiler->socio->numero) ?></td>
                    <td><?= Html::a(Html::encode($alquiler->socio->nombre),
                    [
                        'socios/view',
                        'id' => $alquiler->socio->id,
                        ]) ?></td>
                    <td><?= Html::encode(Yii::$app->formatter->asDatetime($alquiler->created_at)) ?></td>
                    <?php if($alquiler->devolucion === null): ?>
                        <?= Html::beginForm(['alquileres/devolver', 'numero' => $alquiler->socio->numero], 'post') ?>
                            <?= Html::hiddenInput('id', $alquiler->id) ?>
                            <td><?= Html::submitButton('Devolver', ['class' => 'btn btn-xs btn-danger']) ?></td>
                        <?= Html::endForm() ?>
                    <?php else: ?>
                        <td><?= Yii::$app->formatter->asDatetime($alquiler->devolucion) ?></td>
                    <?php endif ?>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

</div>
