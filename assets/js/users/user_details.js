$(document).ready(function () {
  $("#btnClose").on("click", function () {
    var url = $(this).data("url");
    window.location.href = url;
  });
});

$(document).on("click", "#btnProcessModal", function () {
  var url = $("#form").data("url");
  var data = $("#form").serializeArray();
  data.push({ name: "_token", value: getCookie() });

  $.ajax({
    url: url,
    method: "POST",
    dataType: "JSON",
    async: false,
    data: $.param(data),
    success: function (response) {
      if (!response.success) {
        if (!response.validate) {
          $.each(response.messages, function (key, value) {
            addErrorValidation(key, value);
          });
        }
        return;
      }

      if (typeof response.data != "undefined") {
        addDataOption(response.data);
      }

      $("#table-data").DataTable().ajax.reload();

      if (response.validate) {
        message(response.success, response.messages);
      }
    },
    error: function (jqXHR) {
      switch (jqXHR.status) {
        case 401:
          sweetAlertMessageWithConfirmNotShowCancelButton(
            "Your session has expired or invalid. Please relogin",
            function () {
              window.location.href = base_url();
            }
          );
          break;

        default:
          sweetAlertMessageWithConfirmNotShowCancelButton(
            "We are sorry, but you do not have access to this service",
            function () {
              location.reload();
            }
          );
          break;
      }
    },
  });
});
