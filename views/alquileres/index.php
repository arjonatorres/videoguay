<?php

use yii\helpers\Html;
use yii\grid\GridView;

use kartik\datecontrol\DateControl;
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
                'filter' => DateRangePicker::widget([
                    'convertFormat' => true,
                    'pluginOptions'=>[
                        'locale'=>[
                            'format'=>'d-m-Y',
                            'separator'=>'/',
                        ],
                        'opens'=>'left'
                    ],

                    // 'type' => DateControl::FORMAT_DATE,
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
