<?php
/**
 * DeviceFixture
 *
 */
class DeviceFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'Devices';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'key' => 'primary'),
		'user_id' => array('type' => 'integer', 'null' => false, 'default' => null),
		'platform' => array('type' => 'integer', 'null' => false, 'default' => '1'),
		'token' => array('type' => 'string', 'null' => false, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
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
			'user_id' => 1,
			'platform' => 1,
			'token' => 'Lorem ipsum dolor sit amet',
			'created' => '2014-05-24 08:05:03',
			'modified' => '2014-05-24 08:05:03'
		),
	);

}
