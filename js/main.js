function mergeTogether() {
    $('#overlay').css('visibility', 'visible').hide().fadeIn();

    var input = $('form').find('textarea');

    $.post('merge.php', input.serialize(), function (data) {
        $('#overlay').fadeOut();
        $('#message').animate({'bottom': 0}, 'slow');
    });
}

