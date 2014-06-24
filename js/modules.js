/* ============================================================
 * MODULE CI SESSION VARS
 * ============================================================ */
var  ci_session = (function (window, document, undefined) {

	var sessVar = {};


	// --------------------------------------------------------------------
	/**
	 * get ci session data
	 */
	var getSessionData;
	sessVar.getSessionData = function(reqDat) {
		var retVal;
		retVal = null;

		if (arguments.length === 0) {
			reqDat = "";
		}

		$.ajax({
			type: "POST",
			async: false,
			data: "reqData=" + reqDat,
			url: site_url + "cockpit/ajax_bridge/getSessionData",
			dataType: "json",
			success: function(data) {
				return retVal = data;
			},
			error: function() {
				return alert("Error occured");
			}
		});

		return retVal;
	};


	//--------------------------------------------------------------------
	/*
	 * set ci session data
	 */
	var setSessionData;
	sessVar.setSessionData = function(sessVar, value) {

		return $.ajax({
			type: "POST",
			async: false,
			data: {
				sessVar: sessVar,
				value: value
			},
			url: site_url + "cockpit/ajax_bridge/setSessionData",
			complete: function(jSon) {
				return true;
			}
		});

	};



	//--------------------------------------------------------------------
	/*
	 * unset ci session data
	 */
	var unsetSessionData;
	unsetSessionData = function(sessVar) {

		return $.ajax({
			type: "POST",
			async: false,
			data: "sessVar=" + sessVar,
			url: site_url + "cockpit/ajax_bridge/unsetSessionData",
			complete: function(jSon) {
				return true;
			}
		});

	};



    return sessVar;


})(window, document);

/* ============================================================
 * MODULE EDIT LINKS IN GRIDS
 * ============================================================ */
var  crudLinks = (function (window, document, undefined) {

	var retVal = {};

	retVal.editBtn = function (domClass, target )
	{

		$(domClass).each(function() {

			var datasetID = $(this).html();
			var col = $(this).parent().children().index($(this));
			var row = $(this).parent().parent().children().index($(this).parent());
			var destLoc = target + datasetID; 


			$(this).closest('tr').click(function(){
				window.location=destLoc;
			});
			$(this).html('<a href="' + destLoc + '" class="gridEdit"><span title="Bearbeiten" class="fa fa-edit"></span></a>');
		});
	}


	retVal.editDelBtn = function (domClass, targetEdit, targetDelete )
	{


		$(domClass).each(function() {

			var datasetID = $(this).html();
			var col = $(this).parent().children().index($(this));
			var row = $(this).parent().parent().children().index($(this).parent());
			var destLocEdit = targetEdit + datasetID; 
			var destLocDelete = targetDelete + datasetID; 


			$(this).closest('tr').click(function(){
				window.location=destLocEdit;
			});
			$(this).html('<a href="' + destLocEdit + '" class="gridEdit right"><span title="Bearbeiten" class="fa fa-edit"></span></a><a href="' + destLocDelete + '" class="gridDelete right hide-for-touch"><span title="L&ouml;schen" class="fa fa-trash-o"></span></a>');
		});
	}

	return retVal;

})(window, document);



/* ============================================================
 * MODULE replacements
 * replacement controlls, datepicker timpicker ... 
 * ============================================================ */
var  replacements = (function (window, document, undefined) {

	var retVal = {};

	retVal.datePick = function (domSelector,htmlOnly)
	{
		$(domSelector).each(function() {

			var format = 'yyyy-mm-dd';
			var selector_name = $(this).attr('name');
			var id = $(this).attr("id");
			var value = $(this).val();
			var start;


			if(value == '0000-00-00')
			{
				value = '';
			}


			escName = name.replace(/(\[|\])/g, '\$1')

			var replacementHTML = '<div class="row date collapse"><div class="large-8 columns"><input style="width:100%" id="' + id + '" name="' + selector_name + '" class="input"  type="text" value="' + value + '" readonly></div><div class="small-1 columns left"><span style="width:2em" class="postfix small-1 columns end left" id="' + id + 'Picker""  data-date-format="' + format +  '" data-date="' + value +  '"><i style="font-size:1.7em;" class="general foundicon-calendar">&nbsp;</i></span></div></div>';

			$(this).replaceWith(replacementHTML);

			$('#' + id + 'Picker').fdatepicker()	
				.on('changeDate', function (ev) {

					if (ev.date.valueOf()) {

						$('#' + id ).val($('#' + id + 'Picker').data('date'));
						$('#alert').show().find('strong').text('The start date can not be greater then the end date');
					} else {

					}
					$('#' + id +  'Picker').fdatepicker('hide');
				});


			$('#' + id).focus(function(){
				$('#' + id + 'Picker').trigger('click');
			});	

		});

	}


	// --------------------------------------------------------------------
	// repalce input with time picker 
	retVal.timePick = function (domSelector)
	{
		$(domSelector).each(function() {
			var targetID = $(this).attr('id');
			var selector_name = $(this).attr('name');
			var value = $(this).val();


			replacementHTML = '<div class="row collapse"><div class="small-10 columns left"><input type="text" name="' + selector_name + '" value="' + value + '" id="'  + targetID + '" class="required time ui-timepicker-input" autocomplete="off"></div><div class="small-2 columns left"><span data-time-target="'  + targetID + '"  style="width:2em" class="postfix small-1 columns end left tpick">&nbsp;<i style="font-size:1.3em;" class="general foundicon-clock">&nbsp;</i></span></div></div></div>';

			$(this).replaceWith(replacementHTML);

			$('.tpick').each(function(){

				var tpOptions = {
					'timeFormat': 'H:i',
					'scrollDefaultTime': '09:00',
				};

				var target = '#' + $(this).data('time-target');
				$(target).timepicker(tpOptions);


				$(this).on('click', function(){
					var target = '#' + $(this).data('time-target');
					$(target).timepicker('show');
				});
			});
		});
	}

	return retVal;

})(window, document);

// --------------------------------------------------------------------

$.fn.enterKey = function (fnc) {
    return this.each(function () {
        $(this).keypress(function (ev) {
            var keycode = (ev.keyCode ? ev.keyCode : ev.which);
            if (keycode == '13') {
                fnc.call(this, ev);
            }
        })
    })
		}

