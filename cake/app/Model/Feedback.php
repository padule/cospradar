<?php
App::uses('AppModel', 'Model');

class Feedback extends AppModel {

  public $useTable = 'Feedbacks';
  public $belongsTo = 'User';

}