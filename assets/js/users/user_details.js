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

$(document).on("click", "#save_form_access", function () {
  var url = base_url() + "users/process_access_menu";
  var dataToSend = [];

  $("#table-access-view tbody tr").each(function () {
      var $tr = $(this);

      var menuId = $tr.find('.control-id').val();
      var viewId = $tr.find('.view-id').val();
      var idMenu = $tr.find('.menu-id').val();
      var idUser = $tr.find('.user-id').val();
      var status = $tr.find('td:nth-child(3) input.form-check-input').is(':checked') ? 1 : 0;

      var accessTable = [];
      $tr.find('.field-checkbox:checked').each(function () {
          accessTable.push($(this).val());
      });

      var accessView = {
          view:   $tr.find('#view' + menuId).is(':checked') ? 1 : 0,
          insert: $tr.find('#insert' + menuId).is(':checked') ? 1 : 0,
          update: $tr.find('#update' + menuId).is(':checked') ? 1 : 0,
          delete: $tr.find('#delete' + menuId).is(':checked') ? 1 : 0,
          export: $tr.find('#export' + menuId).is(':checked') ? 1 : 0,
          import: $tr.find('#import' + menuId).is(':checked') ? 1 : 0
      };

      dataToSend.push({
          id: menuId,
          view_id: viewId,
          idMenu: idMenu,
          idUser: idUser,
          status: status,
          access_table: accessTable,   
          access_view: accessView 
      });
  });

  $.ajax({
    url: url,
    method: "POST",
    dataType: "JSON",
    async: false,
     data: { access: dataToSend, _token: getCookie() },
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

$(document).on('change', '.permission-dropdown .form-check-input', function () {
    const $dropdown = $(this).closest('.permission-dropdown');
    const $labelBtn = $dropdown.find('.permission-label');

    const selected = $dropdown
        .find('.form-check-input:checked')
        .map(function () {
            return $(this).val();
        })
        .get();

    if (selected.length === 0) {
        $labelBtn.text('Select option');
    } else {
        $labelBtn.text(selected.join(', '));
    }
});


