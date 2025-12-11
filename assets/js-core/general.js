function base_url() {
  var pathparts = window.location.pathname.split("/");
  if (
    location.host == "localhost:8090" ||
    location.host == "localhost" ||
    location.host == "172.17.1.25"
  ) {
    var folder = pathparts[2].trim("/");
    if (folder == "backend") {
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
    var folder = pathparts[1].trim("/");
    if (folder == "backend") {
      return window.location.origin + "/" + pathparts[1].trim("/") + "/";
    }
    return window.location.origin + "/";
  }
}

var url_asset = base_url() + "assets/uploads/";
var url_asset_metronic = base_url() + "assets/metronic/";

function disabledButton(selector) {
  selector.prop("disabled", true);
}

function loadingButton(selector) {
  disabledButton(selector);
  selector.html(
    '<span class="indicator-label">Please wait...<span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>'
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

$(document).on("change", ":input[type='file']", function () {
  $(this).removeClass("fv-plugins-bootstrap5-row-invalid");
  $(this).next(".invalid-feedback").remove();
});

$(document).on("change", "select", function () {
  $(this).next(".fv-plugins-message-container.invalid-feedback").html("");
});

$(document).on("keyup", "[id^='search_']", function () {
  var value = $(this).val().toLowerCase();
  var tableId = $(this).attr("id").replace("search_", "");

  $("#" + tableId + " tbody tr").filter(function () {
    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
  });
});

function update_csrf(token) {
  $(":input.token_csrf").val(token);
}

function get_csrf() {
  return $(":input.token_csrf").val();
}

function get_csrf_name() {
  return $(":input.token_csrf").data("name");
}

let tbl;
let length = 10;
let searchCustom = [];

// function gridDatatables(
//   baseurl,
//   column,
//   paging = true,
//   tableId = "#table-data",
//   searching = false,
//   defaultLength = 5,
//   lengthOptions = [5, 10, 25, 50, -1]
// ) {
//   if (typeof jQuery === "undefined") {
//     return null;
//   }

//   if (typeof $.fn.DataTable === "undefined") {
//     return null;
//   }

//   const $table = $(tableId);
//   if (!$table.length) {
//     return null;
//   }

//   if (!$table.find("thead").length) {
//     return null;
//   }

//   if (!$table.find("tbody").length) {
//     return null;
//   }

//   try {
//     const tbl = $table.DataTable({
//       ajax: {
//         url: baseurl,
//         dataSrc: function (json) {
//           return json.data || [];
//         },
//         error: function (xhr, error, thrown) {
//           console.error("Ajax error:", error);
//         },
//       },
//       destroy: true,
//       columns: column,
//       info: false,
//       paging: paging,
//       searching: searching,
//       pageLength: defaultLength,
//       lengthMenu: [
//         lengthOptions,
//         lengthOptions.map((val) => (val === -1 ? "All" : val)),
//       ],

//       columnDefs: [
//         {
//           targets: "_all",
//           orderable: true,
//         },
//       ],
//       order: [],
//       dom: '<"top"f>rt<"bottom">',
//       createdRow: function (row, data, dataIndex) {
//         if (data && data.id !== undefined) {
//           $(row).attr("data-id", data.id);
//         }
//       },

//       initComplete: function (settings, json) {},

//       language: {
//         zeroRecords: "No matching records found",
//         emptyTable: "No data available in table",
//       },
//     });

//     return tbl;
//   } catch (error) {
//     console.error("Error initializing DataTable:", error);
//     return null;
//   }
// }

function gridDatatables(
  baseurl,
  column,
  paging = true,
  tableId = "#table-data",
  defaultLength = 5
) {
  if (typeof jQuery === "undefined") return null;
  if (typeof $.fn.DataTable === "undefined") return null;

  const $table = $(tableId);

  if (!$table.length) return null;
  if (!$table.find("thead").length) return null;
  if (!$table.find("tbody").length) return null;

  try {
    const tbl = $table.DataTable({
      ajax: {
        url: baseurl,
        dataSrc: (json) => json.data || [],
        error: (xhr, error) => console.error("Ajax error:", error),
      },

      destroy: true,
      columns: column,
      paging: paging,
      pageLength: defaultLength,
      searching: false,
      info: false,
      dom: '<"top"f>rt<"bottom">',
      columnDefs: [{ targets: "_all", orderable: true }],
      order: [],

      createdRow: function (row, data) {
        if (data && data.id !== undefined) {
          $(row).attr("data-id", data.id);
        }
      },

      initComplete: function () {
        if (paging) {
          createCustomPagination(tbl);
        } else {
          $("#custom-pagination").hide();
        }
      },
    });

    return tbl;
  } catch (error) {
    console.error("Error initializing DataTable:", error);
    return null;
  }
}

function createCustomPagination(table) {
  const pageLength = table.page.len();
  const totalRecords = table.data().count();
  const totalPages = Math.ceil(totalRecords / pageLength);

  const $pagination = $("#custom-pagination");
  $pagination.empty();

  // Previous button
  $pagination.append(`
        <li class="page-item previous disabled">
            <a href="#" class="page-link"><i class="previous"></i></a>
        </li>
    `);

  // Page numbers
  for (let i = 1; i <= totalPages; i++) {
    $pagination.append(`
            <li class="page-item ${i === 1 ? "active" : ""}">
                <a href="#" class="page-link" data-page="${i - 1}">${i}</a>
            </li>
        `);
  }

  // Next button
  $pagination.append(`
        <li class="page-item next">
            <a href="#" class="page-link"><i class="next"></i></a>
        </li>
    `);

  // Click event
  $pagination.on("click", "a.page-link", function (e) {
    e.preventDefault();

    const page = $(this).data("page");
    if (page !== undefined) {
      table.page(page).draw(false);

      // update active state
      $pagination.find("li").removeClass("active");
      $(this).parent().addClass("active");
    }
  });
}

function buttonAction(button, modal = null) {
  const url = button.data("url");
  const type = button.data("type");
  const id = button.data("id");
  const fullscreen = button.data("fullscreenmodal");
  const modalID = modal || "#modalLarge";

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
}

function addData() {
  $(document).on("click", "#btnAdd", function () {
    buttonAction($(this));
  });
}

function editData() {
  $(document).on("click", ".btnEdit", function () {
    buttonAction($(this));
  });
}

function reloadDatatables() {
  addDraw();
  $("#table-data").ajax.reload();
}

function reloadDatatablesCustom() {
  $("#kt_datatable_vertical_scroll").DataTable().ajax.reload();
  $("#kt_datatable_suppliers").DataTable().ajax.reload();
  $("#kt_datatable_brand").DataTable().ajax.reload();
  $("#kt_datatable_warehouse").DataTable().ajax.reload();
  $("#kt_datatable_sources").DataTable().ajax.reload();
}

function addDataOption(getResponse) {
  var option = document.createElement("option");
  option.text = getResponse.name;
  option.value = getResponse.id;

  var select = document.getElementById("parent_id");
  select.appendChild(option);
}

function modalProcess(btnCloseModal = "#btnCloseModal") {
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

        reset_input();
        $("#table-data").DataTable().ajax.reload();
        $(btnCloseModal).trigger("click");

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
}

function modalDelete() {
  $(document).on("click", "button[data-type='confirm']", function () {
    var url = $(this).data("url");
    var title = $(this).data("title");
    var text = $(this).text();

    Swal.fire({
      title: title,
      html: `<strong>${text}</strong>`,
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#0CC27E",
      cancelButtonColor: "#FF586B",
      confirmButtonText: "Yes",
      cancelButtonText: "No, cancel!",
      customClass: {
        confirmButton: "btn btn-success mr-5 btn-sm",
        cancelButton: "btn btn-danger btn-sm",
      },
      buttonsStyling: false,
      allowOutsideClick: false,
    }).then((result) => {
      if (result.isConfirmed) {
        var data = [];
        data.push({ name: "_token", value: getCookie() });

        $.ajax({
          url: url,
          method: "POST",
          dataType: "JSON",
          async: false,
          data: $.param(data),
          success: function (response) {
            $("#table-data").DataTable().ajax.reload();
            Swal.fire(
              "",
              response.text,
              response.success ? "success" : "error"
            );
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
      } else {
        return false;
      }
    });
  });
}

function process(btnCloseModal = "#btnCloseModal") {
  $(document).on("click", "#btnProcessModal", function () {
    var textButton = $(this).text();
    var btn = $(this);
    var url = $("#form").data("url");
    var data = $("#form").serializeArray(); // convert form to array
    data.push({ name: "_token", value: getCookie() });
    $.ajax({
      url: url,
      method: "POST",
      dataType: "JSON",
      async: false,
      data: $.param(data),
      beforeSend: function () {
        loadingButton(btn);
        disabledButton($(btnCloseModal));
      },
      success: function (response) {
        if (!response.success) {
          if (!response.validate) {
            $.each(response.messages, function (key, value) {
              addErrorValidation(key, value);
            });
          }
        } else {
          if (response.type == "insert") {
            if (typeof response.data != "undefined") {
              addDataOption(response.data);
            }
            reset_input();
            $(btnCloseModal).trigger("click");
          }
          reloadDatatables();
        }
        loadingButtonOff(btn, textButton);
        enabledButton($(btnCloseModal));

        if (response.type == "update") {
          if (response.success) {
            var closeModal =
              btnCloseModal != "#btnCloseModal" ? btnCloseModal : "#modalLarge";
            $(btnCloseModal).trigger("click");
          }
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
}

function processNestedFields(btnCloseModal = "#btnCloseModal") {
  $(document).on("click", "#btnProcessModal", function () {
    var textButton = $(this).text();
    var btn = $(this);
    var url = $("#form").data("url");
    var arType = [];
    $("img.upload-img").each(function (i, x) {
      arType.push(x.src);
    });
    var data = $("#form").serializeArray(); // convert form to array
    data.push({ name: "_token", value: getCookie() });
    data.push({ name: "img", value: JSON.stringify(arType) });
    $.ajax({
      url: url,
      method: "POST",
      dataType: "JSON",
      async: false,
      data: $.param(data),

      beforeSend: function () {
        loadingButton(btn);
        disabledButton($(btnCloseModal));
      },
      success: function (response) {
        if (!response.success) {
          if (!response.validate) {
            $.each(response.messages, function (key, value) {
              addErrorValidationNestedFields(key, value);
            });
          }
        } else {
          if (response.type == "insert") {
            if (typeof response.data != "undefined") {
              addDataOption(response.data);
            }
            reset_input();
            modalAutoClose1(closeModal);
          }
          reloadDatatables();
        }
        loadingButtonOff(btn, textButton);
        enabledButton($(btnCloseModal));
        if (response.type == "update") {
          if (response.success) {
            var closeModal =
              btnCloseModal != "#btnCloseModal" ? btnCloseModal : "#modalLarge";
            modalAutoClose(closeModal);
          }
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
}

function processNestedFieldsCustom(btnCloseModal = "#btnCloseModal") {
  $(document).on("click", "#btnProcessModal", function () {
    var textButton = $(this).text();
    var btn = $(this);
    var url = $("#form").data("url");
    var arType = [];
    $("img.upload-img").each(function (i, x) {
      arType.push(x.src);
    });
    var data = $("#form").serializeArray(); // convert form to array
    data.push({ name: "_token", value: getCookie() });
    data.push({ name: "img", value: JSON.stringify(arType) });
    $.ajax({
      url: url,
      method: "POST",
      dataType: "JSON",
      async: false,
      data: $.param(data),

      beforeSend: function () {
        loadingButton(btn);
        disabledButton($(btnCloseModal));
      },
      success: function (response) {
        if (!response.success) {
          if (!response.validate) {
            $.each(response.messages, function (key, value) {
              addErrorValidationNestedFields(key, value);
            });
          }
        } else {
          if (response.type == "insert") {
            if (typeof response.data != "undefined") {
              addDataOption(response.data);
            }
            reset_input();
            modalAutoClose(closeModal);
          }
          reloadDatatables();
        }
        loadingButtonOff(btn, textButton);
        enabledButton($(btnCloseModal));
        if (response.type == "update") {
          if (response.success) {
            var closeModal =
              btnCloseModal != "#btnCloseModal" ? btnCloseModal : "#modalLarge";
            modalAutoClose(closeModal);
          }
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
}

function processSourceAccess(btnCloseModal = "#btnCloseModal") {
  $(document).on("click", "#btnProcessModal", function () {
    Swal.fire({
      title: "Are you sure?",
      text: "You won't be able to revert this!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Yes, save it!",
    }).then((result) => {
      if (result.isConfirmed) {
        var textButton = $(this).text();
        var btn = $(this);
        var url = $("#form").data("url");
        var arType = [];
        $("img.upload-img").each(function (i, x) {
          arType.push(x.src);
        });
        var data = $("#form").serializeArray(); // convert form to array
        data.push({ name: "_token", value: getCookie() });
        data.push({ name: "img", value: JSON.stringify(arType) });
        $.ajax({
          url: url,
          method: "POST",
          dataType: "JSON",
          async: false,
          data: $.param(data),

          beforeSend: function () {
            loadingButton(btn);
            disabledButton($(btnCloseModal));
          },
          success: function (response) {
            if (!response.success) {
              if (!response.validate) {
                $.each(response.messages, function (key, value) {
                  addErrorValidationNestedFields(key, value);
                });
              }
            } else {
              if (response.type == "insert") {
                if (typeof response.data != "undefined") {
                  addDataOption(response.data);
                }
                reset_input();
                modalAutoClose(closeModal);
              }
              reloadDatatables();
            }
            loadingButtonOff(btn, textButton);
            enabledButton($(btnCloseModal));
            if (response.type == "update") {
              if (response.success) {
                var closeModal =
                  btnCloseModal != "#btnCloseModal"
                    ? btnCloseModal
                    : "#modalLarge";
                modalAutoClose(closeModal);
              }
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
      }
    });
  });
}

function message(success, message) {
  if (success) {
    toastr.success(message, "", {
      progressBar: !0,
      timeOut: 2000,
    });
  } else {
    toastr.warning(message, "", {
      progressBar: !0,
      timeOut: 2000,
    });
  }
}

function sweetAlertMessage(message) {
  Swal.fire("", message);
}

function modalClose() {
  $(document).on("click", "#btnCloseModal", function () {
    $("#modalLarge").modal("hide");
  });
}

function modalCloseCustom(btnName, modalName) {
  $(document).on("click", btnName, function () {
    $(modalName).modal("hide");
  });
}

function modalAutoClose(closeModal = "#modalLarge") {
  if (closeModal != "#modalLarge") {
    var idModal = $(closeModal).parent().parent().parent().parent().attr("id");
    $("#" + idModal).modal("hide");
  } else {
    $("#modalLarge2").modal("hide");
    $("#modalLarge3").modal("hide");
    $(closeModal).modal("hide");
  }
}

function reset_input() {
  $("input[data-type='input']").val("");
  $("input[data-type='date']").val("");
  $("textarea[data-type='input']").val("");
  $("input[data-type='checkbox']").prop("checked", false);
  $("select[data-type='select-multiple']").val("").trigger("change");
  $("select[data-type='select']").val("").trigger("change");

  if (typeof $("[data-repeater-item]") != "undefined") {
    $("[data-repeater-item]").slice(2).remove();
  }

  if (typeof $(".dropzone")[0] != "undefined") {
    $(".dropzone")[0].dropzone.files.forEach(function (file) {
      file.previewTemplate.remove();
    });

    $(".dropzone").removeClass("dz-started");
  }

  if ($("#kt_datatable_vertical_scroll")) {
    $("#kt_datatable_vertical_scroll").DataTable().clear().draw();
  }

  $("#remove_image").click();

  if ($("#kt_datatable_fixed_columns")) {
    $("#kt_datatable_fixed_columns").DataTable().clear().draw();
  }
}

function requestFromForm(btn, callback) {
  var url = $("#form").data("url");
  var type = btn.data("type");
  var data = $("#form").serializeArray(); // convert form to array
  data.push({ name: "_token", value: getCookie() });

  $.ajax({
    url: url,
    method: "POST",
    dataType: "JSON",
    async: false,
    data: $.param(data),
    beforeSend: function () {
      loadingButton(btn);
      disabledButton($("#btnCloseModal"));
    },
    success: callback,
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
}

function request(data, btn, callback) {
  var url = btn.data("url");
  data.push({ name: "_token", value: getCookie() });

  $.ajax({
    url: url,
    method: "POST",
    dataType: "JSON",
    async: false,
    data: $.param(data),
    beforeSend: function () {
      //loadingButton(btn);
    },
    success: callback,
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
          // sweetAlertMessageWithConfirmNotShowCancelButton(
          //   "We are sorry, but you do not have access to this service",
          //   function () {
          //     location.reload();
          //   }
          // );
          break;
      }
    },
  });
}

function requestUrl(data, btn, url, callback) {
  data.push({ name: "_token", value: getCookie() });

  $.ajax({
    url: url,
    method: "POST",
    dataType: "JSON",
    async: false,
    data: $.param(data),
    beforeSend: function () {
      //loadingButton(btn);
    },
    success: callback,
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
          // sweetAlertMessageWithConfirmNotShowCancelButton(
          //   "We are sorry, but you do not have access to this service",
          //   function () {
          //     location.reload();
          //   }
          // );
          break;
      }
    },
  });
}

function requestUrlNotLoadingButton(data, url, callback) {
  data.push({ name: "_token", value: getCookie() });

  $.ajax({
    url: url,
    method: "POST",
    dataType: "JSON",
    async: false,
    data: $.param(data),
    success: callback,
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
}

$(document).on("click", "#btnCollapse", function () {
  var result = $(this).hasClass("i-Add");
  if (result) {
    $(this).removeClass("i-Add").addClass("i-Remove");
  } else {
    $(this).removeClass("i-Remove").addClass("i-Add");
  }
});

$(document).on("click", "#btnSearchReset", function () {
  reset_input();
  reloadDatatables();
});

function libraryInput() {
  var checkInputMask = $("input[data-library='inputmask']").data("library");
  if (typeof checkInputMask != "undefined" && checkInputMask == "inputmask") {
    $("input[data-library='inputmask']").inputmask();
  }
  var checkSelect = $("select").hasClass("select2");
  if (checkSelect) {
    $("select[data-library='select2']").select2({
      theme: "bootstrap4",
    });
    $("select[data-library='select2-single']").select2({
      theme: "bootstrap4",
    });
  }
}

function loadingPage() {
  Swal.fire({
    html: '<span class="spinner-border text-primary" role="status"></span><br><br><span class="text-muted fs-6 fw-semibold mt-5">Loading...</span>',
    allowOutsideClick: false,
    showCancelButton: false,
    showConfirmButton: false,
  });
}

function sweetAlertConfirm() {
  $(document).on("click", "button[data-type='confirm']", function () {
    var url = $(this).data("url");
    var title = $(this).data("title");
    var text = $(this).text();

    Swal.fire({
      title: title,
      html: `<strong>${text}</strong>`,
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#0CC27E",
      cancelButtonColor: "#FF586B",
      confirmButtonText: "Yes",
      cancelButtonText: "No, cancel!",
      customClass: {
        confirmButton: "btn btn-success mr-5",
        cancelButton: "btn btn-danger",
      },
      buttonsStyling: false,
      allowOutsideClick: false,
    }).then((result) => {
      if (result.isConfirmed) {
        var data = [];
        data.push({ name: "_token", value: getCookie() });

        $.ajax({
          url: url,
          method: "POST",
          dataType: "JSON",
          async: false,
          data: $.param(data),
          beforeSend: function () {
            loadingPage();
          },
          success: function (response) {
            reloadDatatables();
            Swal.fire(
              "",
              response.text,
              response.success ? "success" : "error"
            );
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
      } else {
        return false;
      }
    });
  });
}

function sweetAlertMessageWithConfirmNotShowCancelButton(message, callback) {
  Swal.fire({
    html: message,
    allowOutsideClick: false,
    showCancelButton: false,
    showConfirmButton: true,
    type: "warning",
    confirmButtonColor: "#0CC27E",
    confirmButtonText: "Ok",
  }).then(callback);
}

function checkLibraryOnModal() {
  var result = $(".modal-body .form-control").hasClass("select2");
  if (result) {
    $("select[data-library='select2-single']").select2({
      theme: "bootstrap4",
    });
    $("select[data-library='select2']").select2({
      theme: "bootstrap4",
    });
  }

  var result = $(".modal-body .form-control").hasClass("singleDateRange");
  if (result) {
    $("input[data-library='singleDateRangeStartTomorrow']").daterangepicker({
      singleDatePicker: true,
      timePicker: false,
      showDropdowns: true,
      startDate: moment().add(1, "days"),
      minDate: moment().add(1, "days"),
      locale: {
        format: "YYYY-MM-DD",
      },
    });
  }

  var result = $(".modal-body #form").hasClass("dropzoneExcel");
  if (result) {
    dropZoneExcel($("#form").data("url"));
  }

  var result = $(".modal-body #formoffline").hasClass("dropzoneExcel");
  if (result) {
    dropZoneExcel($("#formoffline").data("url"));
  }
}

function addErrorValidation(key, value) {
  var check = $("#" + key).data("library");
  var element = $("#" + key);

  if (typeof check == "undefined") {
    element
      .removeClass("fv-plugins-bootstrap5-row-invalid")
      .addClass(value.length < 1 ? "fv-plugins-bootstrap5-row-invalid" : "")
      .next(".invalid-feedback")
      .remove();
    element.after(value);
  } else {
    switch (check) {
      case "select2-single":
        element
          .removeClass("fv-plugins-bootstrap5-row-invalid")
          .addClass(value.length > 0 ? "fv-plugins-bootstrap5-row-invalid" : "")
          .next()
          .next(".invalid-feedback")
          .remove();

        element.next().after(value);
        break;
      case "select2":
        element
          .removeClass("fv-plugins-bootstrap5-row-invalid")
          .addClass(value.length > 0 ? "fv-plugins-bootstrap5-row-invalid" : "")
          .next()
          .next(".invalid-feedback")
          .remove();

        element.next().after(value);
        break;
    }
  }
}

function addErrorValidationNestedFields(key, value) {
  $("input, select, textarea").each(function () {
    var typeTagName = $(this).prop("tagName").toLowerCase();

    switch (typeTagName) {
      case "input":
        var element = $('input[name="' + key + '"]');
        element
          .removeClass("fv-plugins-bootstrap5-row-invalid")
          .addClass(value.length < 1 ? "fv-plugins-bootstrap5-row-invalid" : "")
          .next(".invalid-feedback")
          .remove();
        element.after(value);
        break;
      case "textarea":
        var element = $('textarea[name="' + key + '"]');
        element
          .removeClass("fv-plugins-bootstrap5-row-invalid")
          .addClass(value.length < 1 ? "fv-plugins-bootstrap5-row-invalid" : "")
          .next(".invalid-feedback")
          .remove();
        element.after(value);
        break;
      case "select":
        var element = $('select[name="' + key + '"]');

        //Build Element With Span
        element
          .removeClass("fv-plugins-bootstrap5-row-invalid")
          .addClass(value.length < 1 ? "fv-plugins-bootstrap5-row-invalid" : "")
          .next()
          .next(".invalid-feedback")
          .remove();

        element.next().after(value);

        // element
        //   .removeClass("fv-plugins-bootstrap5-row-invalid")
        //   .addClass(value.length < 1 ? "fv-plugins-bootstrap5-row-invalid" : "")
        //   .next(".invalid-feedback")
        //   .remove();

        // element.after(value);
        break;
      default:
        break;
    }
  });
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

$("#modalLarge").on("hidden.bs.modal", function () {
  $("#modalLarge .modal-dialog").removeClass("modal-fullscreen");
  $("#modalLarge .modal-dialog").removeClass("p-9");
});

$("#modalLarge2").on("hidden.bs.modal", function () {
  $("#modalLarge2 .modal-dialog").removeClass("modal-fullscreen");
  $("#modalLarge2 .modal-dialog").removeClass("p-9");
});

$("#modalLarge3").on("hidden.bs.modal", function () {
  $("#modalLarge3 .modal-dialog").removeClass("modal-fullscreen");
  $("#modalLarge3 .modal-dialog").removeClass("p-9");
});

function loadPaginationDatatables(url, total, page) {
  var data = [];
  data.push({
    name: "total",
    value: total,
  });
  data.push({
    name: "limit",
    value: length,
  });
  data.push({
    name: "page",
    value: page,
  });

  if (typeof total != "undefined") {
    requestUrlNotLoadingButton(data, url, function (response) {
      $(".paginationDatatables").html(response.paging);
    });
  }
}

function addDraw() {
  var draw = $(".draw_datatables").val();
  draw++;
  $(".draw_datatables").val(draw);
}

$(document).on("click", ".paginationDatatables .page-link", function () {
  var halaman = $(this).data("halaman");
  $(".halaman").val(halaman);
  reloadDatatables();
});

$(document).on("click", "#btnReset", function () {
  reset_input();
  reloadDatatables1();
});

function modalAutoClose1(closeModal = "#modalLarge2") {
  if (closeModal != "#modalLarge2") {
    var idModal = $(closeModal).parent().parent().parent().parent().attr("id");
    $("#" + idModal).modal("hide");
  } else {
    $(closeModal).modal("hide");
  }
}

function filterHidden() {
  $("#kt_docs_card_collapsible").collapse("hide");
}

$(document).on("click", "#btnSearchHidden", function () {
  filterHidden();
});

$(document).on("click", "#btnSearchResetUncollapse", function () {
  reset_input();
  filterHidden();
  reloadDatatables();
});

function CloseLoadingPage() {
  Swal.close();
}

function ajax_crud_table_without_number(
  base_url,
  column,
  tableID = "table-data",
  controller = null
) {
  $.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
    return {
      iStart: oSettings._iDisplayStart,
      iEnd: oSettings.fnDisplayEnd(),
      iLength: oSettings._iDisplayLength,
      iTotal: oSettings.fnRecordsTotal(),
      iFilteredTotal: oSettings.fnRecordsDisplay(),
      iPage: Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
      iTotalPages: Math.ceil(
        oSettings.fnRecordsDisplay() / oSettings._iDisplayLength
      ),
    };
  };

  if (typeof permission != "undefined") {
    var permissionBool = Boolean(permission);
    if (!permissionBool) {
      column.pop();
    }
  }

  tbl = $("#" + tableID).DataTable({
    initComplete: function () {
      var api = this.api();
      $("#" + tableID + "_filter input")
        .off(".DT")
        .on("keyup.DT", function (e) {
          if (e.keyCode == 13) {
            api.search(this.value).draw();
          }
        });
      tbl.columns.adjust().draw(false);
    },
    processing: true,
    oLanguage: {
      sProcessing: "loading...",
    },
    serverSide: true,
    responsive: false,
    scrollX: true,
    orderable: false,
    dom:
      "<'row'" +
      "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
      "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
      ">" +
      "<'table-responsive'tr>" +
      "<'row'" +
      "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
      "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
      ">",
    ajax: {
      url: base_url,
      type: "POST",
      data: function (d) {
        var data =
          $("#formSearch").length > 0 ? $("#formSearch").serializeArray() : [];
        return $.extend({}, d, {
          _token: getCookie(),
          filters: data,
        });
      },
    },
    ajax: {
      url: base_url,
      type: "POST",
      data: function (d) {
        var data =
          $("#formSearch").length > 0 ? $("#formSearch").serializeArray() : [];
        return $.extend({}, d, {
          _token: getCookie(),
          filters: data,
        });
      },
    },
    columns: column,
    columnDefs: [
      {
        // Actions
        targets: -1,
        title: "Action",
        width: "300px",
        className: "dt-center",
      },
    ],
    rowCallback: function (row, data, iDisplayIndex) {
      var info = this.fnPagingInfo();
      var page = info.iPage;
      var length = info.iLength;
      var index = page * length + (iDisplayIndex + 1);
    },
  });
}

function ajax_crud_table_without_number_Custom(
  base_url,
  column,
  tableID = "table-data",
  controller = null
) {
  $.fn.dataTableExt.oApi.fnPagingInfo = function (oSettings) {
    return {
      iStart: oSettings._iDisplayStart,
      iEnd: oSettings.fnDisplayEnd(),
      iLength: oSettings._iDisplayLength,
      iTotal: oSettings.fnRecordsTotal(),
      iFilteredTotal: oSettings.fnRecordsDisplay(),
      iPage: Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
      iTotalPages: Math.ceil(
        oSettings.fnRecordsDisplay() / oSettings._iDisplayLength
      ),
    };
  };

  if (typeof permission != "undefined") {
    var permissionBool = Boolean(permission);
    if (!permissionBool) {
      column.pop();
    }
  }

  tbl = $("#" + tableID).DataTable({
    initComplete: function () {
      var api = this.api();
      $("#" + tableID + "_filter input")
        .off(".DT")
        .on("keyup.DT", function (e) {
          if (e.keyCode == 13) {
            api.search(this.value).draw();
          }
        });
      tbl.columns.adjust().draw(false);
    },
    processing: true,
    oLanguage: {
      sProcessing: "loading...",
    },
    serverSide: true,
    responsive: false,
    scrollX: true,
    orderable: false,
    dom:
      "<'row'" +
      "<'col-sm-6 d-flex align-items-center justify-conten-start'l>" +
      "<'col-sm-6 d-flex align-items-center justify-content-end'f>" +
      ">" +
      "<'table-responsive'tr>" +
      "<'row'" +
      "<'col-sm-12 col-md-5 d-flex align-items-center justify-content-center justify-content-md-start'i>" +
      "<'col-sm-12 col-md-7 d-flex align-items-center justify-content-center justify-content-md-end'p>" +
      ">",
    ajax: {
      url: base_url,
      type: "POST",
      data: function (d) {
        var data =
          $("#formSearch").length > 0 ? $("#formSearch").serializeArray() : [];
        return $.extend({}, d, {
          _token: getCookie(),
          filters: data,
        });
      },
    },
    columns: column,
    columnDefs: [
      {
        // Actions
        // targets: -1,
        // title: "Action",
        // width: "300px",
        // className: "dt-center",
      },
    ],
    rowCallback: function (row, data, iDisplayIndex) {
      var info = this.fnPagingInfo();
      var page = info.iPage;
      var length = info.iLength;
      var index = page * length + (iDisplayIndex + 1);
    },
  });
}

function generateNumber() {
  var value = Math.floor(Math.random() * 1000000);
  return "a" + value.toString();
}

function buttonActionData(button, data, modal = null) {
  var url = button.data("url");
  var type = button.data("type");
  var fullscreen = button.data("fullscreenmodal");
  var modalID = modal == null ? "#modalLarge" : modal;
  if (type == "modal") {
    data.push({ name: "_token", value: getCookie() });
    data.push({ name: "type", value: type });
    $.ajax({
      url: url,
      method: "POST",
      dataType: "JSON",
      data: $.param(data),
      async: false,
      success: function (response) {
        $(modalID + ".modal-dialog").removeClass("modal-fullscreen");
        if (typeof response.failed == "undefined") {
          if (fullscreen == 1) {
            $(modalID + " .modal-dialog").addClass("modal-fullscreen");
          }
          $(modalID + " .modal-content").html(response.html);
          checkLibraryOnModal();
          $(modalID).modal("show");
        } else {
          sweetAlertMessage(response.message);
        }
        // $.getScript(base_url() + "assets/metronic/js/scripts.bundle.js");
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
  }
  if (type == "redirect") {
    window.location.href = url;
  }
}

function format_number_to_idr(amount) {
  return "IDR " + amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

const format_number_no_idr = (amount) => {
  return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".");
};

function formatCurrency(input) {
  var value = input.value.replace(/\D/g, "");
  input.value = value.replace(/\B(?=(\d{3})+(?!\d))/g, ".");
}

function reloadDatatablesTabs(id) {
  datatablesTabs[id].ajax.reload();
}

$(document).on("click", "#btnResetSearch", function () {
  let selectField = $(this).parent().parent().parent().find("select")[0];
  let inputField = $(this).parent().parent().parent().find("input");
  let startDate = $('input[id="start_date" ]');
  let endDate = $('input[id="end_date" ]');
  $(selectField).val(null).trigger("change");
  $(inputField[0]).val("");
  $('input[id="lookup_status" ]:checked').prop("checked", false);
  $(startDate).val("");
  $(endDate).val("");
});

function exportData() {
  $(document).on("click", "#btnExport", function () {
    var baseUrl = $(this).data("url");
    var data =
      $("#formSearch").length > 0 ? $("#formSearch").serializeArray() : [];
    data.push({
      name: "search",
      value: $("#table-data_filter input").val(),
    });
    data.push({ name: "_token", value: getCookie() });
    var uri = baseUrl + "?" + $.param(data);
    window.open(uri);
  });
}

function sweetAlertConfirmDeleteHTML() {
  $(document).on("click", "button[data-type='confirm']", function () {
    var confirm = $(this).data("textconfirm");
    var title = $(this).data("title");
    var deleteID = $(this).data("id");

    Swal.fire({
      title: title,
      text: confirm,
      type: "warning",
      showCancelButton: true,
      confirmButtonColor: "#0CC27E",
      cancelButtonColor: "#FF586B",
      confirmButtonText: "Yes",
      cancelButtonText: "No, cancel!",
      confirmButtonClass: "btn btn-success mr-5",
      cancelButtonClass: "btn btn-danger",
      buttonsStyling: false,
      allowOutsideClick: false,
    }).then((result) => {
      if (result.isConfirmed) {
        $("#" + deleteID).remove();
      } else {
        return false;
      }
    });
  });
}

function sweetAlertMessageWithConfirmShowCancelButton(message, callback) {
  Swal.fire({
    html: message,
    allowOutsideClick: false,
    showCancelButton: true,
    showConfirmButton: true,
    icon: "success",
    confirmButtonColor: "#0CC27E",
    confirmButtonText: "Continue to Save",
  }).then(callback);
}

function loading(width = 84, height = 84) {
  const svg = `
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
      style="margin: auto; background: none; display: block; shape-rendering: auto;" width="${width}px" height="${height}px"
      viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
      <path d="M10 50A40 40 0 0 0 90 50A40 42 0 0 1 10 50" fill="#93dbe9" stroke="none">
          <animateTransform attributeName="transform" type="rotate" dur="1s" repeatCount="indefinite" keyTimes="0;1"
              values="0 50 51;360 50 51"></animateTransform>
      </path>
    </svg>
  `;
  return svg;
}

function formatDateIndonesia(date, includeDay = true) {
  var dateObj = new Date(date);

  var options = { year: "numeric", month: "long" };
  if (includeDay) {
    options.day = "2-digit";
  }

  var formattedDate = dateObj.toLocaleDateString("id-ID", options);

  return formattedDate;
}

function formatDateIndonesiaWithTime(date, time = true) {
  var date = new Date(date);

  var options = {
    year: "numeric",
    month: "long",
    day: "2-digit",
  };

  var optionTime = {
    hour: "2-digit",
    minute: "2-digit",
    second: "2-digit",
  };

  var formattedDate = date.toLocaleDateString("id-ID", options);
  var formattedTime = date.toLocaleTimeString("id-ID", optionTime);

  if (time) {
    return formattedDate + " ( " + formattedTime + " )";
  } else {
    return formattedDate;
  }
}

function formatDateMonth(date) {
  var date = new Date(date);

  var options = { year: "numeric", month: "long", day: "2-digit" };
  var formattedDate = date.toLocaleDateString("id-ID", options);

  return formattedDate;
}

function setDateNow() {
  var currentDate = new Date();
  var year = currentDate.getFullYear();
  var month = (currentDate.getMonth() + 1).toString().padStart(2, "0");
  var day = currentDate.getDate().toString().padStart(2, "0");
  var formattedDate = year + "-" + month + "-" + day;

  return formattedDate;
}

function areArraysEqual(arr1, arr2) {
  if (arr1.length !== arr2.length) {
    return false;
  }

  arr1.sort();
  arr2.sort();

  for (let i = 0; i < arr1.length; i++) {
    if (arr1[i] !== arr2[i]) {
      return false;
    }
  }

  return true;
}

function setMessage(name, index) {
  switch (index) {
    case 6:
      return (
        '<div style="margin-top: -2px;margin-bottom: -29px;" class="fv-plugins-message-container invalid-feedback">' +
        name +
        "Double Entry</div>"
      );
      break;
    case 5:
      return (
        '<div style="margin-top: -2px;margin-bottom: -29px;" class="fv-plugins-message-container invalid-feedback">' +
        name +
        " Not Number</div>"
      );
      break;
    case 4:
      return (
        '<div style="margin-top: -2px;margin-bottom: -29px;" class="fv-plugins-message-container invalid-feedback">' +
        name +
        " Already Exist</div>"
      );
      break;
    case 3:
      return (
        '<div style="margin-top: -2px;margin-bottom: -29px;" class="fv-plugins-message-container invalid-feedback">' +
        name +
        " field is required</div>"
      );
      break;
    case 2:
      return (
        '<div style="margin-top: -2px;margin-bottom: -29px;" class="fv-plugins-message-container invalid-feedback">' +
        name +
        " Not Exist</div>"
      );
      break;
    default:
      return "";
      break;
  }
}

function indoMonthName() {
  let monthNames = {
    1: "Januari",
    2: "Februari",
    3: "Maret",
    4: "April",
    5: "Mei",
    6: "Juni",
    7: "Juli",
    8: "Agustus",
    9: "September",
    10: "Oktober",
    11: "November",
    12: "Desember",
  };

  return monthNames;
}

function payment_name() {
  $values = {
    1: "Tunai",
    2: "Transfer",
    3: "Debit",
    4: "QRIS",
    5: "Kartu Kredit",
  };

  return $values;
}

function error_status() {
  let error = function (xhr, status, error) {
    switch (xhr.status) {
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
  };

  return error;
}

function convert_number(number) {
  let numericValue = parseInt(number.replace("IDR ", "").replace(".", ""), 10);

  return numericValue;
}

function resultMonthName(id) {
  let month_name = $.map(indoMonthName(), function (value, key) {
    $("#" + id).append('<option value="' + key + '">' + value + "</option>");
  });

  return month_name;
}

function convertToMonthIndo(dateString) {
  const date = new Date(dateString);
  const month = date.getMonth() + 1;
  const monthNames = indoMonthName();
  return monthNames[month];
}

async function show_discount(url_param, input_id) {
  const dataPush = [{ name: "_token", value: getCookie() }];

  try {
    const result = await $.ajax({
      url: url_param,
      method: "POST",
      dataType: "JSON",
      data: dataPush,
    });

    const getJsonData = result.data;

    for (let i = 0; i < getJsonData.length; i++) {
      $("#" + input_id).append(`
        <option value="${getJsonData[i].id}" data-value="${
        getJsonData[i].value
      }">
          ${getJsonData[i].name} - ${format_number_to_idr(
        getJsonData[i].value
      )} 
        </option>
      `);
    }
  } catch (error) {
    error_status();
  }
}

function set_field(option_type) {
  let bank_name = `<div class="fv-row mb-7">
                        <label class="fw-semibold fs-6">Nama Bank</label>
                        <input type="text" id="bank_name" name="bank_name" class="form-control" >
                      </div>`;

  let sender_name = `<div class="fv-row mb-7">
                    <label class="fw-semibold fs-6">Nama Pengirim</label>
                    <input type="text" id="sender_name" name="sender_name" class="form-control" >
                  </div>`;

  let image = `<div class="fv-row mb-7">
                    <label class="fw-semibold fs-6">Bukti Gambar</label>
                    <input type="file" id="image_file" name="image_file" accept=".jpg, .png" class="form-control" >
                  </div>`;

  let card_number_debit = `<div class="fv-row mb-7">
                    <label class="fw-semibold fs-6">No Kartu</label>
                    <input type="text" id="card_number_debit" name="card_number_debit" class="form-control" >
                  </div>`;

  let card_number = `<div class="fv-row mb-7">
                    <label class="fw-semibold fs-6">No Kartu</label>
                    <input type="text" id="card_number" name="card_number" class="form-control" >
                  </div>`;

  let name_in_card = `<div class="fv-row mb-7">
                    <label class="fw-semibold fs-6">Nama Di Kartu</label>
                    <input type="text" id="name_in_card" name="name_in_card" class="form-control" >
                  </div>`;

  let exp_card = `<div class="fv-row mb-7">
                    <label class="fw-semibold fs-6">Expired Kartu</label>
                    <input type="date" id="exp_card" name="exp_card" class="form-control" >
                  </div>`;

  let edc_type = `<div class="fv-row mb-7">
                          <label class="fw-semibold fs-6 mb-4">Tipe EDC</label>
                          <select class="form-select" id="edc_type" name="edc_type" aria-label="Example select with button ">
                              <option value="" selected>Tipe EDC</option>
                              <option value="">BCA</option>
                              <option value="">Mandiri</option>
                              <option value="">BNI</option>
                          </select>
                      </div>`;

  switch (option_type) {
    case "1":
      $(".payment-transfer").remove();
      $(".payment-debit").remove();
      $(".payment-qris").remove();
      $(".payment-cc").remove();
      $(".charge-debit").remove();
      $(".charge-qris").remove();
      $(".charge-cc").remove();
      $(".charge-debit").remove();
      $(".charge-cc").remove();
      $(".charge-qris").remove();
      break;
    case "2":
      $(".payment-qris").remove();
      $(".payment-debit").remove();
      $(".payment-cc").remove();
      $(".charge-debit").remove();
      $(".charge-cc").remove();
      $(".charge-qris").remove();

      let build_trf =
        "<div class='payment-transfer'>" +
        bank_name +
        sender_name +
        image +
        "</div>";
      $(".payment-type-div").after(build_trf);

      break;
    case "3":
      $(".payment-transfer").remove();
      $(".payment-qris").remove();
      $(".payment-cc").remove();
      $(".charge-qris").remove();
      $(".charge-cc").remove();

      let build_debit =
        "<div class='payment-debit'>" +
        bank_name +
        sender_name +
        card_number_debit +
        image +
        "</div>";
      $(".payment-type-div").after(build_debit);

      break;
    case "4":
      $(".payment-transfer").remove();
      $(".payment-debit").remove();
      $(".payment-cc").remove();
      $(".charge-debit").remove();
      $(".charge-cc").remove();

      let build_qris =
        "<div class='payment-qris'>" + sender_name + image + "</div>";
      $(".payment-type-div").after(build_qris);

      break;
    case "5":
      $(".payment-transfer").remove();
      $(".payment-debit").remove();
      $(".payment-qris").remove();
      $(".charge-debit").remove();
      $(".charge-qris").remove();

      setTimeout(() => {
        $("#exp_card").val(setDateNow());
      }, 100);
      let build_cc =
        "<div class='payment-cc'>" +
        bank_name +
        name_in_card +
        card_number +
        exp_card +
        edc_type +
        image +
        "</div>";
      $(".payment-type-div").after(build_cc);

      break;
    default:
      $(".payment-transfer").remove();
      $(".payment-debit").remove();
      $(".payment-qris").remove();
      $(".payment-cc").remove();
      $(".charge-debit").remove();
      $(".charge-qris").remove();
      $(".charge-cc").remove();
  }
}

function set_field_payment_type(option_type) {
  let build = "";

  switch (option_type) {
    case "1":
      $(".payment-transfer").remove();
      $(".payment-debit").remove();
      $(".payment-qris").remove();
      $(".payment-cc").remove();
      break;
    case "2":
      $(".payment-qris").remove();
      $(".payment-debit").remove();
      $(".payment-cc").remove();

      build = `<div class='form-group row mb-5 mt-6 payment-transfer'>
                    <div class="col-md-6 mb-5">
                      <label class="fw-semibold fs-6">Nama Bank</label>
                      <input type="text" id="bank_name" name="bank_name" class="form-control" >
                    </div>

                    <div class="col-md-6 mb-5">
                      <label class="fw-semibold fs-6">Nama Pengirim</label>
                      <input type="text" id="sender_name" name="sender_name" class="form-control" >
                    </div>

                    <div class="col-md-12 mb-5">
                      <label class="fw-semibold fs-6">Bukti Gambar</label>
                      <input type="file" id="image_file" name="image_file" accept=".jpg, .png" class="form-control" >
                    </div>
                </div>`;

      break;
    case "3":
      $(".payment-transfer").remove();
      $(".payment-debit").remove();
      $(".payment-cc").remove();

      build = `<div class='form-group row mb-5 mt-6 payment-debit'>
                    <div class="col-md-6 mb-5">
                      <label class="fw-semibold fs-6">Nama Bank</label>
                      <input type="text" id="bank_name" name="bank_name" class="form-control" >
                    </div>

                    <div class="col-md-6 mb-5">
                      <label class="fw-semibold fs-6">Nama Pengirim</label>
                      <input type="text" id="sender_name" name="sender_name" class="form-control" >
                    </div>

                    <div class="col-md-6 mb-5">
                      <label class="fw-semibold fs-6">No Kartu</label>
                      <input type="number" id="card_number_debit" name="card_number_debit" class="form-control" >
                    </div>

                    <div class="col-md-6 mb-5">
                      <label class="fw-semibold fs-6">Bukti Gambar</label>
                      <input type="file" id="image_file" name="image_file" accept=".jpg, .png" class="form-control" >
                    </div>
                </div>`;

      break;
    case "4":
      $(".payment-transfer").remove();
      $(".payment-debit").remove();
      $(".payment-cc").remove();

      build = `<div class='form-group row mb-5 mt-6 payment-qris'>
                    <div class="col-md-6 mb-5">
                      <label class="fw-semibold fs-6">Nama Pengirim</label>
                      <input type="text" id="sender_name" name="sender_name" class="form-control" >
                    </div>

                    <div class="col-md-6 mb-5">
                      <label class="fw-semibold fs-6">Bukti Gambar</label>
                      <input type="file" id="image_file" name="image_file" accept=".jpg, .png" class="form-control" >
                    </div>
                </div>`;

      break;
    case "5":
      $(".payment-transfer").remove();
      $(".payment-debit").remove();
      $(".payment-qris").remove();

      setTimeout(() => {
        $("#exp_card").val(setDateNow());
      }, 100);

      build = `<div class='form-group row mb-5 mt-6 payment-cc'>
                    <div class="col-md-6 mb-5">
                      <label class="fw-semibold fs-6">Nama Bank</label>
                      <input type="text" id="bank_name" name="bank_name" class="form-control" >
                    </div>

                    <div class="col-md-6 mb-5">
                      <label class="fw-semibold fs-6">Nama Di Kartu</label>
                      <input type="text" id="name_in_card" name="name_in_card" class="form-control" >
                    </div>

                    <div class="col-md-6 mb-5">
                      <label class="fw-semibold fs-6">No Kartu</label>
                      <input type="number" id="card_number" name="card_number" class="form-control" >
                    </div>

                    <div class="col-md-6 mb-5">
                      <label class="fw-semibold fs-6">Expired Kartu</label>
                      <input type="date" id="exp_card" name="exp_card" class="form-control" >
                    </div>

                    <div class="col-md-6 mb-5">
                        <label class="fw-semibold fs-6">Tipe EDC</label>
                        <select class="form-select" id="edc_type" name="edc_type" aria-label="Example select with button ">
                            <option value="" selected>Tipe EDC</option>
                            <option value="BCA">BCA</option>
                            <option value="Mandiri">Mandiri</option>
                            <option value="BNI">BNI</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-5">
                      <label class="fw-semibold fs-6">Bukti Gambar</label>
                      <input type="file" id="image_file" name="image_file" accept=".jpg, .png" class="form-control" >
                    </div>
                </div>`;
      break;
    default:
      $(".payment-transfer").remove();
      $(".payment-debit").remove();
      $(".payment-qris").remove();
      $(".payment-cc").remove();
  }

  return build;
}

function dayParse(day) {
  let hari = "";

  switch (day) {
    case "Senin_Rabu_Jumat":
      hari = "Senin,Rabu,Jumat";
      break;
    case "Monday":
      hari = "Senin";
      break;
    case "Tuesday":
      hari = "Selasa";
      break;
    case "Wednesday":
      hari = "Rabu";
      break;
    case "Thursday":
      hari = "Kamis";
      break;
    case "Friday":
      hari = "Jumat";
      break;
    case "Selasa_Kamis_Jumat":
      hari = "Selasa,Kamis,Jumat";
      break;
    case "Selasa_Rabu_Kamis":
      hari = "Selasa,Rabu,Kamis";
      break;
    default:
      hari = "Senin - Jumat";
      break;
  }

  return hari;
}

function loadStudentsActive() {
  const dataPush = [{ name: "_token", value: getCookie() }];
  $.ajax({
    url: base_url() + "admins/trx_spp/getAllStudentsActive",
    method: "POST",
    dataType: "JSON",
    async: false,
    data: dataPush,
    success: function (result) {
      let getJsonData = result.data;

      $("#select_students").append(`<option value="">Pilih Siswa</option>`);
      for (let i = 0; i < getJsonData.length; i++) {
        let nis = getJsonData[i].nis === "" ? "NEW" : getJsonData[i].nis;

        const data_students = {
          id: getJsonData[i].id,
          nis: nis,
          name: getJsonData[i].name,
          class: getJsonData[i].class,
          school_name: getJsonData[i].school_name,
          spp_fee: getJsonData[i].spp_fee,
          spp_fee_id: getJsonData[i].spp_fee_id,
        };

        const jsonString = JSON.stringify(data_students);
        const encodeData = btoa(jsonString);

        $("#select_students").append(
          `<option value="` +
            encodeData +
            `">` +
            nis +
            " - " +
            getJsonData[i].name +
            " - " +
            getJsonData[i].class +
            " - " +
            getJsonData[i].school_name +
            `</option>`
        );
      }
    },
    error: error_status(),
  });
}

function loadJamBelajar() {
  let datas = [
    "13.30-15.00",
    "15.00-16.30",
    "16.30-18.00",
    "18.00-19.30",
    "19.30-21.00",
  ];

  let getTime = $("#time").val();

  let selectElement = $("#jam_belajar");

  datas.forEach(function (data) {
    var option = $("<option>", {
      value: data,
      text: data,
    });

    if (data === getTime) {
      option.prop("selected", true);
    }

    selectElement.append(option);
  });
}

function englishToIndonesianDay(englishDay) {
  var dayMap = {
    Monday: "Senin",
    Tuesday: "Selasa",
    Wednesday: "Rabu",
    Thursday: "Kamis",
    Friday: "Jumat",
    Saturday: "Sabtu",
    Sunday: "Minggu",
  };

  return dayMap[englishDay] || englishDay;
}

function generateUUID() {
  return "xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx".replace(/[xy]/g, function (c) {
    var r = (Math.random() * 16) | 0,
      v = c == "x" ? r : (r & 0x3) | 0x8;
    return v.toString(16);
  });
}

function makeTableSortable(tableId, updateUrl, tableInstance) {
  const tableBody = document.querySelector(`${tableId} tbody`);
  if (!tableBody) {
    console.error(`tbody tidak ditemukan di ${tableId}`);
    return;
  }

  Sortable.create(tableBody, {
    animation: 150,
    ghostClass: "sortable-ghost",

    onEnd: function () {
      const orderedData = Array.from(tableBody.querySelectorAll("tr"))
        .map((tr, index) => {
          const id = tr.dataset.id;
          return id ? { id: id, order: index + 1 } : null;
        })
        .filter(Boolean);

      if (orderedData.length === 0) {
        console.warn("Row not affected");
        return;
      }

      $.ajax({
        url: updateUrl,
        method: "POST",
        data: {
          order: JSON.stringify(orderedData),
          _token: getCookie(),
        },
        dataType: "json",
        success: function (response) {
          if (response.success) {
            message(true, response.messages);

            if (
              tableInstance &&
              typeof tableInstance.ajax.reload === "function"
            ) {
              tableInstance.ajax.reload();
            }
          } else {
            message(false, response.messages || "Gagal memperbarui urutan.");
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
    },
  });
}
