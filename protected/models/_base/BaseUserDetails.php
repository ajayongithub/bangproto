<?php

/**
 * This is the model base class for the table "{{user_details}}".
 *
 * Columns in table "{{user_details}}" available as properties of the model:
 
      * @property integer $id
      * @property string $location
      * @property string $raw_data
      * @property string $email
      * @property string $first_name
      * @property string $gender
      * @property string $fid
      * @property string $last_name
      * @property string $link
      * @property string $locale
      * @property string $name
      * @property string $timezone
      * @property string $updated_time
      * @property string $verified
      * @property string $status
      * @property string $original_video
      * @property string $composite_video
      * @property string $posting_status
      * @property string $remarks
      * @property string $extra
 *
 * There are no model relations.
 */
abstract class BaseUserDetails extends CActiveRecord {
    
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function tableName() {
        return '{{user_details}}';
    }

    public function rules() {
        return array(
            array('location, raw_data, email, first_name, gender, fid, link, locale, name, timezone, updated_time, verified', 'required'),
            array('last_name, status, original_video, composite_video, posting_status, remarks, extra', 'default', 'setOnEmpty' => true, 'value' => null),
            array('email', 'email'),
            array('link', 'url', 'defaultScheme' => 'http'),
            array('location, email, name, updated_time, remarks', 'length', 'max' => 128),
            array('raw_data', 'length', 'max' => 1024),
            array('first_name, fid, last_name, posting_status', 'length', 'max' => 64),
            array('gender, verified', 'length', 'max' => 16),
            array('link, original_video, composite_video, extra', 'length', 'max' => 256),
            array('locale, timezone, status', 'length', 'max' => 32),
            array('id, location, raw_data, email, first_name, gender, fid, last_name, link, locale, name, timezone, updated_time, verified, status, original_video, composite_video, posting_status, remarks, extra', 'safe', 'on' => 'search'),
        );
    }
    
    public function __toString() {
        return (string) $this->location;
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
            'location' => Yii::t('app', 'Location'),
            'raw_data' => Yii::t('app', 'Raw Data'),
            'email' => Yii::t('app', 'Email'),
            'first_name' => Yii::t('app', 'First Name'),
            'gender' => Yii::t('app', 'Gender'),
            'fid' => Yii::t('app', 'Fid'),
            'last_name' => Yii::t('app', 'Last Name'),
            'link' => Yii::t('app', 'Link'),
            'locale' => Yii::t('app', 'Locale'),
            'name' => Yii::t('app', 'Name'),
            'timezone' => Yii::t('app', 'Timezone'),
            'updated_time' => Yii::t('app', 'Updated Time'),
            'verified' => Yii::t('app', 'Verified'),
            'status' => Yii::t('app', 'Status'),
            'original_video' => Yii::t('app', 'Original Video'),
            'composite_video' => Yii::t('app', 'Composite Video'),
            'posting_status' => Yii::t('app', 'Posting Status'),
            'remarks' => Yii::t('app', 'Remarks'),
            'extra' => Yii::t('app', 'Action Seq'),
        );
    }

    public function search() {
        $criteria = new CDbCriteria;

        $criteria->compare('id', $this->id);
        $criteria->compare('location', $this->location, true);
        $criteria->compare('raw_data', $this->raw_data, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('first_name', $this->first_name, true);
        $criteria->compare('gender', $this->gender, true);
        $criteria->compare('fid', $this->fid, true);
        $criteria->compare('last_name', $this->last_name, true);
        $criteria->compare('link', $this->link, true);
        $criteria->compare('locale', $this->locale, true);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('timezone', $this->timezone, true);
        $criteria->compare('updated_time', $this->updated_time, true);
        $criteria->compare('verified', $this->verified, true);
        $criteria->compare('status', $this->status, true);
        $criteria->compare('original_video', $this->original_video, true);
        $criteria->compare('composite_video', $this->composite_video, true);
        $criteria->compare('posting_status', $this->posting_status, true);
        $criteria->compare('remarks', $this->remarks, true);
        $criteria->compare('extra', $this->extra, true);
        $criteria->order = 'id DESC ';
        return new CActiveDataProvider(get_class($this), array(
        		'pagination'=>array(
        				'pageSize'=> Yii::app()->user->getState('pageSize',50),
        		),
        		'criteria' => $criteria,
        		
                ));
    }

    public function searchVideoPoint() {
    	$criteria = new CDbCriteria;
    
    	$criteria->compare('id', $this->id);
    	$criteria->compare('location', $this->location, true);
    	$criteria->compare('raw_data', $this->raw_data, true);
    	$criteria->compare('email', $this->email, true);
    	$criteria->compare('first_name', $this->first_name, true);
    	$criteria->compare('gender', $this->gender, true);
    	$criteria->compare('fid', $this->fid, true);
    	$criteria->compare('last_name', $this->last_name, true);
    	$criteria->compare('link', $this->link, true);
    	$criteria->compare('locale', $this->locale, true);
    	$criteria->compare('name', $this->name, true);
    	$criteria->compare('timezone', $this->timezone, true);
    	$criteria->compare('updated_time', $this->updated_time, true);
    	$criteria->compare('verified', $this->verified, true);
    	$criteria->compare('status', $this->status, true);
    	$criteria->compare('original_video', $this->original_video, true);
    	$criteria->compare('composite_video', $this->composite_video, true);
    	$criteria->compare('posting_status', $this->posting_status, true);
    	$criteria->compare('remarks', $this->remarks, true);
    	$criteria->compare('extra', $this->extra, true);
   		$criteria->order = 'status ASC, id DESC'; 
    	return new CActiveDataProvider(get_class($this), array(
    			'criteria' => $criteria,
    	));
    }
}