/** admin config **/
/** admin config **/
    $.ajax({
     url: "json/rooms_config.json",
     dataType: "json",
     }).done(function(data) {
       $.each(data, function(i, value){
          $('#rooms').append($('<option>').text(value).attr('value', i));
         });

     }).fail(function() {
        console.log('There was an error in jsonform.');
        $("#msg").html("Fehler Daten!");
  });
    $.ajax({
     url: "json/config.json",
     dataType: "json",
     }).done(function(data) {
          $('#email_address').val(data.email_address);
          $('#user_name').val(data.user_name);
          var rooms_chosen = data.room;
          $('#closing_days').val(data.closing_days_arr.join(","));

     }).fail(function() {
        console.log('There was an error in jsonform.');
        $("#msg").html("Fehler Daten!");
  });



// datepicker
$('[data-toggle="datepickerStart"]').datepicker({
    offset: 0,
    // date: startDate,
    weekStart: 1,
    format: 'dd.mm.yyyy',
    // autoPick: true,
    language: 'de-DE',
    days: ["Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag"],
    daysShort: ["So", "Mo", "Di", "Mi", "Do", "Fr", "Sa"],
    daysMin: ["So", "Mo", "Di", "Mi", "Do", "Fr", "Sa"],
    months: ["Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember"],
    monthsShort: ["Jan.", "Feb.", "März", "April", "Mai", "Juni", "Juli", "Aug.", "Sept.", "Okt.", "Nov.", "Dez."],
    autoHide: true
});
$('[data-toggle="datepickerEnd"]').datepicker({
    offset: 0,
    // date: new Date(Date.now() + 12096e5),
    weekStart: 1,
    format: 'dd.mm.yyyy',
    // autoPick: true,
    language: 'de-DE',
    days: ["Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag"],
    daysShort: ["So", "Mo", "Di", "Mi", "Do", "Fr", "Sa"],
    daysMin: ["So", "Mo", "Di", "Mi", "Do", "Fr", "Sa"],
    months: ["Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember"],
    monthsShort: ["Jan.", "Feb.", "März", "April", "Mai", "Juni", "Juli", "Aug.", "Sept.", "Okt.", "Nov.", "Dez."],
    autoHide: true
});



// datepicker
$('[data-toggle="datepickerConfigThisYear"]').datepicker({
    offset: 0,
    weekStart: 1,
    format: 'dd.mm.yyyy',
    trigger: $('[data-toggle="datetriggerThisYear"]'),
    autoPick: false,
    language: 'de-DE',
    days: ["Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag"],
    daysShort: ["So", "Mo", "Di", "Mi", "Do", "Fr", "Sa"],
    daysMin: ["So", "Mo", "Di", "Mi", "Do", "Fr", "Sa"],
    months: ["Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember"],
    monthsShort: ["Jan.", "Feb.", "März", "April", "Mai", "Juni", "Juli", "Aug.", "Sept.", "Okt.", "Nov.", "Dez."],
    autoHide: true,
    pick: addDateCalendar
});
$('[data-toggle="datepickerConfigEveryYear"]').datepicker({
    offset: 0,
    weekStart: 1,
    format: 'dd.mm.',
    trigger: $('[data-toggle="datetriggerEveryYear"]'),
    autoPick: false,
    language: 'de-DE',
    days: ["Sonntag", "Montag", "Dienstag", "Mittwoch", "Donnerstag", "Freitag", "Samstag"],
    daysShort: ["So", "Mo", "Di", "Mi", "Do", "Fr", "Sa"],
    daysMin: ["So", "Mo", "Di", "Mi", "Do", "Fr", "Sa"],
    months: ["Januar", "Februar", "März", "April", "Mai", "Juni", "Juli", "August", "September", "Oktober", "November", "Dezember"],
    monthsShort: ["Jan.", "Feb.", "März", "April", "Mai", "Juni", "Juli", "Aug.", "Sept.", "Okt.", "Nov.", "Dez."],
    autoHide: true,
    pick: addDateCalendar
});

// closing_days
var output_this_year = $('#configDatesThisYear .add');
var hidden_this_year = $("input[name='closing_days_new");
var this_year_new;

//var input_this_year = $("input[name='closing_days").val();
var input_this_year = "04.11.2018,21.11.2018,29.11.2018,23.11.2018";
var string_this_year = input_this_year.replace(/"/g, '');
var dates_this_year = string_this_year.split(',');

function CALENDAR_DAYS_CLOSED_YEAR_init() {
	this_year_new = dates_this_year.slice();

	output_this_year.html(generatOutput(dates_this_year, 'js-thisYearDate'));
}
CALENDAR_DAYS_CLOSED_YEAR_init();


function generatOutput (_dates, _class) {
	var html = '', allDates;

	if (_class == 'js-thisYearDate') {
		allDates = merge_array(_dates, dates_this_year);
	} else {
		allDates = merge_array(_dates, dates_every_year);
	}
	var dates = sortDates(allDates);
	// console.log("dates sort", dates);

	for (var i = 0; i < dates.length; i++) {
		var inArray = 0;
		if (_dates.indexOf(dates[i]) != -1) {
			inArray += 1;
		}
		if (_class == 'js-thisYearDate') {
			if (dates_this_year.indexOf(dates[i]) != -1) {
				inArray += 2;
			}
		} else {
			if (dates_every_year.indexOf(dates[i]) != -1) {
				inArray += 2;
			}
		}

		var addClass = "";
		if (inArray == 1) {
			addClass = "configDate added delete";
		}
		if (inArray == 2) {
			addClass = "configDate deleted";
		}
		if (inArray == 3) {
			addClass = "configDate delete";
		}
		html += '<span class="' + _class + " " + addClass + '" data-value="' + dates[i] + '">' + dates[i] + ' <i class="fas fa-times removeDate"></i></span>';
	}
	return html;
}

// delete (triggert by class 'delete')
$('.configDates').on('click', '.configDate.delete', function() {
	var _this = $(this);
	if (_this.hasClass('js-thisYearDate')) {
		deleteDate(_this.attr('data-value'), this_year_new, output_this_year, 'js-thisYearDate');
	}
	if (_this.hasClass('js-everyYearDate')) {
		deleteDate(_this.attr('data-value'), every_year_new, output_every_year, 'js-everyYearDate');
	}
});

// re-add if deleted (triggert by class 'deleted')
$('.configDates').on('click', '.configDate.deleted', function() {
	var _this = $(this);
	if (_this.hasClass('js-thisYearDate')) {
		addDate(_this.attr('data-value'), this_year_new, output_this_year, 'js-thisYearDate', hidden_this_year);
	}
	if (_this.hasClass('js-everyYearDate')) {
		addDate(_this.attr('data-value'), every_year_new, output_every_year, 'js-everyYearDate', hidden_every_year);
	}
});

function deleteDate(_date, _array, _output, _class) {
	var index = _array.indexOf(_date);
	_array.splice(index, 1);
	_output.html(generatOutput(_array, _class));
	// save
	if (_class == 'js-thisYearDate') {
		hidden_this_year.val(_array.join());
	} else {
		hidden_every_year.val(_array.join());
	}
}
function addDate (_newDate, _dateArray, _output, _class, _hiddenField) {
	// console.log("addDate", _newDate, _dateArray, _output, _class, _hiddenField);
	_dateArray.push(_newDate);
	_output.html(generatOutput(_dateArray, _class));
	_hiddenField.val(_dateArray.join());
}

function addDateCalendar (e) {
	var elem = $(e.target);

	var thisYear;
	if (elem.parent().hasClass('js-thisYearDate')) {
		thisYear = true;
	} else {
		thisYear = false;
	}

	if (e.view == 'day') {
		var datum = getFormattedDate(e.date, thisYear);

		if (thisYear) {
			addDate(datum, this_year_new, output_this_year, 'js-thisYearDate', hidden_this_year);
			// this_year_new.push(datum);
			// output_this_year.html(generatOutput(this_year_new, 'js-thisYearDate'));
			// hidden_this_year.val(this_year_new.join());
		} else {
			addDate(datum, every_year_new, output_every_year, 'js-everyYearDate', hidden_every_year);
			// every_year_new.push(datum);
			// output_every_year.html(generatOutput(every_year_new, 'js-everyYearDate'));
			// hidden_every_year.val(every_year_new.join());
		}
	}	
}

function getFormattedDate(date, withYear) {
     var year = date.getFullYear();
     var month = (1 + date.getMonth()).toString();
     month = month.length > 1 ? month : '0' + month;
     var day = date.getDate().toString();
     day = day.length > 1 ? day : '0' + day;

     var returnString;
     if (withYear) {
     	returnString = day + "." + month + "." + year;
     } else {
     	returnString = day + "." + month + ".";
     }
     return returnString;
}

function sortDates (array) {
	array.sort(function (a, b) {
        a = a.toString().split('.');
        b = b.toString().split('.');
        return a[2] - b[2] || a[1] - b[1] || a[0] - b[0];
    });
    return array;
}

function merge_array(array1, array2) {
	// console.log(array1, array2);
    var result_array = [];
    var arr = array1.concat(array2);
    var len = arr.length;
    var assoc = {};

    while(len--) {
        var item = arr[len];

        if(!assoc[item]) 
        { 
            result_array.unshift(item);
            assoc[item] = true;
        }
    }

    return result_array;
}
