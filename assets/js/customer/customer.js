$(document).ready(function () {
    var url = base_url() + "customer/show";

    var columns = 
    [
        {
            data: null,
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            },
        },
        { data: "name" },
        { data: "phone" },
        { data: "gender" },
        { data: "category" },
        { data: "date_of_birth" },
        { data: "email" },
        { data: "address" },
        { data: "allergies" },
        { data: "blood_type" },
        { data: "emergency_contact" },
        { data: "skin_type" },
        { data: "favorite_treatments" },
        { data: "note" },
        
        { data: "action", width: "17%" }
    ];

    gridDatatables(url, columns);
});

addData();
editData();
modalClose();
modalProcess();
modalDelete();

 $(document).on("click", "#btnSide", function () {
    const button = $(this);
    const url = button.data("url");
    const type = button.data("type");
    const id = button.data("id");
    const fullscreen = button.data("fullscreenmodal");
    const modalID = "#modalRight";

  if (type === "modal") {
    const data = [
      { name: "_token", value: getCookie() },
      { name: "type", value: type },
    ];

    if (id !== undefined && id !== null) {
      data.push({ name: "id", value: id });
    }

    $.ajax({
      url: url,
      method: "POST",
      dataType: "JSON",
      data: $.param(data),
      async: false,
      success: function (response) {
        $(modalID + " .modal-dialog").removeClass("modal-fullscreen");

        if (response.failed === undefined) {
          if (fullscreen == 1) {
            $(modalID + " .modal-dialog").addClass("modal-fullscreen");
          }

          $(modalID + " .modal-content").html(response.html);
          checkLibraryOnModal();
          $(modalID).modal("show");
        } else {
          sweetAlertMessage(response.message);
        }
      },
      error: function (jqXHR) {
        const status = jqXHR.status;
        if (status === 401) {
          sweetAlertMessageWithConfirmNotShowCancelButton(
            "Your session has expired or invalid. Please relogin",
            () => (window.location.href = base_url())
          );
        } else {
          sweetAlertMessageWithConfirmNotShowCancelButton(
            "We are sorry, but you do not have access to this service",
            () => location.reload()
          );
        }
      },
    });
  } else if (type === "redirect") {
    window.location.href = url;
  }
});
