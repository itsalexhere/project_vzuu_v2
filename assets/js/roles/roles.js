$(document).ready(function () {
    var url = base_url() + "roles/show";

    var columns = 
    [
        {
            data: null,
            render: function (data, type, row, meta) {
                return meta.row + meta.settings._iDisplayStart + 1;
            },
        },
                { data: "name" },
        
        { data: "action", width: "17%" }
    ];

    gridDatatables(url, columns);
});

addData();
editData();
modalClose();
modalProcess();
modalDelete();
