<?php
/**
 * Application model for Cake.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {

    public function find($type = 'first', $query = array()) {
        $result = parent::find($type,$query);

        $returnArray = array();
        if (is_null($result)) {
            return null;
        }

        $this->findQueryType = null;

        if ($type === 'all') {
            foreach ($result as $index => $value) {
                $returnArray[$index] = $this->editResult($value);
            }
        }

        if ($type === 'first') {
            $returnArray = $this->editResult($result);
        }


        return $returnArray;
    }

    private function editResult($result) {
        $returnArray = array();
        foreach ($result as $key => $value) {
            if ($key == $this->name) {
                $returnArray = $value;
            } else {
                $returnArray[$key] = $value;
            }
        }

        return $returnArray;
    }


}
