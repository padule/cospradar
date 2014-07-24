<?php
App::uses('ApiController', 'Controller');
/**
 * Charactors Controller
 *
 * @property Charactor $Charactor
 */
class CharactorsController extends ApiController {

    public $uses = array('Charactor','CharactorLocation');

    public function index() {

        if(isset($this->params->query['latitude']) && isset($this->params->query['longitude'])) {
            $latitude = $this->params->query['latitude'];
            $longitude = $this->params->query['longitude'];

            if (Charactor_Location.latlng == null) {
                $this->{$this->modelClass}->virtualFields = array(
                    'len'=>PHP_INT_MAX
                    );
            } else {
                $this->{$this->modelClass}->virtualFields = array(
                    'len'=>'GLength(GeomFromText(CONCAT("LineString('.$longitude.' '.$latitude.',", X(Charactor_Location.latlng), " ", Y(Charactor_Location.latlng),")")))'
                    );
            }

            $latitudePlus = $latitude + ($this->extent / 30.8184 * 0.000277778);
            $longitudePlus = $longitude + ($this->extent / 25.2450 * 0.000277778);
            $latitudeMinus = $latitude - ($this->extent / 30.8184 * 0.000277778);
            $longitudeMinus = $longitude - ($this->extent / 25.2450 * 0.000277778);

            $this->queryParams = array_merge($this->queryParams,array(
                'conditions'=>array(
                //    'Charactor.is_enabled' => true,
                ),
                'order' => array('len' => 'is null', 'len asc')
            ));
            unset($this->params->query['latitude']);
            unset($this->params->query['longitude']);
        }
        $this->queryParams =array_merge($this->queryParams,$this->_queryAction());
        if(isset($this->params->query['title'])) {
            foreach ($this->queryParams['conditions'] as $key => $value) {
                if(isset($value['title'])) {
                    $this->queryParams['conditions'][$key] = array('title like' => '%' . $this->params->query['title'] . '%');
                }
            }
        }
        $response = $this->{$this->modelClass}->find('all', $this->queryParams);

        $this->set(
                array(
                    'response'   => $response,
                    '_serialize' => 'response'
                ));
    }

    public function add() {

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

    public function edit($id) {

        if(isset($this->request->data['is_enabled'])&& $this->request->data['is_enabled']) {
            $charactor = $this->{$this->modelClass}->findById($id);
            $updateConditions = array(
                'user_id' => $charactor['user_id'],
            );
            $this->{$this->modelClass}->updateAll(array('is_enabled' => false),$updateConditions);
        }

        $this->{$this->modelClass}->id = $id;
        $this->add();
    }

}
