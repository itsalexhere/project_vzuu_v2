$(document).on("click", "#btnProcessModal", function () {
  var url = $("#form").data("url");
  var form = $("#form")[0];
  var formData = new FormData(form);

  formData.append("_token", getCookie());

  $.ajax({
    url: url,
    method: "POST",
    dataType: "JSON",
    contentType: false,
    processData: false,
    async: false,
    data: formData,
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

      if (response.validate) {
        message(response.success, response.messages);
      }
    },
    error: function (jqXHR, textStatus, errorThrown) {
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
