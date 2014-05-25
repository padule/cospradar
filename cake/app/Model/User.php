<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 *
 * @property Charactor $Charactor
 * @property Device $Device
 */
class User extends AppModel {

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'Users';

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

}
