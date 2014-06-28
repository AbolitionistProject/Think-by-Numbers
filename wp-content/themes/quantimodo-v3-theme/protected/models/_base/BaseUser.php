<?php

/**
 * This is the model base class for the table "Users".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "User".
 *
 * Columns in table "Users" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $ID
 * @property string $email
 * @property string $regdate
 * @property string $name
 * @property string $password
 *
 */
abstract class BaseUser extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'Users';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'User|Users', $n);
	}

	public static function representingColumn() {
		return 'regdate';
	}

	public function rules() {
		return array(
			array('regdate', 'required'),
			array('email, name', 'length', 'max'=>50),
			array('password', 'length', 'max'=>16),
			array('email, name, password', 'default', 'setOnEmpty' => true, 'value' => null),
			array('ID, email, regdate, name, password', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'ID' => Yii::t('app', 'ID'),
			'email' => Yii::t('app', 'Email'),
			'regdate' => Yii::t('app', 'Regdate'),
			'name' => Yii::t('app', 'Name'),
			'password' => Yii::t('app', 'Password'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('ID', $this->ID);
		$criteria->compare('email', $this->email, true);
		$criteria->compare('regdate', $this->regdate, true);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('password', $this->password, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}