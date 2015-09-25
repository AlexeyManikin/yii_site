<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "regru_providers".
 *
 * @property integer $id
 * @property string $date_create
 * @property string $name
 * @property string $description
 * @property string $link
 * @property string $type
 * @property string $status
 * @property integer $count_ns
 */
class RegruProviders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'regru_providers';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_create', 'name', 'link'], 'required'],
            [['date_create'], 'safe'],
            [['count_ns'], 'integer'],
            [['name', 'description', 'link', 'type', 'status'], 'string', 'max' => 255],
            [['name'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_create' => 'Date Create',
            'name' => 'Name',
            'description' => 'Description',
            'link' => 'Link',
            'type' => 'Type',
            'status' => 'Status',
            'count_ns' => 'Count Ns',
        ];
    }


    /**
     * @inheritdoc
     * @return RegruProvidersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RegruProvidersQuery(get_called_class());
    }
}
