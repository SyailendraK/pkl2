function getXMLHTTPRequest() {
	var req = false;
	try {
		/* for Firefox */
		req = new XMLHttpRequest();
	} catch (err) {
		try {
			/* for some versions of IE */
			req = new ActiveXObject("Msxml2.XMLHTTP");
		} catch (err) {
			try {
				/* for some other versions of IE */
				req = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (err) {
				req = false;
			}
		}
	}
	return req;
}

function view_input_get() {
	var xmlhttp = getXMLHTTPRequest();
	//get input value
	var id = encodeURI(document.getElementById('btn-update').value);
	var address = encodeURI(document.getElementById('address').value);
	var city = encodeURI(document.getElementById('city').value);
	//set url and inner
	var url = "process_form_get.php?name=" + name + "&address=" + address + "&city=" + city;
	var inner = "user_input";
	//open request 
	xmlhttp.open('GET', url, true);
	xmlhttp.onreadystatechange = function () {
		document.getElementById(inner).innerHTML = '<img src="images/ajax_loader.jpg" /> ';
		if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)) {
			document.getElementById(inner).innerHTML = xmlhttp.responseText;
		}
		return false;
	}
	xmlhttp.send(null);
}

function view_input_post_pangkalan(id) {
	var xmlhttp = getXMLHTTPRequest();
	//get input value
	//set url and inner
	var inner = "alamat_pangkalan";
	var url = "process_pangkalan";
	var params = "id=" + id;
	xmlhttp.open("POST", url, true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded ");

	xmlhttp.onreadystatechange = function () {
		// document.getElementById(inner).innerHTML = '<img src="images/ajax_loader.jpg" /> ';
		if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)) {
			document.getElementById(inner).innerHTML =
				xmlhttp.responseText;
		}
		return false;
	}
	xmlhttp.send(params);
}

function view_input_post_pengemudi(id) {
	var xmlhttp = getXMLHTTPRequest();
	//get input value
	//set url and inner
	var inner = "pengemudi";
	var url = "process_pengemudi";
	var params = "id=" + id;
	xmlhttp.open("POST", url, true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded ");

	xmlhttp.onreadystatechange = function () {
		// document.getElementById(inner).innerHTML = '<img src="images/ajax_loader.jpg" /> ';
		if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)) {
			document.getElementById(inner).innerHTML =
				xmlhttp.responseText;
		}
		return false;
	}
	xmlhttp.send(params);
}
var no = 2;
var del = false;
var del2 = false;
var ke = 3;

function setSession(k) {
	sessionStorage.setItem("pangkalan-" + k, document.getElementById('pangkalan-' + k).value);
	sessionStorage.setItem("banyak-" + k, document.getElementById("banyak-" + k).value);
	sessionStorage.setItem("faktur-" + k, document.getElementById("faktur-" + k).value);
}

function view_input_post_add() {
	if (no <= 8) {
		if (no == 8) {
			document.getElementById("tbh").setAttribute("style", "display: none;");
		} else {
			document.getElementById("tbh").setAttribute("style", "display: block;");
		}
		if (del2 == false) {
			for (k = 1; k < no; k++) {
				sessionStorage.setItem("pangkalan-" + k, document.getElementById('pangkalan-' + k).value);
				sessionStorage.setItem("banyak-" + k, document.getElementById("banyak-" + k).value);
				sessionStorage.setItem("faktur-" + k, document.getElementById("faktur-" + k).value);
			}
		}

		var xmlhttp = getXMLHTTPRequest();
		//get input value
		//set url and inner
		var inner = "tambah";
		var url = "../../Rencana/process_add";
		var params = "no=" + no;
		xmlhttp.open("POST", url, true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded ");

		xmlhttp.onreadystatechange = function () {
			// document.getElementById(inner).innerHTML = '<img src="images/ajax_loader.jpg" /> ';
			if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)) {
				if (del == false) {
					document.getElementById(inner).innerHTML = xmlhttp.responseText;
					if (sessionStorage.getItem('pangkalan-1') != null) {
						// console.log(no);
						for (n = 1; n <= no; n++) {
							document.getElementById('pangkalan-' + n).value = sessionStorage.getItem('pangkalan-' + n);
							document.getElementById("banyak-" + n).value = sessionStorage.getItem('banyak-' + n);
							document.getElementById("faktur-" + n).value = sessionStorage.getItem('faktur-' + n);
						}
					}
					del2 = false;
					no += 1;
				} else {
					var temp = "deleteFormGroup-" + ke;
					document.getElementById(temp).innerHTML = '';
					del = false;
					if (no > 1) {
						no -= 1;
					}
					view_input_post_add();
				}
			}
			return false;
		}
		xmlhttp.send(params);
	} else {
		document.getElementById("tbh").setAttribute("style", "display: none;");
	}
}

function deleteForm(k) {
	if (no > 2) {
		no = no - 1;
		ke = k;
		if (no != k) {
			for (n = k; n < no; n++) {
				if (n == k) {
					sessionStorage.setItem("pangkalan-" + n, null);
					sessionStorage.setItem("banyak-" + n, null);
					sessionStorage.setItem("faktur-" + n, null);
				}

				var next = n + 1;
				sessionStorage.setItem("pangkalan-" + n, sessionStorage.getItem("pangkalan-" + next));
				sessionStorage.setItem("banyak-" + n, sessionStorage.getItem("banyak-" + next));
				sessionStorage.setItem("faktur-" + n, sessionStorage.getItem("faktur-" + next));
			}
			sessionStorage.setItem("pangkalan-" + no, null);
			sessionStorage.setItem("banyak-" + no, null);
			sessionStorage.setItem("faktur-" + no, null);
		} else {
			sessionStorage.setItem("pangkalan-" + k, null);
			sessionStorage.setItem("banyak-" + k, null);
			sessionStorage.setItem("faktur-" + k, null);
		}
		del = true;
		del2 = true;
		view_input_post_add();
	}
}

function view_input_post_tambah(id) {
	var xmlhttp = getXMLHTTPRequest();

	var inner = "updateModel";
	var url = "../../MAkun/processTambah";
	var params = "id=" + id;
	xmlhttp.open("POST", url, true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded ");

	xmlhttp.onreadystatechange = function () {
		// document.getElementById(inner).innerHTML = '<img src="images/ajax_loader.jpg" /> ';
		if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)) {
			document.getElementById(inner).innerHTML =
				xmlhttp.responseText;
			no += 1;
		}
		return false;
	}
	xmlhttp.send(params);
}

function view_input_post_rencana(id) {
	var xmlhttp = getXMLHTTPRequest();
	var inner = "updateRencana";
	var url = "../../Rencana/updateRencana";
	var params = "id=" + id;
	xmlhttp.open("POST", url, true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded ");

	xmlhttp.onreadystatechange = function () {
		// document.getElementById(inner).innerHTML = '<img src="images/ajax_loader.jpg" /> ';
		if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)) {
			document.getElementById(inner).innerHTML =
				xmlhttp.responseText;
			no += 1;
		}
		return false;
	}
	xmlhttp.send(params);
}

function view_input_post_mpangkalan(id) {
	var xmlhttp = getXMLHTTPRequest();

	var inner = "updateModal";
	var url = "../../MPangkalan/processPangkalan";
	var params = "id=" + id;
	xmlhttp.open("POST", url, true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded ");

	xmlhttp.onreadystatechange = function () {
		// document.getElementById(inner).innerHTML = '<img src="images/ajax_loader.jpg" /> ';
		if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)) {
			document.getElementById(inner).innerHTML =
				xmlhttp.responseText;
		}
		return false;
	}
	xmlhttp.send(params);
}

function view_input_post_nota(id) {
	var xmlhttp = getXMLHTTPRequest();
	var inner = "updateModalNota";
	var url = "../../Nota/getUpdateNota";
	var params = "id=" + id;
	xmlhttp.open("POST", url, true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded ");

	xmlhttp.onreadystatechange = function () {
		// document.getElementById(inner).innerHTML = '<img src="images/ajax_loader.jpg" /> ';
		if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)) {
			document.getElementById(inner).innerHTML =
				xmlhttp.responseText;
		}
		return false;
	}
	xmlhttp.send(params);
}

function view_input_post_jalan(id) {
	var xmlhttp = getXMLHTTPRequest();
	var inner = "updateModalJalan";
	var url = "../../Jalan/getUpdateJalan";
	var params = "id=" + id;
	xmlhttp.open("POST", url, true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded ");

	xmlhttp.onreadystatechange = function () {
		// document.getElementById(inner).innerHTML = '<img src="images/ajax_loader.jpg" /> ';
		if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)) {
			document.getElementById(inner).innerHTML =
				xmlhttp.responseText;
		}
		return false;
	}
	xmlhttp.send(params);
}

function view_input_post_pesanan(id) {
	var xmlhttp = getXMLHTTPRequest();
	var inner = "updateModalPesanan";
	var url = "../../Pesanan/getUpdatePesanan";
	var params = "id=" + id;
	xmlhttp.open("POST", url, true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded ");

	xmlhttp.onreadystatechange = function () {
		// document.getElementById(inner).innerHTML = '<img src="images/ajax_loader.jpg" /> ';
		if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)) {
			document.getElementById(inner).innerHTML =
				xmlhttp.responseText;
		}
		return false;
	}
	xmlhttp.send(params);
}

function view_input_post_pro(id, kat, skat) {
	var xmlhttp = getXMLHTTPRequest();
	//get input value
	console.log("masuk");
	//set url and inner
	var inner = "input_kategori";
	var url = "process_form_post_pro.php";
	var params = "id=" + id + "&kat=" + kat + "&skat=" + skat;
	xmlhttp.open("POST", url, true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded ");

	xmlhttp.onreadystatechange = function () {
		// document.getElementById(inner).innerHTML = '<img src="images/ajax_loader.jpg" /> ';
		if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)) {
			document.getElementById(inner).innerHTML =
				xmlhttp.responseText;
		}
		return false;
	}
	xmlhttp.send(params);
}



var uno = 2;
var udel = false;
var udel2 = false;
var uke = 3;

function usetSession(k) {
	sessionStorage.setItem("upangkalan-" + k, document.getElementById('upangkalan-' + k).value);
	sessionStorage.setItem("ubanyak-" + k, document.getElementById("ubanyak-" + k).value);
	sessionStorage.setItem("ufaktur-" + k, document.getElementById("ufaktur-" + k).value);
}
var flag = true;

function uview_input_post_add() {
	if (flag) {
		uno = parseInt(document.getElementById("signNo").value) + 1;
		flag = false;
		uform = false;
	}

	if (uno <= 8) {
		if (uno == 8) {
			document.getElementById("utbh").setAttribute("style", "display: none;");
		} else {
			document.getElementById("utbh").setAttribute("style", "display: block;");
		}
		if (udel2 == false) {
			for (k = 1; k < uno; k++) {
				var tempBanyak = 0;
				if (document.getElementById("ubanyak-" + k).value != null) {
					tempBanyak = document.getElementById("ubanyak-" + k).value;
				}
				sessionStorage.setItem("upangkalan-" + k, document.getElementById('upangkalan-' + k).value);
				sessionStorage.setItem("ubanyak-" + k, tempBanyak);
				sessionStorage.setItem("ufaktur-" + k, document.getElementById("ufaktur-" + k).value);
			}
		}

		if (first) {
			uno = uno - 1;
			first = false;
		}

		var xmlhttp = getXMLHTTPRequest();
		//get input value
		//set url and inner
		var inner = "utambah";
		var url = "../../Rencana/uprocess_add";
		var params = "uno=" + uno;
		xmlhttp.open("POST", url, true);
		xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded ");

		xmlhttp.onreadystatechange = function () {
			// document.getElementById(inner).innerHTML = '<img src="images/ajax_loader.jpg" /> ';
			if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)) {
				if (udel == false) {
					document.getElementById(inner).innerHTML = xmlhttp.responseText;
					if (sessionStorage.getItem('upangkalan-1') != null) {

						console.log("unoAdd-" + uno);

						for (n = 1; n <= uno; n++) { //coba ganti <=
							document.getElementById('upangkalan-' + n).value = sessionStorage.getItem('upangkalan-' + n);
							document.getElementById("ubanyak-" + n).value = sessionStorage.getItem('ubanyak-' + n);
							document.getElementById("ufaktur-" + n).value = sessionStorage.getItem('ufaktur-' + n);
						}
					}
					udel2 = false;
					uno += 1;
				} else {
					var temp = "udeleteFormGroup-" + uke;
					console.log(temp);
					document.getElementById(temp).innerHTML = '';
					udel = false;
					if (uno > 1) {
						// uno -= 1;
						uno = uno - 1;
					}
					uview_input_post_add();
				}
			}
			return false;
		}
		xmlhttp.send(params);
	} else {
		document.getElementById("utbh").setAttribute("style", "display: none;");
	}
}

var uform = true;
var first = false;

function udeleteForm(k) {
	if (uform) {
		uno = parseInt(document.getElementById("signNo").value) + 1;
		for (x = 1; x < uno; x++) {
			sessionStorage.setItem("upangkalan-" + x, document.getElementById('upangkalan-' + x).value);
			sessionStorage.setItem("ubanyak-" + x, document.getElementById("ubanyak-" + x).value);
			sessionStorage.setItem("ufaktur-" + x, document.getElementById("ufaktur-" + x).value);
		}
		first = true;
		uform = false;
	}
	console.log("uno1-" + uno);
	console.log("k1-" + k);
	console.log("uke1-" + uke);
	if (uno > 2) { //hapus ka
		uno = uno - 1;
		uke = k;
		if (uno != k) {
			for (n = k; n < uno; n++) {
				if (n == k) {
					sessionStorage.setItem("upangkalan-" + n, null);
					sessionStorage.setItem("ubanyak-" + n, null);
					sessionStorage.setItem("ufaktur-" + n, null);
				}

				var next = n + 1;
				sessionStorage.setItem("upangkalan-" + n, sessionStorage.getItem("upangkalan-" + next));
				sessionStorage.setItem("ubanyak-" + n, sessionStorage.getItem("ubanyak-" + next));
				sessionStorage.setItem("ufaktur-" + n, sessionStorage.getItem("ufaktur-" + next));
			}
			sessionStorage.setItem("upangkalan-" + uno, null);
			sessionStorage.setItem("ubanyak-" + uno, null);
			sessionStorage.setItem("ufaktur-" + uno, null);
		} else {
			sessionStorage.setItem("upangkalan-" + k, null);
			sessionStorage.setItem("ubanyak-" + k, null);
			sessionStorage.setItem("ufaktur-" + k, null);
		}
		udel = true;
		udel2 = true;
		console.log("uno2-" + uno);
		console.log("uke2-" + uke);
		uview_input_post_add();
	}
}
