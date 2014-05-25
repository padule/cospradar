<?php
App::uses('CharactorLocation', 'Model');

/**
 * CharactorLocation Test Case
 *
 */
class CharactorLocationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.charactor_location',
		'app.charactor'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->CharactorLocation = ClassRegistry::init('CharactorLocation');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CharactorLocation);

		parent::tearDown();
	}

}
