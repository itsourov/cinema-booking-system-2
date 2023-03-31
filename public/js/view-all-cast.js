var showingMoreCast = true
var showingMoreImage = true


$('#viewAllCasttButton').on('click', function (event) {
    showingMoreCast = !showingMoreCast;
    $(this).text(showingMoreCast ? "View all" : 'View less')
    if (showingMoreCast) {
        $('.singel-cast:gt(9)').hide(500)
    } else {
        $('.singel-cast:gt(9)').show(500)
    }
});

$('#viewAllImageButton').on('click', function (event) {
    showingMoreImage = !showingMoreImage;
    $(this).text(showingMoreImage ? "View all" : 'View less')
    if (showingMoreImage) {
        $('.singel-image:gt(9)').hide(500)
    } else {
        $('.singel-image:gt(9)').show(500)
    }
});


$(".tab-content:not(:first)").hide();
$(".tab-btn:first").addClass('bg-primary-400 dark:bg-primary-400 text-white')
$('.tab-btn').on('click', function (event) {
    $('.tab-content').hide()
    $('.tab-btn').removeClass('bg-primary-400 dark:bg-primary-400 text-white')
    $(this).addClass('bg-primary-400 dark:bg-primary-400 text-white')
    $('#' + $(this).attr('data-target')).show()
});

$('.trailers-video-btn').on('click', function (event) {

    $('.trailers-video-btn').removeClass('text-primary-500')
    $(this).addClass('text-primary-500')
    $("#trailerVideoPreview").attr('src', 'https://www.youtube.com/embed/' + $(this).attr('data-id'))

});



$('.faq-container button').on('click', function (event) {
    $(this).next().slideToggle(200, function () {
        $(this).parent().toggleClass('shadow', $(this).is(':visible'))
    })

});
