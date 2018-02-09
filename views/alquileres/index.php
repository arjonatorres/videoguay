<?php

use yii\helpers\Html;
use yii\grid\GridView;

use kartik\daterange\DateRangePicker;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AlquileresSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Alquileres';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="alquileres-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php //echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Alquileres', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'socio.numero:text:Número del socio',
            'socio.nombre:text:Nombre del socio',
            'pelicula.codigo:text:Código de la película',
            'pelicula.titulo:text:Título de la película',
            [
                'attribute' => 'created_at',
                'content' => function($model, $key, $index, $column) use ($searchModel) {
                    return Html::a(
                        Yii::$app->formatter->asDatetime($model->created_at),
                        [
                            'alquileres/index',
                            $searchModel->formName() . '[created_at]'
                                => date('d-m-Y', strtotime($model->created_at))
                                . ' a ' . date('d-m-Y', strtotime($model->created_at)),
                        ]
                    );
                },
                'filter' => DateRangePicker::widget([
                    'convertFormat' => true,
                    'pluginOptions'=>[
                        'locale'=>[
                            'format'=> 'd-m-Y',
                            'separator'=>' a ',
                        ],
                        'opens'=>'left'
                    ],
                    'model' => $searchModel,
                    'attribute' => 'created_at',
                ]),
                'format' => 'datetime',
            ],
            'devolucion:datetime',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
