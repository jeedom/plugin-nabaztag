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

global $listCmdNabaztag;
$listCmdNabaztag = array(
    array(
        'name' => 'Version',
        'configuration' => array(
            'request' => 'action',
            'parameters' => '8',
        ),
        'type' => 'info',
        'subType' => 'string',
        'description' => 'Version du nabaztag',
        'version' => '0.1',
        'required' => '',
    ),
    array(
        'name' => 'Nom',
        'configuration' => array(
            'request' => 'action',
            'parameters' => '10',
        ),
        'type' => 'info',
        'subType' => 'string',
        'description' => 'Nom du nabaztag',
        'version' => '0.1',
        'required' => '',
    ),
    array(
        'name' => 'Connecté',
        'configuration' => array(
            'request' => 'action',
            'parameters' => '15',
        ),
        'type' => 'info',
        'subType' => 'binary',
        'description' => 'Nabaztag connecté au serveur?',
        'version' => '0.1',
        'required' => '',
    ),
    array(
        'name' => 'Dernière apparition',
        'configuration' => array(
            'request' => 'action',
            'parameters' => '16',
        ),
        'type' => 'info',
        'subType' => 'string',
        'description' => 'Date de dernière appartition sur le serveur',
        'version' => '0.1',
        'required' => '',
    ),
    array(
        'name' => 'Reboot',
        'configuration' => array(
            'request' => 'action',
            'parameters' => '18',
        ),
        'type' => 'action',
        'subType' => 'other',
        'description' => 'Redémarrer le Nabaztag',
        'version' => '0.1',
        'required' => '',
    ),
    array(
        'name' => 'Streaming',
        'configuration' => array(
            'request' => 'urlList',
            'parameters' => '',
        ),
        'type' => 'action',
        'subType' => 'other',
        'description' => 'Envoi de son au lapin. <br/> Il faut préciser en paramètre l\'url du son à jouer : http://monServeur/monfichier.mp3 <br/> Il est possible d\'envoyer plusieurs sons en les séparant par \'|\' : http://monServeur/monfichier1.mp3|http://monServeur/monfichier2.mp3 ',
        'version' => '0.1',
        'required' => '',
    ),
    array(
        'name' => 'Coucher',
        'configuration' => array(
            'request' => 'action',
            'parameters' => '14',
        ),
        'type' => 'action',
        'subType' => 'other',
        'description' => 'Le Nabaztag au dodo',
        'version' => '0.1',
        'required' => '',
    ),
    array(
        'name' => 'Debout',
        'configuration' => array(
            'request' => 'action',
            'parameters' => '13',
        ),
        'type' => 'action',
        'subType' => 'other',
        'description' => 'Reveil le Nabaztag',
        'version' => '0.1',
        'required' => '',
    ),
    array(
        'name' => 'Parle',
        'configuration' => array(
            'request' => 'tts',
            'parameters' => '#message#',
        ),
        'type' => 'action',
        'subType' => 'message',
        'description' => 'Fait parler le Nabaztag',
        'version' => '0.1',
        'required' => 'Activer auparavant le plugin dans la console OpenJabNab:</br> => Plugin TTS, envoi de texte au lapin',
    ),
    array(
        'name' => 'Oreille Gauche',
        'configuration' => array(
            'request' => 'posleft',
            'parameters' => '#slider#',
            'minValue' => '0',
            'maxValue' => '16',
        ),
        'type' => 'action',
        'subType' => 'slider',
        'description' => 'Change la position de l\'oreille gauche',
        'version' => '0.2',
        'required' => '',
    ),
    array(
        'name' => 'Oreille Droite',
        'configuration' => array(
            'request' => 'posright',
            'parameters' => '#slider#',
            'minValue' => '0',
            'maxValue' => '16',
        ),
        'type' => 'action',
        'subType' => 'slider',
        'description' => 'Change la position de l\'oreille droite',
        'version' => '0.2',
        'required' => '',
    ),
    array(
        'name' => 'Qualité de l\'air',
        'configuration' => array(
            'request' => 'plugin',
            'parameters' => 'airquality&function=get',
        ),
        'type' => 'action',
        'subType' => 'other',
        'description' => 'Qualité de l\'air',
        'version' => '0.1',
        'required' => 'Activer auparavant le plugin dans la console OpenJabNab:</br> => Qualité de l\'air',
    ),
    array(
        'name' => 'Horloge parlante',
        'configuration' => array(
            'request' => 'plugin',
            'parameters' => 'clock&function=get',
        ),
        'type' => 'action',
        'subType' => 'other',
        'description' => 'Horloge parlante',
        'version' => '0.1',
        'required' => 'Activer auparavant le plugin dans la console OpenJabNab:</br> => Horloge',
    ),
    array(
        'name' => 'Ephéméride',
        'configuration' => array(
            'request' => 'plugin',
            'parameters' => 'ephemeride&function=get',
        ),
        'type' => 'action',
        'subType' => 'other',
        'description' => 'Ephéméride',
        'version' => '0.1',
        'required' => 'Activer auparavant le plugin dans la console OpenJabNab:</br> => Ephéméride',
    ),
    array(
        'name' => 'Météo',
        'configuration' => array(
            'request' => 'plugin',
            'parameters' => 'weather&function=get',
        ),
        'type' => 'action',
        'subType' => 'other',
        'description' => 'Météo',
        'version' => '0.1',
        'required' => 'Activer auparavant le plugin dans la console OpenJabNab:</br> => Conditions météo et prévisions',
    ),
    array(
        'name' => 'Dicton',
        'configuration' => array(
            'request' => 'plugin',
            'parameters' => 'dicton&function=get',
        ),
        'type' => 'action',
        'subType' => 'other',
        'description' => 'Dicton',
        'version' => '0.1',
        'required' => 'Activer auparavant le plugin dans la console OpenJabNab:</br> => Dicton',
    ),
);
?>
