<footer class="footer">
	<div class=" container-fluid ">
		<!-- <nav>
							<ul>
								<li>
									<a href="https://www.creative-tim.com">
										Creative Tim
									</a>
								</li>
								<li>
									<a href="http://presentation.creative-tim.com">
										About Us
									</a>
								</li>
								<li>
									<a href="http://blog.creative-tim.com">
										Blog
									</a>
								</li>
							</ul>
						</nav> -->
		<div class="copyright" id="copyright">
			&copy; <script>
				document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))

			</script>, PT. Gas Alam Putra.
		</div>
	</div>
</footer>
</div>
</div>
<!--   Core JS Files   -->
<script src="<?= base_url() ?>assets/js/core/jquery.min.js"></script>
<script src="<?= base_url() ?>assets/js/core/popper.min.js"></script>
<script src="<?= base_url() ?>assets/js/core/bootstrap.min.js"></script>
<script src="<?= base_url() ?>assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!--  Google Maps Plugin    -->
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> -->
<!-- Chart JS -->
<script src="<?= base_url() ?>assets/js/plugins/chartjs.min.js"></script>
<!--  Notifications Plugin    -->
<script src="<?= base_url() ?>assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="<?= base_url() ?>assets/js/now-ui-dashboard.min.js?v=1.5.0" type="text/javascript"></script>
<!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
<script src="<?= base_url() ?>assets/demo/demo.js"></script>
<script src="<?= base_url() ?>assets/js/ajax2.js"></script>

<script>
	// var elem = document.documentElement
	var element = document.documentElement;

	function launchFullScreen() {
		if (element.requestFullScreen) {
			element.requestFullScreen();
		} else if (element.mozRequestFullScreen) {
			element.mozRequestFullScreen();
		} else if (element.webkitRequestFullScreen) {
			element.webkitRequestFullScreen();
		}
	}

	set = 0;
	result = [0];

	uset = 0;
	uresult = [0];

	$(document).ready(function () {
		if (sessionStorage.getItem('place') == '<?= $this->uri->segment(1) ?>') {
			$("#main-panel").scrollTop(sessionStorage.getItem('scroll'));
		}
		sessionStorage.clear();
	});

	$("#main-panel").scroll(function () {
		var scroll = $("#main-panel").scrollTop();
		console.log(scroll);
		sessionStorage.setItem('scroll', scroll);
		sessionStorage.setItem('place', '<?= $this->uri->segment(1) ?>');

	});

	function clearJumlah() {
		$('#jumlah').html(0);
	}

	function clearFlash() {
		$('#idNotif').remove();
	}

	function cekJumlah(id) {
		var data = 0;
		if ($('#banyak-' + id).val() != null) {
			data = $('#banyak-' + id).val();
		}
		result[id] = parseInt(data);
		jum = 0;
		result.forEach(element => {
			jum = jum + element;
		});
		$('#jumlah').html(jum);
	}

	function ucekJumlah(id) {
		var data = 0;
		if ($('#ubanyak-' + id).val() != null) {
			data = $('#ubanyak-' + id).val();
		}
		console.log(uno);
		uresult[id] = parseInt(data);

		for (k = 1; k <= parseInt(document.getElementById("signNo").value); k++) {
			uresult[k] = parseInt($('#ubanyak-' + k).val());
		}


		for (b = 1; b <= uresult.length; b++) {
			console.log("datacuy" + b + "-" + uresult[b]);
		}
		jum = 0;
		uresult.forEach(element => {
			if (element != NaN || element != null) {
				jum = jum + element;
			} else {
				jum = jum + 0;
			}
		});
		$('#ujumlah').html(jum);
	}

	function addResult(jum) {
		for (i = 1; i <= jum; i++) {
			uresult[i] = parseInt(sessionStorage.getItem('ubanyak-' + i));
			console.log(sessionStorage.getItem('ubanyak-' + i));
		}
	}

	function pengurangX(id) {
		if (parseInt(no) > 2) {
			var kurang = 0;
			result[id] = 0;
			result[no + 1] = 0;
			if ($('#banyak-' + id).val() != 0) {
				kurang = parseInt($('#banyak-' + id).val());
			}

			for (k = id; k < no; k++) {
				if (result[k + 1] != null) {
					result[k] = result[k + 1];
				} else {
					result[k] = 0;
				}
			}

			$('#jumlah').html($('#jumlah').html() - kurang);
		}
	}

	function upengurangX(id) { //SET DULU DATA DARI DB KE ARRAY RESULT
		console.log("emangAda-" + uno);

		if (parseInt(uno) > 2 || uform) { //first click?
			var kurang = 0;
			uresult[id] = 0;
			uresult[uno + 1] = 0;
			if ($('#ubanyak-' + id).val() != 0 && $('#ubanyak-' + id).val() != null) {
				kurang = parseInt($('#ubanyak-' + id).val());
			}

			for (k = id; k < uno; k++) {
				if (uresult[k + 1] != null) {
					uresult[k] = uresult[k + 1];
				} else {
					uresult[k] = 0;
				}
			}

			$('#ujumlah').html($('#ujumlah').html() - kurang);
		}
	}

	function pengurang(id) {
		set = parseInt($('#banyak-' + id).val());
	}

	function upengurang(id) {
		uset = parseInt($('#ubanyak-' + id).val());
	}

	$('option').mousedown(function (e) {
		e.preventDefault();
		var originalScrollTop = $(this).parent().scrollTop();
		console.log(originalScrollTop);
		$(this).prop('selected', $(this).prop('selected') ? false : true);
		var self = this;
		$(this).parent().focus();
		setTimeout(function () {
			$(self).parent().scrollTop(originalScrollTop);
		}, 0);

		return false;
	});

	// Launch fullscreen for browsers that support it!
	// the whole page
	// $(document).ready(function () {
	// 	setInterval(timestamp, 1000);
	// });

	// function timestamp() {
	// 	$.ajax({
	// 		url: '<?= site_url().$this->uri->segment(1) ?>',
	// 		success: function (data) {
	// 			$('#timestamp').html(data);
	// 		},
	// 	});
	// }

	function startTime() {
		var today = new Date();
		var h = today.getHours();
		var m = today.getMinutes();
		var s = today.getSeconds();
		m = checkTime(m);
		s = checkTime(s);
		document.getElementById('timestamp').innerHTML =
			h + ":" + m + ":" + s;
		var t = setTimeout(startTime, 500);
	}

	function checkTime(i) {
		if (i < 10) {
			i = "0" + i
		}; // add zero in front of numbers < 10
		return i;
	}

	$(".pil").click(function () {
		$(".pil").removeClass("active");
		this.addClass("active");
	});

</script>
</body>

</html>
