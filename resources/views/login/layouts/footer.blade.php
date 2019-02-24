			</div>
			</div>
			<div class="main">
				<ul id="cbp-bislideshow" class="cbp-bislideshow">
					<li><img src="{{url('design')}}/images/gif1.gif" alt="image01"/></li>
					<li><img src="{{url('design')}}/images/2.jpg" alt="image02"/></li>
					<li><img src="{{url('design')}}/images/3.jpg" alt="image03"/></li>
					<li><img src="{{url('design')}}/images/gif3.gif" alt="image04"/></li>
					<li><img src="{{url('design')}}/images/1.jpg" alt="image05"/></li>
					<li><img src="{{url('design')}}/images/4.jpg" alt="image06"/></li>
				</ul>
			</div>
		</div>
		<script src="{{url('design')}}/js/jquery.imagesloaded.min.js"></script>
		<script src="{{url('design')}}/js/cbpBGSlideshow.min.js"></script>
		<script>
			$(function() {
				cbpBGSlideshow.init();
			});
			(function() {
				var isSafari = !!navigator.userAgent.match(/Version\/[\d\.]+.*Safari/);
				if(isSafari) {
					document.getElementById('support-note').style.display = 'block';
				}
			})();
		</script>
		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script  src="{{ asset('js/app.js')}}"></script>
	</body>
</body>