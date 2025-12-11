$(document).ready(function () {
    var url = base_url() + "report_test/show";

    var columns = 
    [
        {
            data: null,
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            },
        },
                { data: "controller" },
        { data: "menu_name" },
        { data: "user_name" },

    ];

    gridDatatables(url, columns);
});