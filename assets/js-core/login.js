function base_url() {
  var pathparts = window.location.pathname.split("/");
  if (
    location.host == "localhost:8090" ||
    location.host == "localhost" ||
    location.host == "172.17.1.25"
  ) {
    var folder = pathparts[2].trim("/");
    if (folder == "admins") {
      return (
        window.location.origin +
        "/" +
        pathparts[1].trim("/") +
        "/" +
        pathparts[2].trim("/") +
        "/"
      );
    }
    return window.location.origin + "/" + pathparts[1].trim("/") + "/";
  } else {
    return window.location.origin + "/" + pathparts[1].trim("/") + "/";
  }
}

function disabledButton(selector) {
  selector.prop("disabled", true);
}

function loadingButton(selector) {
  disabledButton(selector);
  selector.html(
    '<span class="indicator-label">Menunggu...<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>'
  );
}

function loadingButtonOff(selector, text) {
  enabledButton(selector);
  selector.html('<span class="indicator-label">' + text + "</span>");
}

function enabledButton(selector) {
  selector.prop("disabled", false);
}

$(document).on("keyup", ":input", function () {
  $(this).removeClass("fv-plugins-bootstrap5-row-invalid");
  $(this).next(".invalid-feedback").remove();
});

function update_csrf(token) {
  $(":input.token_csrf").val(token);
}

function setCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(";");
  for (let i = 0; i < ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == " ") {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}

function getCookie() {
  return setCookie("csrf_cookie_name");
}

function textWarning(message) {
  let warning =
    '<div class="alert alert-dismissible bg-light-danger border border-danger border-dashed d-flex flex-column flex-sm-row w-100 p-5 mb-10">';
  warning +=
    '<div class="d-flex flex-column pe-0 pe-sm-10"><h5 class="mb-1">Pesan</h5><span>' +
    message +
    "</span></div>";
  warning +=
    '<button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn btn-icon ms-sm-auto" data-bs-dismiss="alert"><i class="bi bi-x fs-1 text-danger"></i></button>';
  warning += "</div>";

  return warning;
}

$(document).on("submit", "form#login", function (e) {
  e.preventDefault();

  var btn = $("#btnSubmit");
  var textButton = btn.text();
  var url = base_url() + "login/check";
  var msgAlert = $("#alert-messages");

  var data = $(this).serializeArray();
  data.push({ name: "_token", value: getCookie() });

  $.ajax({
    url: url,
    method: "POST",
    dataType: "JSON",
    data: $.param(data),
    beforeSend: function () {
      loadingButton(btn);
    },
    success: function (response) {
      msgAlert.html("");

      if (!response.success) {
        if (!response.validate) {
          $.each(response.messages, function (key, value) {
            var element = $("#" + key);
            element
              .removeClass("fv-plugins-bootstrap5-row-invalid")
              .addClass(
                value.length > 0 ? "fv-plugins-bootstrap5-row-invalid" : ""
              )
              .next(".invalid-feedback")
              .remove();

            element.after(value);
          });
        } else {
          msgAlert.html(textWarning(response.messages));
        }
        loadingButtonOff(btn, textButton);
      } else {
        if (response.menu_first != "") {
          window.location.href = base_url() + response.menu_first;
        } else {
          loadingButtonOff(btn, textButton);
        }
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log(errorThrown);
      loadingButtonOff(btn, textButton);
    },
  });
});
