$(document).ready(function () {
  var url = base_url() + "menu/show";
  var columns = [
    { data: "name" },
    { data: "controller", render: (data) => "/" + data },
    {
      data: "parent_name",
      render: (data) => (data ? data : ""),
    },
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

addData();
editData();
modalClose();
process();
sweetAlertConfirm();

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

$(document).on("click", "#btn_add", function () {
  var url = $(this).data("url");
  window.location.href = url;
});
