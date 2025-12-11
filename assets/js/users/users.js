$(document).ready(function () {
  var url = base_url() + "users/show";
  var columns = [
    { data: "id" },
    {
      data: "username",
      render: function (data, type, row) {
        const urlpath =base_url() + `users/detail/${row.id}`;

        return `
          <a class="btn-edit-user"
            data-url="${urlpath}"
            data-id="${row.id}"
            style="text-decoration: underline; cursor:pointer;">
            ${data}
          </a>
        `;
      },
    },
    { data: "email" },
    {
      data: "status",
      render: function (data) {
        return data == 1
          ? '<div class="badge badge-light-success">Active</div>'
          : '<div class="badge badge-light-danger">Tidak Active</div>';
      },
    },
    { data: "created_at" },
    { data: "active_at" },
  ];

  gridDatatables(url, columns);

});

modalClose();
modalProcess();

$(document).on("click", "#btnAdd", function () {
    buttonAction($(this));

    $("#togglePass").on("click", function () {
      let input = $("#pass");
      let icon = $(this);

      if (input.attr("type") === "password") {
          input.attr("type", "text");
          icon.removeClass("fa-eye-slash").addClass("fa-eye");
      } else {
          input.attr("type", "password");
          icon.removeClass("fa-eye").addClass("fa-eye-slash");
      }
    });

});

$(document).on("click", ".btn-edit-user", function () {
  var url = $(this).data("url");
  window.location.href = url;
});

