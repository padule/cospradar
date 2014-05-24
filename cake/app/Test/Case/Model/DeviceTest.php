<?php
App::uses('Device', 'Model');

/**
 * Device Test Case
 *
 */
class DeviceTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.device',
		'app.user',
		'app.charactor',
		'app.charactor_comment',
		'app.comment_charactor',
		'app.charactor_location'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Device = ClassRegistry::init('Device');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Device);

		parent::tearDown();
	}

}
