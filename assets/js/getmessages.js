function getMessages()
{
    var id = document.querySelector('.id_target').id;
    $.post('getmessages.php', {id:id}).done(function(data) {
        $('#messages').html(data);
    });
}

setInterval(getMessages, 2000);
getMessages();
