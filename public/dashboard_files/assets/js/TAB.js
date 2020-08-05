$(document).ready(function () {

    $('.tab ul li').click(function () {
        var id = $(this).attr('id');
        $(this).siblings().removeClass('active');
        $(this).addClass('active');
        $('.tab div').hide();
        $('#' + id + '-content').fadeIn(500).css({
            'display': 'flex',
            'flexWrap': 'warp'
        });

    });
});
