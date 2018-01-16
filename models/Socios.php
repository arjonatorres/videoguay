<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "socios".
 *
 * @property int $id
 * @property string $numero
 * @property string $nombre
 * @property string $dirección
 * @property string $telefono
 *
 * @property Alquileres[] $alquileres
 */
class Socios extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'socios';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['numero', 'nombre'], 'required'],
            [['numero', 'telefono'], 'number'],
            [['nombre', 'dirección'], 'string', 'max' => 255],
            [['numero'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'numero' => 'Numero',
            'nombre' => 'Nombre',
            'dirección' => 'Dirección',
            'telefono' => 'Telefono',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlquileres()
    {
        return $this->hasMany(Alquileres::className(), ['socio_id' => 'id'])->inverseOf('socio');
    }
}
