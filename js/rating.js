$(document).ready(function()
{  
    $('#message-rating').hide();
    
	// Mảng các màu
	var colours = ['BD2C33', 'E49420', 'ECDB00', '3BAD54', '1B7DB9'];

	// Tạo màu
	var colourizeRatings = function(nrOfRatings) {
		$('#rating li a').each(function() {
			if($(this).parent().index() <= nrOfRatings) {
				$(this).stop().animate({ backgroundColor : '#' + colours[nrOfRatings] } , 500);
			}
		});
	};
	
	// Hover -> đổi màu
	$('#rating li a').hover(function() {			
		// gọi hàm colourizeRatings với biến vào là index của <li>
       colourizeRatings($(this).parent().index());
	}, function() {		
		// Restore lại màu ban đầu
		$('#rating li a').stop().animate({ backgroundColor : '#333' } , 500);
	});
	
	// Sự kiện click rating
	$('#rating li a').click(function() {
	   
        // chỉ số rate (lấy theo index của <li>)
		var rate = $(this).parent().index() + 1;                
        // mã sp
        var p_id = $('#rating').attr('class');
        
        // ajax jquery
        $.ajax({
            type: 'POST',
            url: 'include/rating.php',
            data: 'rate=' + rate + '&p_id=' + p_id,
            success: function(data){
                $('#message-rating').fadeIn(400);
                
                $('#cur-rate').html('');
                $('#cur-rate').append(data);
                $('#rating').css({visibility: "hidden"});                
            }
        });
        
	});
});
function doSearch(action, keyword, category, PriceFrom, PriceTo) {
    var url = action;
    url += 'keyword=' + keyword;
    if (category != '') {
        url += '&category=' + category;
    }
    if (PriceFrom != '') {
        url += '&PriceFrom=' + PriceFrom;
    }
    if (PriceTo != '') {
        url += '&PriceTo=' + PriceTo;
    }
    window.location = url;
}