$(document).ready(function () {
  let formId = localStorage.getItem("form_uuid");
  if (formId) {
    loadFieldsToTable();
  }

  $("#kt_docs_repeater_nested").repeater({
    show: function () {
      $(this).slideDown();

      $(this).find(".select2").remove();

      $(this)
        .find('[data-control="select2"]')
        .each(function () {
          $(this)
            .removeClass("select2-hidden-accessible")
            .removeAttr("data-select2-id")
            .removeAttr("tabindex")
            .removeAttr("aria-hidden");

          $(this).val("");
        });

      $(this).find('[data-control="select2"]').select2({
        width: "100%",
      });
    },

    hide: function (deleteElement) {
      $(this).slideUp(deleteElement);
    },
  });

  $("#row_table_name").show();
  $("#row_list_table").hide();
  $("#fields_raw_sql").hide();
});

$(document).on("click", "#btn_list_users", function () {
  buttonAction($(this));
});

$(document).on("change", "input[name='form_type']", function () {
  let val = $(this).val();

  if (val === "Form") {
    $("#fields_table").show();
    $("#fields_raw_sql").hide();
    $("#field_create_table").show();
    $("#status-table").prop("disabled", false);
    $("#row_table_name").show();
    $("#row_list_table").show();
    $("#table_list_name").prop("disabled", false);
  } else {
    $("#fields_table").hide();
    $("#fields_raw_sql").show();
    $("#field_create_table").hide();
    $("#status-table").prop("disabled", true);
    $("#row_table_name").hide();
    $("#row_list_table").hide();
    $("#table_list_name").prop("disabled", true);
  }
});

$(document).on("change", ".form-check-input", function () {
  const target = $(this).data("target");
  const checkedText = $(this).data("checked");
  const uncheckedText = $(this).data("unchecked");

  $(target).text($(this).is(":checked") ? checkedText : uncheckedText);

  if ($(this).attr("id") === "status-table") {
    if ($(this).is(":checked")) {
      $("#row_table_name").show();
      $("#row_list_table").hide();
      $("#fields_table").show();
    } else {
      $("#row_table_name").hide();
      $("#row_list_table").show();
      $("#fields_table").hide();
    }
  }
});

$(document).on("click", "#add_field", function () {
  let isValid = true;

  // Daftar input yang wajib
  let requiredFields = [{ id: "#field_label", message: "Label wajib diisi" }];

  // Cek semua field
  requiredFields.forEach(function (item) {
    let el = $(item.id);
    let value = el.val() ? el.val().trim() : "";

    // Bersihkan dulu class error
    el.removeClass("fv-plugins-bootstrap5-row-invalid");
    el.next(".invalid-feedback").hide();

    if (value.length < 1) {
      isValid = false;

      // Tambah class error
      el.addClass("fv-plugins-bootstrap5-row-invalid");

      // Jika belum ada invalid-feedback, buatkan
      if (el.next(".invalid-feedback").length === 0) {
        el.after(`<div class="invalid-feedback d-block">${item.message}</div>`);
      } else {
        el.next(".invalid-feedback").text(item.message).show();
      }
    }
  });

  if (!isValid) return;

  let data = $("#form_fields").serializeArray();
  let formId = localStorage.getItem("form_uuid");

  if (!formId) {
    formId = generateUUID();
    localStorage.setItem("form_uuid", formId);
  }

  let storageKey = "form_fields_" + formId;
  let fields = JSON.parse(localStorage.getItem(storageKey)) || [];

  let fieldUUID = generateUUID();
  data.push({ name: "uuid", value: fieldUUID });
  fields.push(data);

  localStorage.setItem(storageKey, JSON.stringify(fields));

  loadFieldsToTable();
});

$(document).on("click", ".remove_field", function () {
  let uuid = $(this).data("uuid");
  let formId = localStorage.getItem("form_uuid");
  let storageKey = "form_fields_" + formId;

  let fields = JSON.parse(localStorage.getItem(storageKey)) || [];

  fields = fields.filter((item) => {
    let row = {};
    item.forEach((i) => (row[i.name] = i.value));
    return row.uuid !== uuid;
  });

  localStorage.setItem(storageKey, JSON.stringify(fields));
  loadFieldsToTable();
});

function loadFieldsToTable() {
  let formId = localStorage.getItem("form_uuid");
  if (!formId) return;

  let storageKey = "form_fields_" + formId;
  let fields = JSON.parse(localStorage.getItem(storageKey)) || [];

  let html = "";

  fields.forEach((item, index) => {
    let row = {};
    item.forEach((i) => (row[i.name] = i.value));

    html += `
            <tr data-uuid="${row.uuid}">
                <td>${index + 1}</td>
                <td>${row.field_label}</td>
                <td>${row.field_label.toLowerCase().replace(/\s+/g, "_")}</td>
                <td>${row.field_type}</td>
                <td>${row.field_label}</td>
                <td>${row.column_type}</td>
                <td>
                    ${
                      row.required === "enabled"
                        ? `
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#217346" class="bi bi-check" viewBox="0 0 16 16">
                                <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"/>
                            </svg>
                          `
                        : `
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#a4373a" class="bi bi-x" viewBox="0 0 16 16">
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                            </svg>
                          `
                    }
                </td>
                <td>
                      ${
                        row["status-field"] === "enabled"
                          ? `
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#217346" class="bi bi-check" viewBox="0 0 16 16">
                                <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z"/>
                            </svg>
                          `
                          : `
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#a4373a" class="bi bi-x" viewBox="0 0 16 16">
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                            </svg>
                          `
                      }
                </td>
                <td>
                    <button class="btn p-0 border-0 bg-transparent me-2 remove_field"
                            data-uuid="${row.uuid}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                             fill="#F2390F" class="bi bi-trash" viewBox="0 0 16 16">
                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                        </svg>
                    </button>
                </td>
            </tr>
        `;
  });

  $("#fields_table tbody").html(html);
}

$(document).on("click", "#save_form", function () {
  var url = $("#form_fields").data("url");

  // Ambil data form utama
  var form = $("#form_fields")[0];
  var formdata = new FormData(form);

  // Tambah token
  formdata.append("_token", getCookie());

  // Ambil UUID form
  let formId = localStorage.getItem("form_uuid");
  let storageKey = "form_fields_" + formId;

  // Ambil semua fields
  let fields = JSON.parse(localStorage.getItem(storageKey)) || [];

  const keysNeeded = [
    "field_label",
    "field_type",
    "column_type",
    "uuid",
    "required",
    "status-field",
  ];

  let formattedFields = [];
  fields.forEach((group, i) => {
    const selected = {};

    keysNeeded.forEach((key) => {
      const item = group.find((x) => x.name === key);
      selected[key] = item?.value || null;
    });

    formattedFields.push(selected);
  });

  // Tambah ke formdata
  formdata.append("fields", JSON.stringify(formattedFields));

  $.ajax({
    url: url,
    method: "POST",
    dataType: "JSON",
    async: false,
    processData: false, // penting
    contentType: false, // penting
    data: formdata,
    success: function (response) {
      if (!response.success) {
        if (!response.validate) {
          $.each(response.messages, function (key, value) {
            addErrorValidation(key, value);
          });
        }
      } else {
        localStorage.removeItem("form_uuid");
        localStorage.removeItem(storageKey);
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
