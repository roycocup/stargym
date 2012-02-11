var payment_div = $('#payments_sub1');
var wages_div = $('#wages_sub1');

wages_div.hide();
payment_div.hide();

$('#mm_wages').hover(function(){
	payment_div.hide();
	wages_div.show();
});

$('#mm_payments').hover(function(){
	wages_div.hide();
	payment_div.show();
});

