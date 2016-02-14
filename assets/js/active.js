$(document).ready(function(){
	$('.datepicker').datepicker({
		showOn: "button",
		buttonImage: "https://jqueryui.com/resources/demos/datepicker/images/calendar.gif",
      	buttonImageOnly: true,
      	buttonText: "Select date",
		changeMonth: true,
      	changeYear: true,
      	monthNames: ['Tháng 1','Tháng 2','Tháng 3','Tháng 4','Tháng 5','Tháng 6','Tháng 7','Tháng 8','Tháng 9','Tháng 10','Tháng 11','Tháng 12',],
      	monthNamesShort: ['Tháng 1','Tháng 2','Tháng 3','Tháng 4','Tháng 5','Tháng 6','Tháng 7','Tháng 8','Tháng 9','Tháng 10','Tháng 11','Tháng 12',],
	});
	$('.datepicker').datepicker();
	// $('.datepicker').datepicker( "option", "dateFormat", 'dd/mm/yy');

	var col = $('.award').attr("col");

	$('.award').map(function(){
		var col = $(this).attr('col');
		if(col) {
			var style = {
				"-webkit-column-count": col,
				"-moz-column-count": col,
				"column-count": col,
				"-webkit-column-rule": "1px solid #ccc",
				"-moz-column-rule": "1px solid #ccc",
				"column-rule": "1px solid #ccc"
			};

			$(this).css(style);
		}
		
	});
});