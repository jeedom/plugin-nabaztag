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

	public static $_widgetPossibility = array('custom' => true);

	/*     * ***********************Methode static*************************** */

	/*     * *********************Methode d'instance************************* */

	public function preInsert() {
		$this->setConfiguration('addr', 'openjabnab.fr');
	}

	public function preUpdate() {
		if ($this->getConfiguration('mac') == '') {
			throw new Exception(__('L\'adresse MAC ne peut etre vide', __FILE__));
		}
		if ($this->getConfiguration('token') == '') {
			throw new Exception(__('Le token ne peut etre vide', __FILE__));
		}
		if ($this->getConfiguration('addr') == '') {
			throw new Exception(__('L\'adresse ne peut etre vide', __FILE__));
		}
	}

	public function postSave() {
		$reboot = $this->getCmd(null, 'reboot');
		if (!is_object($reboot)) {
			$reboot = new nabaztagCmd();
			$reboot->setLogicalId('reboot');
			$reboot->setIsVisible(1);
			$reboot->setName(__('Redemarrer', __FILE__));
		}
		$reboot->setConfiguration('request', 'action');
		$reboot->setConfiguration('parameters', '18');
		$reboot->setType('action');
		$reboot->setSubType('other');
		$reboot->setEqLogic_id($this->getId());
		$reboot->save();

		$sleep = $this->getCmd(null, 'sleep');
		if (!is_object($sleep)) {
			$sleep = new nabaztagCmd();
			$sleep->setLogicalId('sleep');
			$sleep->setIsVisible(1);
			$sleep->setName(__('Coucher', __FILE__));
		}
		$sleep->setConfiguration('request', 'action');
		$sleep->setConfiguration('parameters', '14');
		$sleep->setType('action');
		$sleep->setSubType('other');
		$sleep->setEqLogic_id($this->getId());
		$sleep->save();

		$wakeup = $this->getCmd(null, 'wakeup');
		if (!is_object($wakeup)) {
			$wakeup = new nabaztagCmd();
			$wakeup->setLogicalId('wakeup');
			$wakeup->setIsVisible(1);
			$wakeup->setName(__('Debout', __FILE__));
		}
		$wakeup->setConfiguration('request', 'action');
		$wakeup->setConfiguration('parameters', '13');
		$wakeup->setType('action');
		$wakeup->setSubType('other');
		$wakeup->setEqLogic_id($this->getId());
		$wakeup->save();

		$speak = $this->getCmd(null, 'speak');
		if (!is_object($speak)) {
			$speak = new nabaztagCmd();
			$speak->setLogicalId('speak');
			$speak->setIsVisible(1);
			$speak->setName(__('Parle', __FILE__));
		}
		$speak->setConfiguration('request', 'tts');
		$speak->setConfiguration('parameters', '#message#');
		$speak->setType('action');
		$speak->setSubType('message');
		$speak->setDisplay('title_disable', 1);
		$speak->setEqLogic_id($this->getId());
		$speak->save();

		$leftear = $this->getCmd(null, 'leftear');
		if (!is_object($leftear)) {
			$leftear = new nabaztagCmd();
			$leftear->setLogicalId('leftear');
			$leftear->setIsVisible(1);
			$leftear->setName(__('Oreille gauche', __FILE__));
		}
		$leftear->setConfiguration('minValue', 0);
		$leftear->setConfiguration('maxValue', 16);
		$leftear->setConfiguration('request', 'posleft');
		$leftear->setConfiguration('parameters', '#slider#');
		$leftear->setType('action');
		$leftear->setSubType('slider');
		$leftear->setEqLogic_id($this->getId());
		$leftear->save();

		$rightear = $this->getCmd(null, 'rightear');
		if (!is_object($rightear)) {
			$rightear = new nabaztagCmd();
			$rightear->setLogicalId('rightear');
			$rightear->setIsVisible(1);
			$rightear->setName(__('Oreille droite', __FILE__));
		}
		$rightear->setConfiguration('minValue', 0);
		$rightear->setConfiguration('maxValue', 16);
		$rightear->setConfiguration('parameters', '#slider#');
		$rightear->setConfiguration('request', 'posright');
		$rightear->setType('action');
		$rightear->setSubType('slider');
		$rightear->setEqLogic_id($this->getId());
		$rightear->save();

		$airquality = $this->getCmd(null, 'airquality');
		if (!is_object($airquality)) {
			$airquality = new nabaztagCmd();
			$airquality->setLogicalId('airquality');
			$airquality->setIsVisible(1);
			$airquality->setName(__('Qualité de l\'air', __FILE__));
		}
		$airquality->setConfiguration('request', 'plugin');
		$airquality->setConfiguration('parameters', 'airquality&function=get');
		$airquality->setType('action');
		$airquality->setSubType('other');
		$airquality->setEqLogic_id($this->getId());
		$airquality->save();

		$ephemeris = $this->getCmd(null, 'ephemeris');
		if (!is_object($ephemeris)) {
			$ephemeris = new nabaztagCmd();
			$ephemeris->setLogicalId('ephemeris');
			$ephemeris->setIsVisible(1);
			$ephemeris->setName(__('Ephéméride', __FILE__));
		}
		$ephemeris->setConfiguration('request', 'action');
		$ephemeris->setConfiguration('parameters', 'ephemeride&function=get');
		$ephemeris->setType('action');
		$ephemeris->setSubType('other');
		$ephemeris->setEqLogic_id($this->getId());
		$ephemeris->save();

		$sayhour = $this->getCmd(null, 'sayhour');
		if (!is_object($sayhour)) {
			$sayhour = new nabaztagCmd();
			$sayhour->setLogicalId('sayhour');
			$sayhour->setIsVisible(1);
			$sayhour->setName(__('Horloge parlante', __FILE__));
		}
		$sayhour->setConfiguration('request', 'plugin');
		$sayhour->setConfiguration('parameters', 'clock&function=get');
		$sayhour->setType('action');
		$sayhour->setSubType('other');
		$sayhour->setEqLogic_id($this->getId());
		$sayhour->save();

		$weather = $this->getCmd(null, 'weather');
		if (!is_object($weather)) {
			$weather = new nabaztagCmd();
			$weather->setLogicalId('weather');
			$weather->setIsVisible(1);
			$weather->setName(__('Météo', __FILE__));
		}
		$weather->setConfiguration('request', 'plugin');
		$weather->setConfiguration('parameters', 'weather&function=get');
		$weather->setType('action');
		$weather->setSubType('other');
		$weather->setEqLogic_id($this->getId());
		$weather->save();

		$proverbe = $this->getCmd(null, 'proverbe');
		if (!is_object($proverbe)) {
			$proverbe = new nabaztagCmd();
			$proverbe->setLogicalId('proverbe');
			$proverbe->setIsVisible(1);
			$proverbe->setName(__('Dicton', __FILE__));
		}
		$proverbe->setConfiguration('request', 'plugin');
		$proverbe->setConfiguration('parameters', 'dicton&function=get');
		$proverbe->setType('action');
		$proverbe->setSubType('other');
		$proverbe->setEqLogic_id($this->getId());
		$proverbe->save();
	}

	public function toHtml($_version = 'dashboard') {
		$replace = $this->preToHtml($_version);
		if (!is_array($replace)) {
			return $replace;
		}
		$version = jeedom::versionAlias($_version);
		foreach ($this->getCmd('action') as $cmd) {
			if ($cmd->getIsVisible() == 1 && $cmd->getDisplay('showOn' . $_version, 1) == 1) {
				$replace['#' . $cmd->getLogicalId() . '_id#'] = $cmd->getId();
			} else {
				$replace['#' . $cmd->getLogicalId() . '_id#'] = '';
			}
		}
		$html = template_replace($replace, getTemplate('core', $version, 'nabaztag', 'nabaztag'));
		return $html;
	}

}

class nabaztagCmd extends cmd {
	/*     * *************************Attributs****************************** */

	public static $_widgetPossibility = array('custom' => false);

	/*     * ***********************Methode static*************************** */

	/*     * *********************Methode d'instance************************* */

	public function preSave() {
		if ($this->getConfiguration('request') == '') {
			throw new Exception(__('La requete ne peut etre vide', __FILE__));
		}
	}

	public function execute($_options = null) {
		$nabaztag = $this->getEqLogic();
		$parameters = $this->getConfiguration('parameters');
		$type = $this->getConfiguration('request');
		switch ($this->subType) {
			case 'message':
				$parameters = urlencode(str_replace('#message#', $_options['message'], $parameters));
				break;
			case 'slider':
				$parameters = str_replace('#slider#', $_options['slider'], $parameters);
				break;
		}
		if ($type == 'urlList') {
			$parameters = urlencode($parameters);
			$request = 'http://' . $nabaztag->getConfiguration('addr') . '/ojn/FR/api_stream.jsp?sn=' . $nabaztag->getConfiguration('mac') . '&token=' . $nabaztag->getConfiguration('token') . '&' . $type . '=' . $parameters;
		} else {
			$request = 'http://' . $nabaztag->getConfiguration('addr') . '/ojn/FR/api.jsp?sn=' . $nabaztag->getConfiguration('mac') . '&token=' . $nabaztag->getConfiguration('token') . '&' . $type . '=' . $parameters;
		}
		log::add('nabaztag', 'debug', $request);
		try {
			$request = new com_http($request);
			$result = $request->exec(0.1, 1);
			$xml = new SimpleXMLElement($result);
			$json = json_decode(json_encode($xml), TRUE);
		} catch (Exception $e) {
			log::add('nabaztag', 'info', log::exception($e));
		}
		if (isset($json) && is_array($json) && isset($json['message']) && ($json['message'] == 'PREMIUM_ONLY' || $json['message'] == 'PLUGINNOTAVAILABLE')) {
			throw new Exception($json['message'] . ' : ' . $json['comment']);
		}
	}

	/*     * **********************Getteur Setteur*************************** */
}
?>