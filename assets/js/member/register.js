$(document).ready(function(e) {
    var d = new Date();
	var currentYear = d.getFullYear();
	
	for(var startYear = currentYear; startYear > 1900; startYear--) {
		$('select[name=year]')
         .append($("<option></option>")
         .attr("value",startYear)
         .text(startYear)); 
	}
	
	for(var startMonth = 1; startMonth <= 12; startMonth++) {
		$('select[name=month]')
         .append($("<option></option>")
         .attr("value",startMonth)
         .text(startMonth)); 
	}
	
	for(var startDay = 1; startDay <= 31; startDay++) {
		$('select[name=day]')
         .append($("<option></option>")
         .attr("value",startDay)
         .text(startDay)); 
	}
	
	$("#member_register").submit(function(e) {
		if ($("select[name=year]").val() == "" ) {
			$("select[name=year]").css("border-color", "#F00");
			return false;
		}
		
		if ($("select[name=month]").val() == "" ) {
			$("select[name=month]").css("border-color", "#F00");
			return false;
		}
		
		if ($("select[name=day]").val() == "" ) {
			$("select[name=day]").css("border-color", "#F00");
			return false;
		}
		 
		
    });
	
	$("#member_register").validate({
		rules: {			        	        		
			password :  {
				minlength: 8,
				maxlength: 20,
				required: true
			},
			
			password_confirm:{
				equalTo: "#password"
			}
		},
		
		messages: {
    		password :" Enter password 8-20 characters",
    		password_confirm :" Enter confirm password same as password"
	    }
	});
});