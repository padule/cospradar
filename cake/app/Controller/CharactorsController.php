<?php
App::uses('ApiController', 'Controller');
/**
 * Charactors Controller
 *
 * @property Charactor $Charactor
 */
class CharactorsController extends ApiController {

    public function index() {
        $this->queryParams =array_merge($this->queryParams,$this->_queryAction(true));
        $response = $this->{$this->modelClass}->find('all', $this->queryParams);
        $this->set(
                array(
                    'response'   => $response,
                    '_serialize' => 'response'
                ));
    }


}
