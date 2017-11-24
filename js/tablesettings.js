$(function () {
    $("#list").jqGrid({
        url: "pms.table.post.php",
        datatype: "xml",
        mtype: "GET",
        colNames: ["ID", "Наименование", "кол-во", "кол-во для заказа"],
        colModel: [
            { 
                name: "ID",
                 align: "center"
            },
            { 
                name: "NAME",
                align: "center"
            },
            { 
                name: "COUNTS", 
                align: "center"
            },
            { 
                name:'quantity', 
                align:'center',
                editable: true
            }
        ],
        cellEdit: true,
        cellsubmit : 'remote',
        pager: "#pager",
        rowNum: 30,
        rowList: [10, 20, 30],
        sortname: "ID",
        sortorder: "asc",
        viewrecords: true,
        gridview: true,
        autoencode: true,
        autowidth: true,
        height: '100%',
        caption: "Остатки 2 склад(Веста)"
    }); 
}); 
$(window).on("resize", function () {
    var $grid = $("#list"),
    newWidth = $grid.closest(".ui-jqgrid").parent().width();
    $grid.jqGrid("setGridWidth", newWidth, true);
}); 