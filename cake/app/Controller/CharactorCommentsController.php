<?php
App::uses('ApiController', 'Controller');
/**
 * CharactorComments Controller
 *
 * @property CharactorComment $CharactorComment
 */
class CharactorCommentsController extends ApiController {

    public $uses = array('CharactorComment', 'Charactor');

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
        $this->queryParams =array_merge($this->_queryAction(),array(
            'conditions' => array(
                'comment_charactor_id' => $this->params->query['comment_charactor_id'],
                'NOT' => array(
                    "charactor_id" => $this->params->query['comment_charactor_id']
                ),
            ),
            'group' => 'charactor_id',
        ));
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


}
