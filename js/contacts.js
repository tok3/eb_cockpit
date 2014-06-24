$(document).ready(function() {

	
	var user_id = ci_session.getSessionData('user_id');
	var group = ci_session.getSessionData('group');


	var dataset_id = uri_segments[3]; // contacts.id 

	if(group !== 'admin')
	{
		$('.adminStuff').hide();

	}

	if(typeof dataset_id === 'undefined')
	{

		$('#initialDate').remove();

	}

	//tweak for mobiles 
	if(is_mobile != 1)
	{

		//		replacements.datePick('.fdate');
		//		replacements.timePick('.timepicker');

		//		$('#newContact').addClass('button tiny secondary nice');

	}

	// --------------------------------------------------------------------
	// drowpdown zur auswahl von firma oder privatperson
	$('#contactType').change(function(){
		setFormState();
		setTabindex();
	});


	function typeState()
	{
		// remove "pease select" entry after first selection
		if($("#contactType option:selected").val() != 0 && $("#contactType option").length == 3)
		{
			$("#contactType opion:first").remove();

			$(".init").removeClass('hide');


		}

	}



// --------------------------------------------------------------------
	/*
	function axPost(post_url,post_data)
	{
		$.ajax({
			type: "POST",
			async: false,
			data: "post_data=" + post_data,
			url: post_url,
			dataType: "html",
			success: function(data) {
				return retVal = data;
			},
			error: function() {
				return alert("Error occured\nPost url : " + post_url);
			}
		});
return retVal;

	}
var test = axPost(site_url+ 'cockpit/contact_details/axTest','data');
console.log(test);
*/
// --------------------------------------------------------------------
	

	function setFormState(){

		typeState()

		var contactType = $("#contactType option:selected").val();

		var contactInfo = $('#sec_contact_info').detach();

		$('.sections').hide();

		if(contactType == 1)
		{
			$('#sec_contact_info,#sec_addresses, #sec_contacts').show();

			$('.sections:last').after($('#sec_addresses').detach());
		}
		if(contactType == 2)
		{

			$('.sections').show();
			$('#sec_addresses').after($('#sec_contacts').detach());
		}

		if(dataset_id > 0) // datensatz existiert, conactInfo nach unten 
		{
			$('.sections:last').after(contactInfo);
			$('#initialDate').removeClass('hide');
		}
		else // initial display only contac
		{

			$('.sections:first').after(contactInfo);
			$('#contact_info .row').hide();

			if(contactType == 0)
			{
				$('#contact_info .row:first').show();
			}
			else
			{

				$('#contact_info .row').show();
			}

		}
	}

	setFormState();

	// --------------------------------------------------------------------
	// validate
	/*
	  $("#detailsForm").validate({
	  errorLabelContainer: $("#detailsForm div.error")
	  });

	  var container = $('div.container');
	  // validate the form when it is submitted
	  var validator = $("#_detailsForm").validate({
	  errorContainer: container,
	  errorLabelContainer: $("ol", container),
	  wrapper: 'li'
	  });
	*/
	// --------------------------------------------------------------------
	// sektion mit erstkontakt wiedervorlage
	//console.log($('#erstkontakt').html().length);

	// click auf memo span 

	$('#contactsMemo').html($('#inpContactsMemo').val());

  	$('#contactsMemo').click(function(){

		$(this).addClass('hide');
		$('#inpContactsMemo').removeClass('hide').focus();


	});

	// --------------------------------------------------------------------
	// tabindex auf formfelder setzen
	function setTabindex()
	{
		var dataValues = {};
		var i = 1;
		$('#detailsForm').find('input').each(
			function(unusedIndex, child) {

				$(this).attr("placeholder", 'n/a');

				var name = $(this).attr("name");
				dataValues[child.name] = child.value;

				$(this).attr("tabindex", i);
				++ i;
			});
	}
	setTabindex();
	// --------------------------------------------------------------------
	
	$('#followupDate').datetimepicker({
		lang:'de',
		timepicker:false,
		format:'d.m.Y',
		formatDate:'Y-m-d',
		scrollInput:false
	});

	var d = new Date();
	var sYear = d.getFullYear() - 25;
	d.setFullYear(sYear);

	var startDate = d.toLocaleDateString();

	$('#gebTag,#birthday').datetimepicker({
		lang:'de',
		timepicker:false,
		format:'d.m.Y',
		formatDate:'Y-m-d',
		scrollInput:false,
		startDate:startDate
	});



	$('#followupTime').datetimepicker({
		datepicker:false,
		format:'H:i',
		step:30
	});


	// --------------------------------------------------------------------
	// ende doc ready
} );
