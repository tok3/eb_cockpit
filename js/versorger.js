$.extend(true, $.fn.dataTable.defaults, {
	sDom: "<'row-fluid'<'span6'f><'span6'l><'row-fluid'<'span12'>r>t<'row-fluid'<'span6'i><'span6'p>>",
	sPaginationType: "bootstrap",
	"iDisplayLength": 25,
	oLanguage: {
		sLengthMenu: "_MENU_ Eintr&auml;ge pro Seite",
		sInfo: "Eintrag _START_ bis _END_ von _TOTAL_ ",
		sSearch: "Suche:",
		sInfoFiltered: " (gefiltert aus _MAX_ Eintr&auml;gen)",
   sInfoThousands: ".",
   sInfoEmpty: "Keine Eintr&auml;ge gefunden",
 sLoadingRecords: "Daten werden geladen ...",
sZeroRecords: "Keine Eintr&auml;ge",
sEmptyTable:'nix da',
		oPaginate: {
			sFirst: "Erste Seite",
			sPrevious: "Vorherige Seite",
			sNext: "N&auml;chste Seite"
		}
}
});

$(function() {


	

	var oTable = $('#dt_suppliers')
        .dataTable({
			"aoColumnDefs": [
				{ 'bSortable': false, 'aTargets': [ 0,1 ] }
			],
            "fnDrawCallback": function(oSettings) {

				$("#dt_suppliers tr:gt(0)").each(function () {
					var this_row = $(this);
					$.trim(this_row.find('td:eq(0)').attr('align', 'center'));
					$.trim(this_row.find('td:eq(1)').attr('align', 'center'));

				});

            },
 'iDisplayLength': 25,
            "bStateSave": true
        });








	// --------------------------------------------------------------------
});

