<?php
App::uses('ApiController', 'Controller');
/**
 * CharactorComments Controller
 *
 * @property CharactorComment $CharactorComment
 */
class CharactorCommentsController extends ApiController {

    public $queryParams = array(
        'limit' => 20,
        'order' => 'CharactorComment.id desc'
    );

    public function index() {
        $this->queryParams =array_merge($this->queryParams,$this->_queryAction());
        $response = array_reverse($this->{$this->modelClass}->find('all', $this->queryParams));
        $this->set(
                array(
                    'response'   => $response,
                    '_serialize' => 'response'
                ));
    }


}
