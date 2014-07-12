<?php
App::uses('ApiController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends ApiController {

    function login() {
        
        $response = $this->{$this->modelClass}->findByName($this->request->data['name']);
        if(empty($response)) {
            $this->add();
        } else {
            $this->set(
                    array(
                        'response'   => $response,
                        '_serialize' => 'response'
                    ));
        }

    }
}
