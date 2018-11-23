function addAnother($className,$buttonClass) {
	$original = $('.'+$className+':last').clone(true);
		$('.'+$buttonClass).remove();
		$('<span>Delete</span>').append();

		function DuplicateForm () {
				var tbody;
				tbody = $original.clone(true).insertAfter($('.'+$className+':last')).find("input").val("");
				$.each($('input', tbody), function(i, item) {            
					$(item).attr('name', $(item).attr('name') );
				});
			}
		DuplicateForm();
};

$('.optionBox').on('click','.remove',function() {
	$(this).parent().remove();
});


function populateEndDate() {
	var date2 = $('#dateStart').datepicker('getDate');
	date2.setDate(date2.getDate() );
	$('#dateEnd').datepicker('setDate', date2);
	$("#dateEnd").datepicker("option", "minDate", date2);
  }
  $(document).ready(function() {
  
	$("#dateStart").datepicker({
	  dateFormat: "yy-mm-dd",
	  minDate: 'dateToday',
	  onSelect: function(date) {
		populateEndDate();
	  }
	}).datepicker("setDate", new Date());
	$('#dateEnd').datepicker({
	  dateFormat: "yy-mm-dd",
	  minDate: 0,
	  onClose: function() {
		var dt1 = $('#dateStart').datepicker('getDate');
		var dt2 = $('#dateEnd').datepicker('getDate');
		if (dt2 <= dt1) {
		  var minDate = $('#dateEnd').datepicker('option', 'minDate');
		  $('#dateEnd').datepicker('setDate', minDate);
		}
	  }
	}).datepicker("setDate", new Date());
  });


// 	$('#loadmore').click(function() {
//     var loaded = $(this).attr('num_loaded');
//     $.ajax({
//         url:'load_categories.php',
//         type:'get',
//         data:{'from':loaded,'to':loaded+10},
//         success: function (res) {
//             var categories = $.parseJSON(res);
//             categories.each(function() {
//                 $('#categories').append('<ul>'+this+'</ul>');
//             });
//             $('#loadmore').attr('num_loaded',loaded+10);
//         }
//     });
// });