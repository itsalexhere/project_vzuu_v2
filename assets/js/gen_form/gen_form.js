$(document).ready(function () {
  var url = base_url() + "gen_form/show";
  var columns = [
    {
      data: null,
      render: function (data, type, row, meta) {
        return meta.row + meta.settings._iDisplayStart + 1;
      },
    },
    { data: "form_name" },
    { data: "form_type" },
    { data: "table_name" },
    { data: "description" },
    {
      data: "status",
      render: function (data) {
        return data == 1
          ? '<div class="badge badge-light-success">Active</div>'
          : '<div class="badge badge-light-danger">Tidak Active</div>';
      },
    },
    { data: "action", width: "17%" },
  ];

  gridDatatables(url, columns);
});

$("#btnAdd").on("click", function () {
  let url = $(this).data("url");

  // 1. Hapus form_uuid lama
  localStorage.removeItem("form_uuid");

  // 2. Hapus semua key form_fields_*
  for (let i = 0; i < localStorage.length; i++) {
    let key = localStorage.key(i);

    if (key && key.startsWith("form_fields_")) {
      localStorage.removeItem(key);
      // karena localStorage berubah, reset loop
      i = -1;
    }
  }

  // 3. Buat form UUID baru
  let formId = generateUUID();
  localStorage.setItem("form_uuid", formId);

  // 4. Redirect
  window.location.href = url;
});

$(".btnEdit").on("click", function () {
  let url = $(this).data("url");

  console.log(url);
  return false;

  // 4. Redirect
  window.location.href = url;
});
