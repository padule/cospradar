<?php
App::uses('AppModel', 'Model');
/**
 * CharactorLocation Model
 *
 * @property Charactor $Charactor
 */
class CharactorLocation extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'CharactorLocations';

	public $virtualFields = array(
		'latitude' => 'X(latlng)',
		'longitude' => 'Y(latlng)'
	);

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'charactor_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Charactor' => array(
			'className' => 'Charactor',
			'foreignKey' => 'charactor_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
