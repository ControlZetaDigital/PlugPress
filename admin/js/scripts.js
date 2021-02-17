/**
 * PlugPress Admin Scripts 
 * v1.0.0
 **/

(function( $ ) {
	'use strict';

	jQuery( document ).ready( function( $ ){
 
		settings_actions();
	 
	});

	var settings_actions = function() {
		$('.plugpress_plug-enabled').on('change', function() {
			var id = $(this).closest('.plugpress_plug').data('id');
			update_setting( id, 'enabled', parseInt( this.value ) );
		});
	}

	var update_setting = function(id, setting, value) {
		$.ajax({
			type: "POST",
			dataType: "json",
			url: wp.ajax.settings.url,
			data: {
				action: 'update_setting',
				plug_id: id,
				setting: setting,
				value: value,
			},
			success: function(response, textStatus, jqXHR) {
				//console.log( response );
			},
			error: function(jqXHR, textStatus, errorThrown) {
				console.log(textStatus);
            	console.log(errorThrown);
			}
		});
	}
	
})( jQuery );