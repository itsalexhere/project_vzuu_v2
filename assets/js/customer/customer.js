$(document).ready(function () {
    var url = base_url() + "customer/show";

    let columns = [];

    $.ajax({
      url: base_url() + "customer/table_fields",
      method: "POST",
      dataType: "json",
      async: false,
      data: {
        _token: getCookie(),
      },
      success: function (response) {

        const accessViewString = response?.data?.access_view;        

        if (!accessViewString) {
          console.error('access_view tidak ditemukan', response);
          return;
        }

        const accessView = accessViewString.split(',').map(v => v.trim());

        // columns.push({
        //   data: null,
        //   render: function (data, type, row, meta) {
        //     return meta.row + meta.settings._iDisplayStart + 1;
        //   }
        // });

        accessView.forEach(label => {
          const convert_label =  label.toLowerCase().replace(/[^a-z0-9 ]/g, '').replace(/\s+/g, '_');

          if (convert_label === 'name') {
            columns.push({
              data: "name",
              render: function (data, type, row) {
                const urlpath = base_url() + `customer/update/${row.id}`;
                return `
                  <a class="btn-detail"
                    data-url="${urlpath}"
                    data-id="${row.id}"
                    style="text-decoration: underline; cursor:pointer;">
                    ${data}
                  </a>
                `;
              }
            });
          } else {
            columns.push({
              data: convert_label
            });
          }
        });
      }
    });

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

$(document).on("click", ".btn-detail", function () {
  var url = $(this).data("url");
  window.location.href = url;
});
