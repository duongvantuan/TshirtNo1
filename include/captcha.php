<tr>
    <td colspan="2" align="center">
        <div class="messagecaptcha">Please arrange the boxes below according to the order of the alphabet<br/><br/></div>
        <div class="falsecaptcha">
            You sort of wrong. Please arrange the boxes in order of the alphabet.<br/><br/>
        </div>
        <div class="truecaptcha">
            Exactly!<br/><br/>
        </div>        
        <div class="captcha_wrap">
            <div class="captcha">
                Drag and drop the letters to move
            </div>
            <ul id="sortable">
                <li class="captchaItem">A</li>
                <li class="captchaItem">B</li>
                <li class="captchaItem">C</li>
                <li class="captchaItem">D</li>
                <li class="captchaItem">E</li>
                <li class="captchaItem">F</li>
            </ul>                                
        </div>
        <script type="text/javascript">
            (
                    function($){
        
                        $.fn.shuffle = function() {
                            return this.each(function(){
                                var items = $(this).children();
        
                                return (items.length)
                                    ? $(this).html($.shuffle(items,$(this)))
                                : this;
                            });
                        }
        
                        $.fn.validatecaptcha = function() {
                            var res = false;
                            this.each(function(){
                                var arr = $(this).children();
                                res =    ((arr[0].innerHTML=="A")&&
                                    (arr[1].innerHTML=="B")&&
                                    (arr[2].innerHTML=="C")&&
                                    (arr[3].innerHTML=="D")&&
                                    (arr[4].innerHTML=="E")&&
                                    (arr[5].innerHTML=="F"));
                            });
                            return res;
                        }
        
                        $.shuffle = function(arr,obj) {
                            for(
                            var j, x, i = arr.length; i;
                            j = parseInt(Math.random() * i),
                            x = arr[--i], arr[i] = arr[j], arr[j] = x
                        );
                            if(arr[0].innerHTML=="1") obj.html($.shuffle(arr,obj))
                            else return arr;
                        }
        
                    })(jQuery);
                    $(function() {                       
                        
                        $(".falsecaptcha").hide();
                        $(".truecaptcha").hide();                        
                        $("#sortable").sortable();
                        $("#sortable").disableSelection();
                        $('.captcha_wrap ul').shuffle();
                        $('#submit').attr('disabled', 'disabled');	// disable nút submit					
                        
                        $("#sortable").mousemove(function(){
                            if($('.captcha_wrap ul').validatecaptcha() == true){
                                $(".messagecaptcha").hide();
                                $(".truecaptcha").show();
                                $(".falsecaptcha").hide();
                                $("#submit").removeAttr('disabled');
                            }
                            else{                                
                                $(".messagecaptcha").hide();
                                $(".truecaptcha").hide()
                                $(".falsecaptcha").show();
                                $('#submit').attr('disabled', 'disabled');
                            }
                        });		
                    });
    </script>                            
    </td>
</tr>