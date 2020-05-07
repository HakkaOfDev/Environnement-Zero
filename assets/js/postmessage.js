function postMessage(){
    $('.chat .entry').keyup(function (e) {
        var messages = $('.chat .entry').val();
        var id = document.querySelector('.id_target').id;
        messages = $.trim(messages);

        if(messages !== "" && e.keyCode === 13 && e.shiftKey === false){
            $.post('postmessage.php', {messages:messages,id:id}).done(function () {
                $('.chat .entry').val('');
                $('.chat .entry').rows = 1;
                getMessages();
            });
        }
    });
}

postMessage();