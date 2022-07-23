
    var dataTable = $('#datatableDefault');

    $(document).ready(function () {

        dataTable.DataTable({
            dom: "<'row mb-3'<'col-sm-4'l><'col-sm-8 text-end'<'d-flex justify-content-end'fB>>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",
            lengthMenu: [ 10, 20, 30, 40, 50 ],
            stateSave: false,
            responsive:true,
            "paging": true,
            "lengthChange": true,
            "searching": false,
            "ordering": true,
            "info": false,
            "autoWidth": false,
            "pagingType": "full_numbers",
            "language": {
                "sEmptyTable": "Nenhum registro encontrado",
                "sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
                "sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
                "sInfoFiltered": "(Filtrados de _MAX_ registros)",
                "sInfoPostFix": "",
                "sInfoThousands": ".",
                "sLengthMenu": "_MENU_ resultados por página",
                "sLoadingRecords": "Carregando...",
                "sProcessing": "Processando...",
                "sZeroRecords": "Nenhum registro encontrado",
                "sSearch": "Pesquisa Geral",
                "oPaginate": {
                    "sNext": "Próximo",
                    "sPrevious": "Anterior",
                    "sFirst": "Primeiro",
                    "sLast": "Último"
                },
                "oAria": {
                    "sSortAscending": ": Ordenar colunas de forma ascendente",
                    "sSortDescending": ": Ordenar colunas de forma descendente"
                }
            },
            // Configuração Server Side ----------------------------------------------------------------------------
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url"                      : urlPostDatatable,
                "dataType"                 : "json",
                "type"                     : "POST",
                "data"                     : function ( d ) {
                    d.searchCustom = searchList();
                    return $.extend( {}, d, {
                        "columns"          : columns,
                    } );
                }
            },
            "columns":columns
            // -----------------------------------------------------------------------------------------------------
        });
    });

    function searchList()
    {
        var searchDatatable = $(".searchDatatable");
        var searchFields    = [];
        $.each(searchDatatable, function (index, field){
        var fieldJquery = $(field);
        searchFields.push({
            value:fieldJquery.val(),
            regex:false,
            column:fieldJquery.attr("name"),
            dataTypeFilter:fieldJquery.attr("data-type-filter")
        })
    });
        return searchFields;
    }

    function resetDatatable () {
        dataTable.DataTable().draw();
    }