$( document ).ready(function() {

	$( "#searchform" ).submit(function( event ) {
		event.preventDefault();
		var searchstring = $( "#searchstring" ).val();
		  alert(searchstring);
	});
	
});
