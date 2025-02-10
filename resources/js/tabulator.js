import xlsx from "xlsx";
import feather from "feather-icons";
import Tabulator from "tabulator-tables";
import swal from 'sweetalert';
import axios from "axios";

(function (cash) {
    "use strict";

    // Tabulator
    if (cash("#tabulator").length) {
        var tabulatorUrl = cash("#tabulator").data('url');
        var tabulatorModel = cash("#tabulator").data('model');

        // Setup Tabulator
        let table = new Tabulator("#tabulator", {
            ajaxURL: tabulatorUrl,
            selectable: true,
            ajaxFiltering: true,
            ajaxSorting: true,
            printAsHtml: true,
            printStyled: true,
            pagination: "remote",
            paginationSize: 10,
            paginationSizeSelector: [10, 20, 30, 40],
            layout: "fitColumns",
            responsiveLayout: "collapse",
            placeholder: "No matching records found",
            columns: [
                {
                    formatter: "responsiveCollapse",
                    width: 40,
                    minWidth: 30,
                    align: "center",
                    resizable: false,
                    headerSort: false,
                },

                // For HTML table
                {
                    title: "AVATAR",
                    minWidth: 100,
                    width: 100,
                    field: "images",
                    hozAlign: "left",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    headerSort:false,
                    formatter(cell, formatterParams) {
                        return `<div class="flex lg:justify-center">
                            <div class="intro-x w-10 h-10 image-fit">
                                <img alt="" class="rounded-full" src="${
                            cell.getData().profile_photo_url
                        }">
                            </div>
                        </div>`;
                    },
                },
                {
                    title: "NAME",
                    minWidth: 200,
                    responsive: 0,
                    field: "name",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        return `<div>
                            <div class="font-medium whitespace-nowrap">${
                            cell.getData().name
                        }</div>
                        </div>`;
                    },
                },
                {
                    title: "EMAIL",
                    minWidth: 200,
                    responsive: 0,
                    field: "email",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        return `<div>
                            <div class="font-medium whitespace-nowrap">${
                            cell.getData().email
                        }</div>
                        </div>`;
                    },
                },
                {
                    title: "COMPANY",
                    minWidth: 200,
                    responsive: 0,
                    field: "company",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        return `<div>
                            <div class="font-medium whitespace-nowrap">${
                            cell.getData().company
                        }</div>
                        </div>`;
                    },
                },
                {
                    title: "DEPARTMENT",
                    minWidth: 200,
                    responsive: 0,
                    field: "department",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        return `<div>
                            <div class="font-medium whitespace-nowrap">${
                            cell.getData().department
                        }</div>
                        </div>`;
                    },
                },
                {
                    title: "DIVISION",
                    minWidth: 200,
                    responsive: 0,
                    field: "division",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        return `<div>
                            <div class="font-medium whitespace-nowrap">${
                            cell.getData().division
                        }</div>
                        </div>`;
                    },
                },
                {
                    title: "POSITION",
                    minWidth: 200,
                    responsive: 0,
                    field: "position",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        return `<div>
                            <div class="font-medium whitespace-nowrap">${
                            cell.getData().position
                        }</div>
                        </div>`;
                    },
                },
                {
                    title: "STATUS",
                    minWidth: 200,
                    field: "status",
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        return `<div class="flex items-center lg:justify-center ${
                            !cell.getData().setup_token
                                ? "text-theme-9"
                                : "text-theme-6"
                        }">
                            <i data-feather="check-square" class="w-4 h-4 mr-2"></i> ${
                            !cell.getData().setup_token ? "Active" : "Waiting for activation"
                        }
                        </div>`;
                    },
                },
                {
                    title: "ACTIONS",
                    minWidth: 200,
                    field: "actions",
                    responsive: 1,
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        let a = cash(`<div class="flex lg:justify-center items-center">
                            <a class="edit flex items-center mr-3" href="javascript:;">
                                <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Edit
                            </a>
                            <a class="delete flex items-center text-theme-6" href="javascript:;">
                                <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Delete
                            </a>
                        </div>`);
                        cash(a)
                            .find(".edit")
                            .on("click", function () {
                                window.location.href = '/'+tabulatorModel+'/'+cell.getData().id+'/edit';
                            });

                        cash(a)
                            .find(".delete")
                            .on("click", function () {
                                swal({
                                    title: "Are you sure?",
                                    text: "You are deleting "+cell.getData().name,
                                    icon: "warning",
                                    buttons: true,
                                    dangerMode: true,
                                })
                                    .then((willDelete) => {
                                        if (willDelete) {
                                            axios.post('/ajax/'+tabulatorModel+'/'+cell.getData().id, {
                                                _method: 'delete',
                                            })
                                                .then(function (response) {
                                                    swal(response.data.message, {
                                                        icon: response.data.type,
                                                    });
                                                    if(response.data.type == 'success') {
                                                        cell.getRow().delete();
                                                    }
                                                })
                                                .catch(function (error) {
                                                    console.log(error);
                                                });

                                        } else {
                                            //
                                        }
                                    });
                            });

                        return a[0];
                    },
                },

                // For print format
                {
                    title: "NAME",
                    field: "name",
                    visible: false,
                    print: true,
                    download: true,
                },
                {
                    title: "EMAIL",
                    field: "email",
                    visible: false,
                    print: true,
                    download: true,
                },
            ],
            renderComplete() {
                feather.replace({
                    "stroke-width": 1.5,
                });
            },
            rowSelectionChanged:function(data, rows){
                //update selected row counter on selection change
                cash("#select-stats span").text(data.length);
            },
        });

        // Redraw table onresize
        window.addEventListener("resize", () => {
            table.redraw();
            feather.replace({
                "stroke-width": 1.5,
            });
        });

        // Filter function
        function filterHTMLForm() {
            let field = cash("#tabulator-html-filter-field").val();
            let type = cash("#tabulator-html-filter-type").val();
            let value = cash("#tabulator-html-filter-value").val();
            table.setFilter(field, type, value);
        }

        // On submit filter form
        cash("#tabulator-html-filter-form")[0].addEventListener(
            "keypress",
            function (event) {
                let keycode = event.keyCode ? event.keyCode : event.which;
                if (keycode == "13") {
                    event.preventDefault();
                    filterHTMLForm();
                }
            }
        );

        // On click go button
        cash("#tabulator-html-filter-go").on("click", function (event) {
            filterHTMLForm();
        });

        // On reset filter form
        cash("#tabulator-html-filter-reset").on("click", function (event) {
            cash("#tabulator-html-filter-field").val("name");
            cash("#tabulator-html-filter-type").val("like");
            cash("#tabulator-html-filter-value").val("");
            filterHTMLForm();
        });

        // Deselect
        cash("#tabulator-select-all").on("click", function (event) {
            console.log('select all');
            table.selectRow();
        });

        cash("#tabulator-deselect-all").on("click", function (event) {
            console.log('deselect all');
            table.deselectRow();
        });

        // Export
        cash("#tabulator-export-csv").on("click", function (event) {
            table.download("csv", "data.csv");
        });

        cash("#tabulator-export-json").on("click", function (event) {
            table.download("json", "data.json");
        });

        cash("#tabulator-export-xlsx").on("click", function (event) {
            window.XLSX = xlsx;
            table.download("xlsx", "data.xlsx", {
                sheetName: "Products",
            });
        });

        cash("#tabulator-export-html").on("click", function (event) {
            table.download("html", "data.html", {
                style: true,
            });
        });

        // Print
        cash("#tabulator-print").on("click", function (event) {
            table.print();
        });
    }

    // Tabulator
    if (cash("#normalTabulator").length) {
        var tabulatorUrl = cash("#normalTabulator").data('url');
        var tabulatorModel = cash("#normalTabulator").data('model');

        var tabulatorColumns = {
            khieunaitocaos: [
                {formatter:"rowSelection", width:60, titleFormatter:"rowSelection", hozAlign:"left", headerSort:false, cellClick:function(e, cell){
                        cell.getRow().toggleSelect();
                    }},
                {
                    formatter: "responsiveCollapse",
                    width: 40,
                    minWidth: 30,
                    align: "center",
                    resizable: false,
                    headerSort: false,
                },

                // For HTML table
                {
                    title: "Mã đơn",
                    responsive: 0,
                    field: "madonthu",
                    hozAlign: "left",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        return `<div><div class="font-medium whitespace-nowrap">${cell.getData().madonthu}</div></div>`;
                    },
                },
                {
                    title: "Người gửi đơn",
                    responsive: 0,
                    field: "creator_id",
                    hozAlign: "left",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        return `<div><div class="font-medium whitespace-nowrap">${cell.getData().creator_id}</div></div>`;
                    },
                },
                {
                    title: "Loai hình",
                    responsive: 0,
                    field: "loaidonthu",
                    hozAlign: "left",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        return `<div><div class="font-medium whitespace-nowrap">${cell.getData().loaidonthu}</div></div>`;
                    },
                },
                {
                    title: "Ngày nhận đơn",
                    responsive: 0,
                    field: "ngaynhapdon",
                    hozAlign: "left",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        return `<div><div class="font-medium whitespace-nowrap">${cell.getData().ngaynhapdon}</div></div>`;
                    },
                },
                {
                    title: "Địa bàn",
                    responsive: 0,
                    field: "diaban",
                    hozAlign: "left",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        return `<div><div class="font-medium whitespace-nowrap">${cell.getData().diaban}</div></div>`;
                    },
                },
                {
                    title: "Người xử lý",
                    responsive: 0,
                    field: "choncanbo",
                    hozAlign: "left",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        return `<div><div class="font-medium whitespace-nowrap">${cell.getData().choncanbo}</div></div>`;
                    },
                },
                {
                    title: "Đơn vị xử lý",
                    responsive: 0,
                    field: "giaochodonvi",
                    hozAlign: "left",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        return `<div><div class="font-medium whitespace-nowrap">${cell.getData().giaochodonvi}</div></div>`;
                    },
                },
                {
                    title: "Trạng thái",
                    responsive: 0,
                    field: "status",
                    hozAlign: "left",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        return `<div><div class="font-medium whitespace-nowrap">${cell.getData().status}</div></div>`;
                    },
                },
                {
                    title: "Hành động",
                    minWidth: 200,
                    field: "actions",
                    responsive: 1,
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        let a = cash(`<div class="flex lg:justify-center items-center">
                            <a class="view flex items-center mr-3" href="javascript:;">
                                <i data-feather="eye" class="w-4 h-4 mr-1"></i> Xem
                            </a>
                            <a class="edit flex items-center mr-3" href="javascript:;">
                                <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Sửa
                            </a>
                            <a class="delete flex items-center text-theme-6" href="javascript:;">
                                <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Xóa
                            </a>
                        </div>`);

                        cash(a)
                            .find(".view")
                            .on("click", function () {
                                window.location.href = '/khieu-nai-to-cao/'+cell.getData().id;
                            });

                        cash(a)
                            .find(".edit")
                            .on("click", function () {
                                window.location.href = '/khieu-nai-to-cao/'+cell.getData().id+'/edit';
                            });

                        cash(a)
                            .find(".delete")
                            .on("click", function () {
                                swal({
                                    title: "Bạn có chắc chắn?",
                                    text: "Bạn đang xóa "+cell.getData().name,
                                    icon: "warning",
                                    buttons: true,
                                    dangerMode: true,
                                })
                                    .then((willDelete) => {
                                        if (willDelete) {
                                            axios.post('/ajax/'+tabulatorModel+'/'+cell.getData().id, {
                                                _method: 'delete',
                                            })
                                                .then(function (response) {
                                                    swal(response.data.message, {
                                                        icon: response.data.type,
                                                    });
                                                    if(response.data.type == 'success') {
                                                        cell.getRow().delete();
                                                    }
                                                })
                                                .catch(function (error) {
                                                    console.log(error);
                                                });

                                        } else {
                                            //
                                        }
                                    });
                            });

                        return a[0];
                    },
                },

                // For print format
                {
                    title: "Mã đơn thư",
                    field: "madonthu",
                    visible: false,
                    print: true,
                    download: true,
                },
            ],
            daibieus: [
                {formatter:"rowSelection", width:60, titleFormatter:"rowSelection", hozAlign:"left", headerSort:false, cellClick:function(e, cell){
                        cell.getRow().toggleSelect();
                    }},
                {
                    formatter: "responsiveCollapse",
                    width: 40,
                    minWidth: 30,
                    align: "center",
                    resizable: false,
                    headerSort: false,
                },

                // For HTML table
                {
                    title: "Họ Tên Đại Biểu",
                    responsive: 0,
                    field: "hoten",
                    hozAlign: "left",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        return `<div><div class="font-medium whitespace-nowrap">${cell.getData().hoten}</div></div>`;
                    },
                },
                {
                    title: "Ngày sinh",
                    responsive: 0,
                    field: "ngaysinh",
                    hozAlign: "left",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        return `<div><div class="font-medium whitespace-nowrap">${cell.getData().ngaysinh}</div></div>`;
                    },
                },
                {
                    title: "Dân tộc",
                    responsive: 0,
                    field: "dantoc",
                    hozAlign: "left",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        return `<div><div class="font-medium whitespace-nowrap">${cell.getData().dantoc}</div></div>`;
                    },
                },
                {
                    title: "Giới tính",
                    responsive: 0,
                    field: "gioitinh",
                    hozAlign: "left",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        return `<div><div class="font-medium whitespace-nowrap">${cell.getData().gioitinh}</div></div>`;
                    },
                },
                {
                    title: "Quê quán",
                    responsive: 0,
                    field: "quequan",
                    hozAlign: "left",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        return `<div><div class="font-medium whitespace-nowrap">${cell.getData().quequan}</div></div>`;
                    },
                },
                {
                    title: "Nghề nghiệp",
                    responsive: 0,
                    field: "nghenghiephiennay",
                    hozAlign: "left",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        return `<div><div class="font-medium whitespace-nowrap">${cell.getData().nghenghiephiennay}</div></div>`;
                    },
                },
                {
                    title: "Hành động",
                    minWidth: 200,
                    field: "actions",
                    responsive: 1,
                    hozAlign: "center",
                    vertAlign: "middle",
                    print: false,
                    download: false,
                    formatter(cell, formatterParams) {
                        let a = cash(`<div class="flex lg:justify-center items-center">
                            <a class="view flex items-center mr-3" href="javascript:;">
                                <i data-feather="eye" class="w-4 h-4 mr-1"></i> Xem
                            </a>
                            <a class="edit flex items-center mr-3" href="javascript:;">
                                <i data-feather="check-square" class="w-4 h-4 mr-1"></i> Sửa
                            </a>
                            <a class="delete flex items-center text-theme-6" href="javascript:;">
                                <i data-feather="trash-2" class="w-4 h-4 mr-1"></i> Xóa
                            </a>
                        </div>`);

                        cash(a)
                            .find(".show")
                            .on("click", function () {
                                window.location.href = '/dai-bieu/'+cell.getData().id;
                            });

                        cash(a)
                            .find(".edit")
                            .on("click", function () {
                                window.location.href = '/dai-bieu/'+cell.getData().id+'/edit';
                            });

                        cash(a)
                            .find(".delete")
                            .on("click", function () {
                                swal({
                                    title: "Bạn có chắc chắn?",
                                    text: "Bạn đang xóa "+cell.getData().name,
                                    icon: "warning",
                                    buttons: true,
                                    dangerMode: true,
                                })
                                    .then((willDelete) => {
                                        if (willDelete) {
                                            axios.post('/ajax/'+tabulatorModel+'/'+cell.getData().id, {
                                                _method: 'delete',
                                            })
                                                .then(function (response) {
                                                    swal(response.data.message, {
                                                        icon: response.data.type,
                                                    });
                                                    if(response.data.type == 'success') {
                                                        cell.getRow().delete();
                                                    }
                                                })
                                                .catch(function (error) {
                                                    console.log(error);
                                                });

                                        } else {
                                            //
                                        }
                                    });
                            });

                        return a[0];
                    },
                },

                // For print format
                {
                    title: "Mã đơn thư",
                    field: "madonthu",
                    visible: false,
                    print: true,
                    download: true,
                },
            ],
        }

        // Setup Tabulator
        let table = new Tabulator("#normalTabulator", {
            ajaxURL: tabulatorUrl,
            selectable: true,
            ajaxFiltering: true,
            ajaxSorting: true,
            printAsHtml: true,
            printStyled: true,
            pagination: "remote",
            paginationSize: 10,
            paginationSizeSelector: [10, 20, 30, 40],
            layout: "fitColumns",
            responsiveLayout: "collapse",
            placeholder: "No matching records found",
            columns: tabulatorColumns[tabulatorModel],
            renderComplete() {
                feather.replace({
                    "stroke-width": 1.5,
                });
            },
            rowSelectionChanged:function(data, rows){
                //update selected row counter on selection change
                cash("#select-stats span").text(data.length);
            },
        });

        // Redraw table onresize
        window.addEventListener("resize", () => {
            table.redraw();
            feather.replace({
                "stroke-width": 1.5,
            });
        });

        // Filter function
        function filterHTMLForm() {
            let field = cash("#tabulator-html-filter-field").val();
            let type = cash("#tabulator-html-filter-type").val();
            let value = cash("#tabulator-html-filter-value").val();
            table.setFilter(field, type, value);
        }

        // On submit filter form
        cash("#tabulator-html-filter-form")[0].addEventListener(
            "keypress",
            function (event) {
                let keycode = event.keyCode ? event.keyCode : event.which;
                if (keycode == "13") {
                    event.preventDefault();
                    filterHTMLForm();
                }
            }
        );

        // On click go button
        cash("#tabulator-html-filter-go").on("click", function (event) {
            filterHTMLForm();
        });

        // On reset filter form
        cash("#tabulator-html-filter-reset").on("click", function (event) {
            cash("#tabulator-html-filter-field").val("name");
            cash("#tabulator-html-filter-type").val("like");
            cash("#tabulator-html-filter-value").val("");
            filterHTMLForm();
        });

        // Delete selected
        cash("#tabulator-delete-selected").on("click", function (event) {
            console.log('delete selected');
            //console.log(table.getSelectedRows());
            var rows = table.getSelectedRows();
            swal({
                title: "Are you sure?",
                text: "You are deleting selected rows",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        let requests = []
                        rows.forEach(function(row) {
                            requests.push(axios.post('/ajax/'+tabulatorModel+'/'+row._row.data.id, {
                                _method: 'delete',
                            }))
                        })

                        axios.all(requests)
                            .then(function(results) {
                                results.forEach(function(response) {
                                    //
                                })

                                for(var i=0;i<rows.length;i++) {
                                    rows[i].delete();
                                }
                            })
                            .catch(function (error) {
                                for(var i=0;i<rows.length;i++) {
                                    rows[i].delete();
                                }
                            })
                    } else {
                        //
                    }
                });
        });

        // Deselect
        cash("#tabulator-select-all").on("click", function (event) {
            console.log('select all');
            table.selectRow();
        });

        cash("#tabulator-deselect-all").on("click", function (event) {
            console.log('deselect all');
            table.deselectRow();
        });

        // Export
        cash("#tabulator-export-csv").on("click", function (event) {
            table.download("csv", tabulatorModel+".csv");
        });

        cash("#tabulator-export-json").on("click", function (event) {
            table.download("json", "data.json");
        });

        cash("#tabulator-export-xlsx").on("click", function (event) {
            window.XLSX = xlsx;
            table.download("xlsx", "data.xlsx", {
                sheetName: "Products",
            });
        });

        cash("#tabulator-export-html").on("click", function (event) {
            table.download("html", "data.html", {
                style: true,
            });
        });

        // Print
        cash("#tabulator-print").on("click", function (event) {
            table.print();
        });
    }
})(cash);
