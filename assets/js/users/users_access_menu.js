$(document).ready(function () {
  const segments = window.location.pathname.split("/");
  const userId = segments[segments.length - 1];

  var url = base_url() + "users/showUserMenuById/" + userId ?? 0;

  var columns = [
    {
      data: null,
      render: function (data, type, row, meta) {
        return meta.row + meta.settings._iDisplayStart + 1;
      },
    },
    { data: "name" },
    {
      data: "status",
      render: function (data) {
        return data == 1
          ? '<div class="badge badge-light-success">Active</div>'
          : '<div class="badge badge-light-danger">Not Active</div>';
      },
    },
    { data: "parent_name" },
    {
      data: "view",
      render: function (data, type, row) {
        return `
                <label class="form-check form-switch form-check-custom form-check-solid">
                    <input class="form-check-input permission-check"
                           type="checkbox"
                           data-type="view"
                           ${data == 1 ? "checked" : ""}>
                </label>`;
      },
    },
    {
      data: "insert",
      render: function (data) {
        return `
                <label class="form-check form-switch form-check-custom form-check-solid">
                    <input class="form-check-input permission-check"
                           type="checkbox"
                           data-type="insert"
                           ${data == 1 ? "checked" : ""}>
                </label>`;
      },
    },
    {
      data: "update",
      render: function (data) {
        return `
                <label class="form-check form-switch form-check-custom form-check-solid">
                    <input class="form-check-input permission-check"
                           type="checkbox"
                           data-type="update"
                           ${data == 1 ? "checked" : ""}>
                </label>`;
      },
    },
    {
      data: "delete",
      render: function (data) {
        return `
                <label class="form-check form-switch form-check-custom form-check-solid">
                    <input class="form-check-input permission-check"
                           type="checkbox"
                           data-type="delete"
                           ${data == 1 ? "checked" : ""}>
                </label>`;
      },
    },
    {
      data: "import",
      render: function (data) {
        return `
                <label class="form-check form-switch form-check-custom form-check-solid">
                    <input class="form-check-input permission-check"
                           type="checkbox"
                           data-type="import"
                           ${data == 1 ? "checked" : ""}>
                </label>`;
      },
    },
    {
      data: "export",
      render: function (data) {
        return `
                <label class="form-check form-switch form-check-custom form-check-solid">
                    <input class="form-check-input permission-check"
                           type="checkbox"
                           data-type="export"
                           ${data == 1 ? "checked" : ""}>
                </label>`;
      },
    },
  ];

  gridDatatables(url, columns, false);
});

$(document).on("change", ".permission-check", function () {
  let type = $(this).data("type");
  let row = $(this).closest("tr");

  if (type === "view") {
    if (!$(this).is(":checked")) {
      row.find(`.permission-check[data-type!="view"]`).prop("checked", false);
    }
  } else {
    if ($(this).is(":checked")) {
      row.find(`.permission-check[data-type="view"]`).prop("checked", true);
    }
  }
});

$(document).on("change", "input[data-type='check_all']", function () {
  const isChecked = $(this).is(":checked");
  $(".permission-check").prop("checked", isChecked);
});

$(document).on("click", "#btn_save", function () {
  var url = $(this).data("url");
  var formData = [];

  $("#table-data tbody tr").each(function () {
    var rowId = $(this).data("id");

    var dataRow = {
      id: rowId,
      view: $(this).find('input[data-type="view"]').is(":checked") ? 1 : 0,
      insert: $(this).find('input[data-type="insert"]').is(":checked") ? 1 : 0,
      update: $(this).find('input[data-type="update"]').is(":checked") ? 1 : 0,
      delete: $(this).find('input[data-type="delete"]').is(":checked") ? 1 : 0,
      import: $(this).find('input[data-type="import"]').is(":checked") ? 1 : 0,
      export: $(this).find('input[data-type="export"]').is(":checked") ? 1 : 0,
    };

    formData.push(dataRow);
  });

  $.ajax({
    url: url,
    method: "POST",
    dataType: "JSON",
    async: false,
    data: {
      permissions: formData,
      _token: getCookie(),
    },
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
