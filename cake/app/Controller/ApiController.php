<?php
App::uses('AppController', 'Controller');

/**
 * {$this->modelClass}s Controller
 *
 * @property {$this->modelClass} ${$this->modelClass}
 * @property PaginatorComponent $Paginator
 */
class ApiController extends AppController {

    public $queryParams = array(
        'limit' => 20,
    );

    public $components = array(
        'RequestHandler',
    );

    // queryタイプ
    public $queryType = array(
        'bind'         => array(
            'hasAndBelongsToMany',
            'hasOne',
            'hasMany',
            'belongsTo'
        ),
        'fields'       => array('fields'),
        'order'        => array('desc', 'asc'),
        'limit_offset_page' => array('limit', 'offset','page')
    );

    public function beforeFilter() {
        parent::beforeFilter();
    }

    /**
     * queryを解析し、bindやparamsの作成を行う
     *
     * @param array $params
     *        	[description]
     * @return [type] [description]
     */
    public function _queryAction($search = false) {
        $params = array();
        foreach ($this->params->query as $key => $value) {

            if (in_array($key, $this->queryType['fields'])) {
                // fields
                $params['fields'] = explode('-', $value);
            } else if (in_array($key, $this->queryType['bind'])) {
                // bind
                $values = explode('-', $value);
                foreach ($values as $value) {
                    $this->_bindModel($key, $value);
                }
            } else if (in_array($key, $this->queryType['order'])) {
                // order
                $orderStr = str_replace('-', ',', $value);
                $orderStr .= ' ' . $key;
                $params['order'] = $orderStr;
            } else if (in_array($key, $this->queryType['limit_offset_page'])) {
                // limit_offset
                $params[$key] = $value;
            } else {
                if($search) {
                    $params['conditions'][] = array($key . ' like' => '%' . $value . '%');
                } else {
                    $params['conditions'][] = array($key => $value);
                }
                
            }
        }
        //$this->log("params");
        //$this->log($params);
        return $params;
    }
    private function _bindModel($type, $model) {
        $this->{$this->modelClass}->bindModel(array($type => array($model)));
    }
    public function index() {
        $this->queryParams =array_merge($this->queryParams,$this->_queryAction());
        $response = $this->{$this->modelClass}->find('all', $this->queryParams);
        $this->set(
                array(
                    'response'   => $response,
                    '_serialize' => 'response'
                ));
    }
    public function view($id) {
        $this->request->query[$this->modelClass . '.id'] = $id;
        $this->queryParams =array_merge($this->queryParams,$this->_queryAction());
        $response = $this->{$this->modelClass}->find('first', $this->queryParams);
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
        $this->{$this->modelClass}->id = $id;
        $this->add();
    }
    public function delete($id) {
        if ($this->{$this->modelClass}->delete($id)) {
            $response = array('message' => 'success');
        } else {
            $response = array(
                'success' => false,
                'message' => $this->{$this->modelClass}->validationErrors
            );
        }
        $this->set(
                array(
                    'response'   => $response,
                    '_serialize' => 'response'
                ));
    }

    public function search() {
        $this->queryParams =array_merge($this->queryParams,$this->_queryAction(true));
        $response = $this->{$this->modelClass}->find('all', $this->queryParams);
        $this->set(
                array(
                    'response'   => $response,
                    '_serialize' => 'response'
                ));
    }

    public function setResponse($response) {
        $this->set(compact('response'));
        $this->set('_serialize');
    }
}
