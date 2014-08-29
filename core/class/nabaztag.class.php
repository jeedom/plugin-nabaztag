<?php

/* This file is part of Jeedom.
*
* Jeedom is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* Jeedom is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with Jeedom. If not, see <http://www.gnu.org/licenses/>.
*/

/* * ***************************Includes********************************* */
require_once dirname(__FILE__) . '/../../../../core/php/core.inc.php';

class nabaztag extends eqLogic {
    /*     * *************************Attributs****************************** */


    /*     * ***********************Methode static*************************** */


    /*     * *********************Methode d'instance************************* */

    public function preUpdate() {
        if ($this->getConfiguration('mac') == '') {
            throw new Exception(__('L\adresse MAC ne peut etre vide',__FILE__));
        }
        if ($this->getConfiguration('token') == '') {
            throw new Exception(__('Le token ne peut etre vide',__FILE__));
        }
        if ($this->getConfiguration('addr') == '') {
            throw new Exception(__('L\'adresse ne peut etre vide',__FILE__));
        }
    }

}

class nabaztagCmd extends cmd {
    /*     * *************************Attributs****************************** */


    /*     * ***********************Methode static*************************** */


    /*     * *********************Methode d'instance************************* */

    public function preSave() {
        if ($this->getConfiguration('request') == '') {
            throw new Exception(__('La requete ne peut etre vide',__FILE__));
        }
    }

    public function execute($_options = null) {
    	
		$nabaztag = $this->getEqLogic();
        $requestHeader = 'http://' . $nabaztag->getConfiguration('addr') . '/ojn/FR/api.jsp?sn=' . $nabaztag->getConfiguration('mac') . '&token=' . $nabaztag->getConfiguration('token');

        if ($this->getConfiguration('parameters') == '') {
            throw new Exception(__("Pas de paramètre défini"));
        } else {
            $parameters = $this->getConfiguration('parameters');
			$type=$this->getConfiguration('request');
            if ($this->type == 'action' && $_options != null) {
                switch ($this->subType) {
                    case 'message':
						$type = "tts";
                        $parameters = urlencode(str_replace('#message#', $_options['message'], $parameters));
                        break;
                    case 'slider':
						$type=$this->getConfiguration('request');
                        $parameters = str_replace('#slider#', $_options['slider'], $parameters);
                        break;
                    default:
						$type=$this->getConfiguration('request');
                        break;
                }
            }

        //$request = $requestHeader.'&'.http_build_query(array($type=>$parameters));
		$request = $requestHeader.'&'.$type.'='.$parameters;
		//throw new Exception(__('aa'.$request));
		$ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $request);
        curl_setopt($ch, CURLOPT_TIMEOUT, 1);
        $response = curl_exec($ch);
        if ($response === false) {
            log::add('nabaztag', 'Error', __('Erreur curl : ',__FILE__) . curl_error($ch) . __(' sur la commande Nabaztag ',__FILE__) . $this->name);
            throw new Exception(__('[nabaztag] Erreur curl : ',__FILE__) . curl_error($ch) . __(' sur la commande Nabaztag ',__FILE__) . $this->name);
        }
        curl_close($ch);
        return $response;
    }

    /*     * **********************Getteur Setteur*************************** */
}
}
?>