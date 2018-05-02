$( document ).ready(function() {

	$( "#searchform" ).submit(function( event ) {
		event.preventDefault();
		var searchstring = $( "#searchstring" ).val();
		var season = $( "#season" ).val();
	    
		$.ajax({
	        type: 'POST',
	        url: "service.php",
	        dataType: "json",
	        data: "search=" + searchstring + "&season=" + season 
	    })
	    .done(function(response) {
		    // Set the message text.
	    	console.log(response);
	    	$("#datatable").show("slow");
	    	$('#resulttable').DataTable({
	    	    searching: false,
	            data: response,
	            columns: [
	                { title: "DateTime" },
	                { title: "Team Name" },
	                { title: "Team Name" },

	            ]
	        });
	    })
	    .fail(function(response) {
		    alert("Error");
	    });
	    
	    
	});
	
});
