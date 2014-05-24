<?php
App::uses('AppController', 'Controller');

class FeedbacksController extends AppController {

  public function index() {
    $user = $this->Auth->user();
    if (!($user)) {
      $this->redirect(array('controller' => 'users', 'action' => 'login'));
    }

    $feedbacks = $this->Feedback->find('all');

    $this->set('user', $user);
    $this->set('feedbacks', $feedbacks);
    $this->set('isAdmin', ($user['company_id']==9999));

    if (isset($this->params['url']['json'])){
      $responseText = array();
      foreach ($feedbacks as $feedback){
        $attributes = $feedback['Feedback'];
        $attributes['User'] = $feedback['User'];
        $responseText[] = $attributes;
      }

      $this->responseText = $responseText;
      $this->render('json');
    }
  }

  public function add() {
    $category_kb = $this->request->data['category_kb'];
    $content = $this->request->data['content'];
    $user_id = $this->Auth->user('id');
    $response_kb = $this->request->data['response_kb'];

    $savedata = array(
      'category_kb' => $category_kb,
      'content' => $content,
      'user_id' => $user_id,
      'response_kb' => $response_kb
    );

    $feedback = $this->Feedback->save($savedata);
    $responseText = $feedback['Feedback'];
    $responseText['User'] = $this->Auth->user();

    $this->responseText = $responseText;
    $this->render('json');
  }

  public function delete($id) {
    if ($this->request->is('delete')) {
      $this->Feedback->id = $id;
      if ($this->Feedback->delete()) {
        $this->env = true;
      } else {
        $this->env = false;
      }
    }

    $this->render('json');
  }

  public function edit($id) {
    if ($this->request->is('post') || $this->request->is('put')) {
      $this->Feedback->id = $id;
      $feedback = $this->Feedback->save($this->request->data);
      $responseText = $feedback['Feedback'];
      $responseText['User'] = $feedback['User'];

      $this->responseText = $responseText;
      $this->render('json');
    }
  }

}