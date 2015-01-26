$(function() {

    var group_id = ci_session.getSessionData('group_id');


    $("#personsGrid th:last-child()").each(function() {
	$(this).addClass('editBtn');
    });

    var oTable = $('#personsGrid')
        .dataTable({
	    "aoColumnDefs": [
		{ "sType": "de_date", "aTargets": [0] }],
            "fnDrawCallback": function(oSettings) {
                iMax = oSettings.fnRecordsTotal();
                iTotal = oSettings.fnRecordsDisplay();

                if (iTotal != iMax) {
                    //filterApplied(oSettings);
                }

		$('.gridDelete').click(function(e) {
		    var Check = confirm(unescape("Soll der Eintrag wirklich gel%F6scht werden?"));

		    if (Check === false)
			return false;
		});


            },
            "fnInitComplete ": function(oSettings) {
		//                console.log('init complete');
            },
            "bStateSave": true,
        });
    // --------------------------------------------------------------------
    





});
