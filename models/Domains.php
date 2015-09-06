<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "domain".
 *
 * @property integer $id
 * @property string $domain_name
 * @property string $registrant
 * @property string $tld
 * @property string $register_date
 * @property string $register_date_end
 * @property string $free_date
 * @property string $delegated
 * @property string $a1
 * @property string $a2
 * @property string $a3
 * @property string $a4
 * @property string $ns1
 * @property string $ns2
 * @property string $ns3
 * @property string $ns4
 * @property string $mx1
 * @property string $mx2
 * @property string $mx3
 * @property string $mx4
 * @property string $txt
 * @property integer $asn1
 * @property integer $asn2
 * @property integer $asn3
 * @property integer $asn4
 * @property string $aaaa1
 * @property string $aaaa2
 * @property string $aaaa3
 * @property string $aaaa4
 * @property string $cname
 * @property string $nserrors
 * @property string $load_today
 * @property string $last_update
 */
class Domains extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'domain';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['register_date', 'register_date_end', 'free_date', 'last_update'], 'safe'],
            [['delegated', 'load_today'], 'string'],
            [['asn1', 'asn2', 'asn3', 'asn4'], 'integer'],
            [['domain_name'], 'string', 'max' => 256],
            [['registrant'], 'string', 'max' => 64],
            [['tld'], 'string', 'max' => 32],
            [['a1', 'a2', 'a3', 'a4'], 'string', 'max' => 16],
            [['ns1', 'ns2', 'ns3', 'ns4'], 'string', 'max' => 45],
            [['mx1', 'mx2', 'mx3', 'mx4'], 'string', 'max' => 70],
            [['txt'], 'string', 'max' => 255],
            [['aaaa1', 'aaaa2', 'aaaa3', 'aaaa4', 'cname'], 'string', 'max' => 55],
            [['nserrors'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'domain_name' => 'Domain Name',
            'registrant' => 'Registrant',
            'tld' => 'Tld',
            'register_date' => 'Register Date',
            'register_date_end' => 'Register Date End',
            'free_date' => 'Free Date',
            'delegated' => 'Delegated',
            'a1' => 'A1',
            'a2' => 'A2',
            'a3' => 'A3',
            'a4' => 'A4',
            'ns1' => 'Ns1',
            'ns2' => 'Ns2',
            'ns3' => 'Ns3',
            'ns4' => 'Ns4',
            'mx1' => 'Mx1',
            'mx2' => 'Mx2',
            'mx3' => 'Mx3',
            'mx4' => 'Mx4',
            'txt' => 'Txt',
            'asn1' => 'Asn1',
            'asn2' => 'Asn2',
            'asn3' => 'Asn3',
            'asn4' => 'Asn4',
            'aaaa1' => 'Aaaa1',
            'aaaa2' => 'Aaaa2',
            'aaaa3' => 'Aaaa3',
            'aaaa4' => 'Aaaa4',
            'cname' => 'Cname',
            'nserrors' => 'Nserrors',
            'load_today' => 'Load Today',
            'last_update' => 'Last Update',
        ];
    }

    /**
     * @inheritdoc
     * @return DomainsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DomainsQuery(get_called_class());
    }
}
