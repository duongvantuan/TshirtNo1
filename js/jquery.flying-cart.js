(function () {   
    var products = [];
    
    window.addCart = function (productId) {
        $.ajax({
            type: "GET",
            url: "index.php?page=cart&p_id=" + productId,
            success: function(data){            
                $('#basketTitleWrap')
                    .empty()
                    .append(data);

                products[productId] = false;
            }
        });
    };
    
    $(document).ready(function(){
        $(".buy-btn .addToCart").click(function(evt) {
            evt.preventDefault();

            var productIDValSplitter 	= (this.id).split("_");
            var productIDVal 			= productIDValSplitter[1];

            // Prevent from spam clicking
            if (products[productIDVal]) {
                alert('Sản phẩm đang được thêm vào giỏ hàng!!!');
                return false;
            }
            products[productIDVal] = true;

            var productX 		= $("#productImageWrapID_" + productIDVal).offset().left;
            var productY 		= $("#productImageWrapID_" + productIDVal).offset().top;

            if( $("#productID_" + productIDVal).length > 0){
                    var basketX 		= $("#productID_" + productIDVal).offset().left;
                    var basketY 		= $("#productID_" + productIDVal).offset().top;			
            } else {
                    var basketX 		= $("#basketTitleWrap").offset().left;
                    var basketY 		= $("#basketTitleWrap").offset().top;
            }

            var gotoX 			= basketX - productX;
            var gotoY 			= basketY - productY;

            var newImageWidth 	= $("#productImageWrapID_" + productIDVal).width() / 3;
            var newImageHeight	= $("#productImageWrapID_" + productIDVal).height() / 3;

            $("#productImageWrapID_" + productIDVal + " img")
                    .clone()
                    .prependTo("#productImageWrapID_" + productIDVal)
                    .css({
                        'position' : 'absolute',
                        'z-index' : 99999999
                    })
                    .animate({opacity: 0.4}, 100 )
                    .animate({opacity: 0.1, marginLeft: gotoX, marginTop: gotoY, width: newImageWidth, height: newImageHeight}, 1500, function() {
                            var $self = $(this);

                            $self.fadeOut('fast', function () {
                            });

                            addCart(productIDVal);
            });
        });
    });
    
})();