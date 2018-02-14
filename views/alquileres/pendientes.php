<?php
use yii\grid\GridView;

use yii\data\ActiveDataProvider;
?>
<?php if (!$pendientes->exists()): ?>
    <h3>No tiene alquileres pendientes</h3>
<?php else: ?>
    <h3>Alquileres pendientes</h3>
    <?= GridView::widget([
        'dataProvider' => new ActiveDataProvider([
            'query' => $pendientes,
            'pagination' => false,
            'sort' => false,
        ]),
        'columns' => [
            'pelicula.codigo',
            'pelicula.titulo',
            'created_at:datetime',
        ],
    ]) ?>
<?php endif ?>
