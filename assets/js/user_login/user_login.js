$(document).ready(function () {
  var baseurl = base_url() + "admins/user_login/show";
  var column = [
    { data: "id" },
    { data: "fullname" },
    { data: "email" },
    { data: "role_url" },
    {
      data: "status",
      render: function (data) {
        if (data === "1") {
          return '<div class="badge badge-light-success">Active</div>';
        } else {
          return '<div class="badge badge-light-danger">Inactive</div>';
        }
      },
    },
    {
      data: "created_at",
      render: function (data) {
        return formatDateIndonesia(data);
      },
    },
    { data: "action", width: "17%" },
  ];

  ajax_crud_table(baseurl, column);

  sweetAlertConfirm();
  libraryInput();

  $(document).on("click", "#buttonDeleted", function () {
    $(this).parent().parent().remove();
  });

  $(document).on("click", ".view-rolepermissions", function () {
    buttonAction($(this), "#modalLarge2");
  });

  $(document).on("click", "#btnCloseModalFullscreen", function () {
    $("#modalLarge2").modal("hide");
  });

  $(document).on("click", "#btnAdd", function () {
    buttonAction($(this));
  });

  modalClose();
  process();
});
