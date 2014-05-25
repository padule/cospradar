<?php
/**
 * CharactorLocationFixture
 *
 */
class CharactorLocationFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'CharactorLocations';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'latitude' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '9,6'),
		'longitude' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => 9),
		'charactor_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'created' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'latitude' => 1,
			'longitude' => 1,
			'charactor_id' => 1,
			'created' => '2014-05-24 08:04:37',
			'modified' => '2014-05-24 08:04:37'
		),
	);

}
