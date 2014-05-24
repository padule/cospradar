<?php
App::uses('AppController', 'Controller');

/**
 * {$this->modelClass}s Controller
 *
 * @property {$this->modelClass} ${$this->modelClass}
 * @property PaginatorComponent $Paginator
 */
class ApiController extends AppController {

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
        'limit_offset' => array('limit', 'offset')
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
    private function _queryAction($params = array()) {
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
            } else if (in_array($key, $this->queryType['limit_offset'])) {
                // limit_offset
                $params[$key] = $value;
            } else {
                // conditions
                $params['conditions'][] = array($key => $value);
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
        $params = $this->_queryAction();
        $response = $this->{$this->modelClass}->find('all', $params);
        $this->set(
                array(
                    'response'   => $response,
                    'status'     => STATUS_SUCCESS,
                    '_serialize' => array('response', 'status')
                ));
    }
    public function view($id) {
        $this->request->query[$this->modelClass . '.id'] = $id;
        $params = $this->_queryAction();
        $response = $this->{$this->modelClass}->find('first', $params);
        $this->set(
                array(
                    'response'   => $response,
                    '_serialize' => array('response')
                ));
    }
    public function add() {
        if ($this->{$this->modelClass}->save($this->request->data)) {
            $response = array(
                'id'      => $this->{$this->modelClass}->getLastInsertId(),
                'message' => 'success'
            );
            $status = STATUS_SUCCESS;
        } else {
            $response = array(
                'message' => $this->{$this->modelClass}->validationErrors
            );
            $status = STATUS_FAILED;
        }

        $this->set(
                array(
                    'response'   => $response,
                    'status'     => $status,
                    '_serialize' => array('response', 'status')
                ));
    }
    public function edit($id) {
        $this->{$this->modelClass}->id = $id;
        if ($this->{$this->modelClass}->save($this->request->data)) {
            $response = array('message' => 'success');
            $status = STATUS_SUCCESS;
        } else {
            $response = array(
                'message' => $this->{$this->modelClass}->validationErrors
            );
            $status = STATUS_FAILED;
        }
        $this->set(
                array(
                    'response'   => $response,
                    'status'     => $status,
                    '_serialize' => array('response', 'status')
                ));
    }
    public function delete($id) {
        if ($this->{$this->modelClass}->delete($id)) {
            $response = array('message' => 'success');
            $status = STATUS_SUCCESS;
        } else {
            $response = array(
                'success' => false,
                'message' => $this->{$this->modelClass}->validationErrors
            );
            $status = STATUS_FAILED;
        }
        $this->set(
                array(
                    'response'   => $response,
                    'status'     => $status,
                    '_serialize' => array('response', 'status')
                ));
    }

    public function setResponse($response, $status) {
        $this->set(compact('response', 'status'));
        $this->set('_serialize', array('response', 'status'));
    }
}
