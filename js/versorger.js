
$(function() {


	

	var oTable = $('#dt_suppliers')
        .dataTable({
			"aoColumnDefs": [
				{ 'bSortable': false, 'aTargets': [ 0,1 ]},
{"sType": "my-sorting", "aTargets": [2,3]}
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

