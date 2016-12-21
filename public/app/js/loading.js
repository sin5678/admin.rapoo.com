document.onreadystatechange = subSomething;
	function subSomething() {
		if (document.readyState == 'complete') {
			setTimeout(function(){
				var load=document.getElementById('spinner');
				load.style.display='none';
				document.getElementsByClassName('swiper-container-h')[0].style.opacity='1';
				load.remove();
			},500);
		}
	}