$(document).ready(function () {
	var modal = $("#modal");
	
	init_click();
	$("#imagesTable").on("pjax:success", function(){
		init_click();
	});
	        	
	function init_click(){		
		//Кнопка просмотра
		$(".view-link").click(function(e) {
			modal.find(".modal-body").html('');				    
			e.preventDefault();					    			    				   
		    $.get(
				'modal',         
				{id: $(this).closest("tr").data("key")},
				function (data) {					
					$(this).trigger("reset");	
					modal.find(".modal-body").html(data);
					modal.modal();								            						
				}  
			);
		});		
	}	
});