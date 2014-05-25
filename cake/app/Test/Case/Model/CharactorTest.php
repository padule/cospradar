<?php
App::uses('Charactor', 'Model');

/**
 * Charactor Test Case
 *
 */
class CharactorTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.charactor',
		'app.user',
		'app.device',
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
		$this->Charactor = ClassRegistry::init('Charactor');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Charactor);

		parent::tearDown();
	}

}
