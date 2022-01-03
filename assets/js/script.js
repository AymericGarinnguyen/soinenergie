$(function () {

    // script pour lire 1 video youtube
    $('.lire').click(function () {
        let video_link = $('.lire').val();
        $('#lightbox .video').append('<iframe src="" width="889" height="500" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');
        $('#lightbox .video iframe').attr('src', video_link + '?autoplay=1');
        $('#lightbox').show();
        $('#lightbox .video').show();
        $('body').css({
            'overflow': 'hidden'
        });
    });

    // on #lightbox click, this one and iframe disappear
    $('#lightbox').click(function () {
        $(this).hide();
        $('#lightbox .video iframe').remove();
        $('body').css({
            'overflow': 'unset'
        });
    });

    // Position des images selon leur height
    $('.imagePosition').each(function () {
        var figureCss = (0 - $(this).height()) * 0.85;
        $(this).css('margin-top', figureCss);
        console.log(figureCss);
    });



});
