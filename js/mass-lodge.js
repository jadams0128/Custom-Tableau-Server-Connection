(function($) {
    "use strict";
	$(document).ready(function() {
		$( ".showPassword" ).click(function() {
		  if ($("#myInput").get(0).type === "password") {
		    $("#myInput").get(0).type = "text";
		  } else {
		    $("#myInput").get(0).type = "password";
		  }
		});
	})
})(jQuery);