window.onscroll=function () {
    //var top = window.pageXOffset ? window.pageXOffset : document.documentElement.scrollTop ? document.documentElement.scrollTop : document.body.scrollTop;
    //if(top > 50){
	if(document.body.scrollTop > 50 || document.documentElement.scrollTop > 50){
		//document.getElementById("headeru").style.position = "fixed";
		document.getElementById("totop").style.display = "initial";
		//document.getElementById("space").style.marginTop="110px";
		document.getElementById("userinfo").style.marginRight="0px";
    }else {
        //document.getElementById("headeru").style.position = "relative";
		document.getElementById("totop").style.display = "none";
		//document.getElementById("space").style.marginTop="0px";
		document.getElementById("userinfo").style.marginRight="60px";
    }
}

function scrollToElement(selector, time, verticalOffset) {
	time = typeof(time) != 'undefined' ? time : 500;
	verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
	element = $(selector);
	offset = element.offset();
	offsetTop = offset.top + verticalOffset;
	$('html, body').animate({
		scrollTop: offsetTop
	}, time);			
}


