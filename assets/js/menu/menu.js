$(document).ready(function () {
  var url = base_url() + "menu/show";
  var columns = [
    {
      data: null,
      render: function (data, type, row, meta) {
        return meta.row + meta.settings._iDisplayStart + 1;
      },
    },
    { data: "name" },
    { data: "controller", render: (data) => "/" + data },
    { data: "category" },
    {
      data: "parent_name",
      render: (data) => (data ? data : ""),
    },
    { data: "order" },
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

  const setTables = gridDatatables(url, columns,false);

  makeTableSortable("#table-data", base_url() + "menu/orders", setTables);
});

addData();
editData();
modalClose();
modalProcess();
modalDelete();

$(document).on("click", "#add_ctg_menu", function () {
  var url = $(this).data("url");

  var data = {
      inp_new_menu: $('#inp_new_menu').val(),
      _token: getCookie()
  };  

  $.ajax({
    url: url,
    method: "POST",
    dataType: "JSON",
    async: false,
    data: data,
    success: function (response) {
      if (!response.success) {
        if (!response.validate) {
          $.each(response.messages, function (key, value) {
            addErrorValidation(key, value);
          });
        }
        return;
      }

      if (response.validate) {
        message(response.success, response.messages);
        $('#inp_new_menu').val("");

        let name = response.data.name;
        name = name.charAt(0).toUpperCase() + name.slice(1);

        let newOption = new Option(
            name,
            response.data.id,
            false,
            false
        );

        $('#category').append(newOption).trigger('change');

      }
    },
    error: function (jqXHR) {
      errorValidation(jqXHR);
    },
  });
});

$(document).on("change", "#status", function () {
  if ($(this).is(":checked")) {
    $("#status-text").text("Aktif");
  } else {
    $("#status-text").text("Tidak Aktif");
  }
});

$(document).on("click", 'a[data-bs-toggle="tab"]', function (e) {
  e.preventDefault();

  const target = $(this).attr("href");

  $(".nav-link").removeClass("active");
  $(".tab-pane").removeClass("show active");
  $(this).addClass("active");
  $(target).addClass("show active");

  const isGroup = target === "#group_menu";
  $("#btnAdd").html(
    `<i class="fa-solid fa-plus fs-4 me-2"></i>Tambah ${
      isGroup ? "Group" : "Menu"
    }`
  );
  $("#btnAdd").attr(
    "data-url",
    base_url() + `menu/${isGroup ? "insert_group" : "insert"}`
  );
});
