<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "as_list".
 *
 * @property integer $id
 * @property string $descriptions
 * @property string $country
 * @property string $date_register
 * @property string $organization_register
 */
class AsList extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'as_list';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'required'],
            [['id'], 'integer'],
            [['date_register'], 'safe'],
            [['descriptions'], 'string', 'max' => 255],
            [['country', 'organization_register'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'descriptions' => 'Descriptions',
            'country' => 'Country',
            'date_register' => 'Date Register',
            'organization_register' => 'Organization Register',
        ];
    }

    /**
     * @inheritdoc
     * @return AsListQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new AsListQuery(get_called_class());
    }
}
