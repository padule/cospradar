<?php
App::uses('CharactorsController', 'Controller');

/**
 * CharactorsController Test Case
 *
 */
class CharactorsControllerTest extends ControllerTestCase {

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

}
