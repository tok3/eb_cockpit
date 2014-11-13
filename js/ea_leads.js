$(function() {



	$("#leadsGrid th:last-child()").each(function() {
	 	$(this).addClass('editBtn');
	});




	var oTable = $('#leadsGrid').dataTable({
			"aoColumnDefs": [
				{ "sType": "de_date", "aTargets": [0] }           ],
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
                console.log('init complete');


            },
            "bStateSave": true,

        });


	// --------------------------------------------------------------------
	


  function submitForm(app)
    {
var sel = 'formEnergieausweis'
var default_action = $('#'+sel).attr('action');

        document.getElementById(sel).action = default_action + '/' + app;


        document.getElementById(sel).submit();
    }


$('.submitLead').click(function(){

submitForm($(this).data('post-act'));
});


// --------------------------------------------------------------------
	

});
