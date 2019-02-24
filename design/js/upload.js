$(document).ready(function (e) {
	$("#uploadimage").on('submit',(function(e) {
		document.getElementById('loadingpic').style.display = 'block';
		e.preventDefault();
		$("#message").empty();
		var cmnt = $("#ucmnt").val();
		$.ajax({
			url: "./uploadphoto.php?cmnt="+cmnt, // Url to which the request is send
			type: "POST",             // Type of request to be send, called as method
			data: new FormData(this), // Data sent to server, a set of key/value pairs (i.e. form fields and values)
			contentType: false,       // The content type used when sending data to the server.
			cache: false,             // To unable request pages to be cached
			processData:false,        // To send DOMDocument or non processed data file it is set to false
			success: function(data)   // A function to be called if request succeeds
			{
				document.getElementById('loadingpic').style.display = 'none';
				$("#file").wrap('<form>').closest('form').get(0).reset();
				$("#file").unwrap();
				$('#ucmnt').val("");
				//$("#message").html(data);
			}
		});
	}));

// Function to preview image after validation
$(function() {
	$("#file").change(function() {
		$("#message").empty(); // To remove the previous error message
		var file = this.files[0];
		var imagefile = file.type;
		var match= ["image/jpeg","image/png","image/jpg","image/bmp","image/gif"];
		if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]) || (imagefile==match[3]) || (imagefile==match[4]) )){
			//$("#message").html("<a style='color:#c65a5a;'>Please Select a valid Image File</a>");
			$("#file").wrap('<form>').closest('form').get(0).reset();
			$("#file").unwrap();
			return false;
		}else{
			var reader = new FileReader();
			reader.onload = imageIsLoaded;
			reader.readAsDataURL(this.files[0]);
		}
	});
});
	function imageIsLoaded(e) {

	};
});