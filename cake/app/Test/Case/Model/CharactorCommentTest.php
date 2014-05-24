<?php
App::uses('CharactorComment', 'Model');

/**
 * CharactorComment Test Case
 *
 */
class CharactorCommentTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.charactor_comment',
		'app.charactor',
		'app.comment_charactor'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->CharactorComment = ClassRegistry::init('CharactorComment');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->CharactorComment);

		parent::tearDown();
	}

}
