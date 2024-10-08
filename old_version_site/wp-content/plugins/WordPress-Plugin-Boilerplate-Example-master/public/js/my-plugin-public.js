(function( $ ) {
	'use strict';

	$(document).ready(() => {
		$('form').addClass("sltop__form");
		console.log("plagin");
	});
	
})( jQuery );

function urlencodeFormData(fd) {
	if (typeof URLSearchParams === "function") {
		var params = new URLSearchParams();
		for (var pair of fd.entries()) {
			typeof pair[1] == "string" && params.append(pair[0], pair[1]);
		}
		return params.toString();
	} else {
		var s = "";

		function encode(s) {
			return encodeURIComponent(s).replace(/%20/g, "+");
		}

		for (var pair of fd.entries()) {
			if (typeof pair[1] == "string") {
				s += (s ? "&" : "") + encode(pair[0]) + "=" + encode(pair[1]);
			}
		}
		return s;
	}
}

var forms = document.getElementsByClassName("sltop__form");

for (var i = 0; i < forms.length; i++) {
	forms[i].addEventListener("submit", function (ev) {
		ev.preventDefault();

		var form = this;
		var oData = new FormData(form);

		if (typeof URLSearchParams === "function") {
			const utm = {
				utm_source: "utm1",
				utm_medium: "utm2",
				utm_campaign: "utm3",
				utm_content: "utm4",
				utm_term: "utm5"
			};
			const urlParams = new URLSearchParams(window.location.search);

			for (var prop in utm) {
				if (urlParams.get(prop) !== null) {
					oData.append(utm[prop], urlParams.get(prop));
				}
			}
		}

		oData.append("view_id", window.view_id);
		oData.append("hash", window.view_id);

		var XHR = ("onload" in new XMLHttpRequest()) ? XMLHttpRequest : XDomainRequest;
		var xhr = new XHR();
		xhr.open("POST", form.action, true);
		xhr.onload = function (oEvent) {
			if (xhr.status == 200) {
				form.reset();
				alert("Заявка отправлена.");
			} else {
				alert("Ошибка " + xhr.status);
			}
		};

		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.send(urlencodeFormData(oData));
	}, false);
}
