var main = function(){
    $('#submit-comment').click(function(){
        var post = $('.status-box').val();
        $('.counter').text("140");
        $('#submit-comment').addClass('disabled');
        });
        
        
    $('.status-box').keyup(function(){
        var postLength = $(this).val().length;
        var charactersLeft = 140-postLength;
        $('.counter').text(charactersLeft);
        
        if(charactersLeft < 0){
            $('#submit-comment').addClass('disabled');
        }
        else if(charactersLeft == 140){
            $('#submit-comment').addClass('disabled');
            }
            else{
                $('#submit-comment').removeClass('disabled');
            }
        });
        $('#submit-comment').addClass('disabled');
};

$(document).ready(main);