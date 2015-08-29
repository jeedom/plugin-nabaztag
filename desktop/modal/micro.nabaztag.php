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

if (init('id') == '') {
	throw new Exception('{{L\'id de l\'équipement ne peut etre vide : }}' . init('op_id'));
}

$id = init('id');
$nabaztag = nabaztag::byId($id);
if (!is_object($nabaztag)) {
	throw new Exception(__('Aucun equipement ne  correspond : Il faut (re)-enregistrer l\'équipement ', __FILE__) . init('action'));
}
?>
<div id='div_microNabaztagAlert' style="display: none;"></div>
<div>
	<textarea class="form-control ta_ttsMessage" placeholder="{{Message...}}" rows="10"></textarea><br/>
	<a class="btn btn-success bt_ttsNabaztag pull-right"><i class="fa fa-check-circle"></i> {{Lire le message}}</a>
</div>
<script>
	$('.bt_ttsNabaztag').on('click', function() {
		var that = $(this);
		$.ajax({// fonction permettant de faire de l'ajax
			type: "POST", // methode de transmission des données au fichier php
			url: "plugins/nabaztag/core/ajax/nabaztag.ajax.php", // url du fichier php
			data: {
				action: "tts",
				id: <?php echo init('id')?>,
				message:that.closest('div').find('.ta_ttsMessage').value(),
			},
			dataType: 'json',
			error: function(request, status, error) {
				handleAjaxError(request, status, error,$('#div_microNabaztagAlert'));
			},
		    success: function(data) { // si l'appel a bien fonctionné
		    if (data.state != 'ok') {
		    	$('#div_microNabaztagAlert').showAlert({message: data.result,level: 'danger'});
		    	return;
		    }
		    $('#div_microNabaztagAlert').showAlert({message:'{{Message lu avec succès}}',level: 'success'});
		}
	});
	});
</script>