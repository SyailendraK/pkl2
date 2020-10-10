<footer class="footer">
	<div class=" container-fluid ">
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

	function clearFlash() {
		$('#idNotif').remove();
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

	function startTime() {
		var today = new Date();
		var h = today.getHours();
		var m = today.getMinutes();
		var s = today.getSeconds();
		m = checkTime(m);
		s = checkTime(s);
		document.getElementById('timestamp2').innerHTML =
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

	function datepicker(min) {
		var d = new Date();
		return d.getDate() - min + '-' + d.getMonth() + 1 + '-' + d.getFullYear();
	}

	// var barChartData = {
	// 	labels: [datepicker(6), datepicker(5), datepicker(4), datepicker(3), datepicker(2), datepicker(1), datepicker(
	// 		0)],
	// 	datasets: [{
	// 		label: 'Dataset 1',
	// 		backgroundColor: 'rgba(255, 99, 132, 0.2)',
	// 		data: [
	// 			10,
	// 			30,
	// 			3,
	// 			34,
	// 			13,
	// 			21,
	// 			4
	// 		]
	// 	}, {
	// 		label: 'Dataset 2',
	// 		backgroundColor: 'rgba(99, 255, 132, 0.2)',
	// 		data: [
	// 			10,
	// 			30,
	// 			3,
	// 			34,
	// 			13,
	// 			21,
	// 			4
	// 		]
	// 	}, {
	// 		label: 'Dataset 3',
	// 		backgroundColor: 'rgba(132, 99, 255, 0.2)',
	// 		data: [
	// 			10,
	// 			30,
	// 			3,
	// 			34,
	// 			13,
	// 			21,
	// 			4
	// 		]
	// 	}, {
	// 		label: 'Dataset 4',
	// 		backgroundColor: 'rgba(80, 170, 200, 0.2)',
	// 		data: [
	// 			10,
	// 			30,
	// 			3,
	// 			34,
	// 			13,
	// 			21,
	// 			4
	// 		]
	// 	}]

	// };
	// window.onload = function () {
	// 	startTime();
	// 	var ctx = document.getElementById('myChart').getContext('2d');
	// 	window.myBar = new Chart(ctx, {
	// 		type: 'bar',
	// 		data: barChartData,
	// 		options: {
	// 			title: {
	// 				display: true,
	// 				text: 'Chart.js Bar Chart - Stacked'
	// 			},
	// 			tooltips: {
	// 				mode: 'index',
	// 				intersect: false
	// 			},
	// 			responsive: true,
	// 			scales: {
	// 				xAxes: [{
	// 					stacked: true,
	// 				}],
	// 				yAxes: [{
	// 					stacked: true
	// 				}]
	// 			}
	// 		}
	// 	});
	// 	startTime();
	// };

	// document.getElementById('randomizeData').addEventListener('click', function() {
	// 	barChartData.datasets.forEach(function(dataset) {
	// 		dataset.data = dataset.data.map(function() {
	// 			return randomScalingFactor();
	// 		});
	// 	});
	// 	window.myBar.update();
	// });

</script>
</body>

</html>
