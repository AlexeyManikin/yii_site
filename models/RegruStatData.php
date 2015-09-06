<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "regru_stat_data".
 *
 * @property integer $id
 * @property string $date
 * @property integer $provider_id
 * @property integer $value
 */
class RegruStatData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'regru_stat_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date', 'value'], 'required'],
            [['date'], 'safe'],
            [['provider_id', 'value'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date' => 'Date',
            'provider_id' => 'Provider ID',
            'value' => 'Value',
        ];
    }

    /**
     * @inheritdoc
     * @return RegruStatDataQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RegruStatDataQuery(get_called_class());
    }
}
