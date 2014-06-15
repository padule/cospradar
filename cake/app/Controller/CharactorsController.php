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

        public function add() {

        if(!isset($this->request->data['is_enabled'])){
           $this->request->data['is_enabled'] = true;
        }
        if($this->request->data['is_enabled']) {
            $updateConditions = array(
                'user_id' => $this->request->data['user_id'],
            );
        }

        $this->{$this->modelClass}->updateAll(array('is_enabled' => false),$updateConditions);
        //画像の保存あり
        if(isset($_FILES['image']['tmp_name'])){

            $image = $_FILES['image'];
            $this->{$this->modelClass}->save($this->request->data);
            //画像保存先のパス
            $path = WWW_ROOT . 'userdata' . DS . $this->modelClass . DS . $this->{$this->modelClass}->id;
            move_uploaded_file($image['tmp_name'], $path);
            $this->request->data['image'] = 'http://' . env('HTTP_HOST') . '/userdata/' . $this->modelClass . '/' . $this->{$this->modelClass}->id;
            if ($this->{$this->modelClass}->save($this->request->data)) {
                $response = $this->{$this->modelClass}->read();
            }
        } else {
            if ($this->{$this->modelClass}->save($this->request->data)) {
                $response = $this->{$this->modelClass}->read();
            }
        }

        $this->set(
                array(
                    'response'   => $response,
                    '_serialize' => 'response'
                ));
    }


}
