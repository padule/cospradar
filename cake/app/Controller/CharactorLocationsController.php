<?php
App::uses('ApiController', 'Controller');
/**
 * CharactorLocations Controller
 *
 * @property CharactorLocation $CharactorLocation
 */
class CharactorLocationsController extends ApiController {

    private $extent = 1000;//1km

    public function beforeFilter() {
        parent::beforeFilter();
    }

    public function add() {

        if(isset($this->request->data['latitude']) && isset($this->request->data['longitude'])) {
            $latitude = $this->request->data['latitude'];
            $longitude = $this->request->data['longitude'];
        } else {
            return;
        }
        $latlng = $this->{$this->modelClass}->query("
                  SELECT 
                  GeomFromText('POINT(". $longitude ." ".$latitude.")')
                  as latlng
                ");
        $this->request->data['latlng'] = $latlng[0][0]['latlng'];

        if ($this->{$this->modelClass}->deleteAll(array('charactor_id' => $this->request->data['charactor_id']), false) && $this->{$this->modelClass}->save($this->request->data)) {
            $response = $this->{$this->modelClass}->read();
        }

        $this->set(
                array(
                    'response'   => $response,
                    '_serialize' => 'response'
                ));
    }

    public function index() {
        if(isset($this->params->query['latitude']) && isset($this->params->query['longitude'])) {
            $latitude = $this->params->query['latitude'];
            $longitude = $this->params->query['longitude'];
        } else {
            return;
        }

        $latitudePlus = $latitude + ($this->extent / 30.8184 * 0.000277778);
        $longitudePlus = $longitude + ($this->extent / 25.2450 * 0.000277778);
        $latitudeMinus = $latitude - ($this->extent / 30.8184 * 0.000277778);
        $longitudeMinus = $longitude - ($this->extent / 25.2450 * 0.000277778);

        $this->queryParams = array_merge($this->queryParams,array(
            'conditions'=>array("MBRContains(GeomFromText('LineString({$longitudePlus} {$latitudePlus}, {$longitudeMinus} {$latitudeMinus})'),latlng)"
        )));

        $response = $this->{$this->modelClass}->find('all', $this->queryParams);
        $this->set(
                array(
                    'response'   => $response,
                    '_serialize' => 'response'
                ));
    }
}
