<?php
App::uses('ApiController', 'Controller');
/**
 * CharactorComments Controller
 *
 * @property CharactorComment $CharactorComment
 */
class CharactorCommentsController extends ApiController {

    public $uses = array('CharactorComment', 'Charactor','User','Device');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->queryParams = array_merge($this->queryParams,array(
            'order' => 'CharactorComment.id desc'
        ));
    }

    public function index() {
        $this->queryParams =array_merge($this->queryParams,$this->_queryAction());
        $response = array_reverse($this->{$this->modelClass}->find('all', $this->queryParams));
        $this->set(
                array(
                    'response'   => $response,
                    '_serialize' => 'response'
                ));
    }

    public function comment_list() {
        if(isset($this->params->query['user_id'])) {
            $charactors = $this->Charactor->find('all',array('conditions' => array('user_id' => $this->params->query['user_id'])));
            $charactorIds = array();
            foreach ($charactors as $charactor) {
                $charactorIds[] = $charactor['id'];
            }
            $this->queryParams =array_merge($this->_queryAction(),array(
                'conditions' => array(
                    'comment_charactor_id' => $charactorIds,
                    'NOT' => array(
                        "charactor_id" => $charactorIds
                    ),
                ),
                'group' => 'charactor_id',
            ));
        } else {
            $this->queryParams =array_merge($this->_queryAction(),array(
                'conditions' => array(
                    'comment_charactor_id' => $this->params->query['comment_charactor_id'],
                    'NOT' => array(
                        "charactor_id" => $this->params->query['comment_charactor_id']
                    ),
                ),
                'group' => 'charactor_id',
            ));
        }

        $list = $this->{$this->modelClass}->find('all', $this->queryParams);
        $charactors = array();
        foreach ($list as $value) {
            $charactors[] = $value['charactor_id'];
        }
        $this->Charactor->bindModel(array(
            'hasMany' => array(
                'latest_comment' => array(
                    'className' => 'CharactorComment',
                    'order' => 'latest_comment.id desc',
                    'limit' => 1,
                )
            ),
        ));
        $response = $this->Charactor->find('all',array('conditions'=> array('Charactor.id'=>$charactors),'group' => 'Charactor.id',));
        foreach ($response as $key => $value) {
            $response[$key]['latest_comment'] = $value['latest_comment']['0'];
        }
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

        if($this->request->data['charactor_id'] != $this->request->data['comment_charactor_id']) {
            $charactor = $this->Charactor->find('first',array('conditions' => array('Charactor.id' => $this->request->data['charactor_id'])));
            $device = $this->Device->find('first',array('conditions' => array('user_id' => $charactor['user_id'])));    
            if(!empty($device)) {
                App::uses( 'HttpSocket', 'Network/Http');
                $socket = new HttpSocket();
                $request = array(
                    'header' => array(
                        'Authorization' => 'key=AIzaSyCwhblt6PZGG8bC9bYwGi7ehu91d13AVWU' // ApiKey
                     )
                 );
                $post_data = array(
                    'registration_id' => $device['token'], // deviceトークン
                    'data.title' => '',
                    'data.text' => '',
                    'data.id' => '101',
                    'data.model_id' => $this->request->data['charactor_id'],
                    'data.extra_url' => '',
                    'data.icon_url' => $charactor['image'],
                    'data.big_picture_url' => '',
                    'data.priority' => '50',
                );
                $socket->post('https://android.googleapis.com/gcm/send', $post_data, $request);
            }
        }
        $params = array(
            'conditions' => array(
                'charactor_id' => $this->request->data['charactor_id'],
            ),
            'group' => 'comment_charactor_id'
        );
        $commentCharactor = $this->Charactor->findById($this->request->data['comment_charactor_id']);
        $charactors = $this->CharactorComment->find('all',$params);
        foreach ($charactors as $value) {
            if($value['comment_charactor']['id'] != $this->request->data['charactor_id'] && $value['comment_charactor']['id'] != $this->request->data['comment_charactor_id']) {
                $device = $this->Device->find('first',array('conditions' => array('user_id' => $value['comment_charactor']['user_id'])));
                if(!empty($device)) {
                    App::uses( 'HttpSocket', 'Network/Http');
                    $socket = new HttpSocket();
                    $request = array(
                        'header' => array(
                            'Authorization' => 'key=AIzaSyCwhblt6PZGG8bC9bYwGi7ehu91d13AVWU' // ApiKey
                         )
                     );
                $post_data = array(
                    'registration_id' => $device['token'], // deviceトークン
                    'data.title' => '',
                    'data.text' => '',
                    'data.id' => '102',
                    'data.model_id' => $this->request->data['charactor_id'],
                    'data.extra_url' => '',
                    'data.icon_url' => $commentCharactor['image'],
                    'data.big_picture_url' => '',
                    'data.priority' => '50',
                );
                    $socket->post('https://android.googleapis.com/gcm/send', $post_data, $request);
                }

            }
        }
        $this->set(
                array(
                    'response'   => $response,
                    '_serialize' => 'response'
                ));
    }


}
