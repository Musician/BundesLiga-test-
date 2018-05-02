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
	    	if ($.isArray(response))
	    	{
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
	    	} else {
	    		$("#search_results").html("Player: <b>" + searchstring + "</b> scored <b>" + response + "</b> goals this season. (task 4 from the test)");
	    	}
	    		
	    })
	    .fail(function(response) {
	    	console.log(response.responseText);
	    });
	    
	    
	});
	
});
