function love(numb){
			
var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
          if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
				var x = xmlhttp.responseText;
				if(x.charAt(0) == 'L'){
					$('#heart'+numb).addClass('happy').removeClass('broken');
					$( "#post"+numb).text(x.substring(1));
				}else if((x.charAt(0) == 'U')){
					$('#heart'+numb).removeClass('happy').addClass('broken');
					$( "#post"+numb).text(x.substring(1));
				}
          }
      }
      xmlhttp.open("GET", "./likepost.php?like="+numb, true);
      xmlhttp.send();
}
