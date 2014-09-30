<?php

/**
 * This is the model base class for the table "{{locations}}".
 *
 * Columns in table "{{locations}}" available as properties of the model:
 
      * @property integer $id
      * @property string $site_name
      * @property string $site_type
      * @property string $site_code
      * @property string $status
      * @property string $remarks
      * @property integer $mynumbers
 *
 * There are no model relations.
 */
abstract class BaseLocations extends CActiveRecord {
    
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return '{{locations}}';
    }

    public function rules() {
        return array(
            array('site_name, site_type, site_code, status', 'required'),
            array('remarks, mynumbers', 'default', 'setOnEmpty' => true, 'value' => null),
            array('mynumbers', 'numerical', 'integerOnly' => true),
            array('site_name, remarks', 'length', 'max' => 128),
            array('site_type, status', 'length', 'max' => 32),
            array('site_code', 'length', 'max' => 8),
            array('id, site_name, site_type, site_code, status, remarks, mynumbers', 'safe', 'on' => 'search'),
        );
    }
    
    public function __toString() {
        return (string) $this->site_name;
    }

    public function behaviors() {
        return array();
    }

    public function relations() {
        return array(
        );
    }

    public function attributeLabels() {
        return array(
            'id' => Yii::t('app', 'ID'),
            'site_name' => Yii::t('app', 'Site Name'),
            'site_type' => Yii::t('app', 'Site Type'),
            'site_code' => Yii::t('app', 'Site Code'),
            'status' => Yii::t('app', 'Status'),
            'remarks' => Yii::t('app', 'Remarks'),
            'mynumbers' => Yii::t('app', 'Mynumbers'),
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('site_name', $this->site_name, true);
        $criteria->compare('site_type', $this->site_type, true);
        $criteria->compare('site_code', $this->site_code, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('remarks', $this->remarks, true);
        $criteria->compare('mynumbers', $this->mynumbers);

        return new CActiveDataProvider(get_class($this), array(
                    'criteria' => $criteria,
                ));
    }
    
}