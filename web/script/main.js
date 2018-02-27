$(document).ready(function() {
    $(window).keydown(function (event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });
    $('#get-genre').on('click', 'button', function() {
        $('.form-inline').removeClass('hidden');
        $('#get-genre').addClass('hidden');
        $('#get-actor').addClass('hidden');
    }) 
    $('#get-actor').on('click', 'button', function() {
        $('.form-inline').removeClass('hidden');
        $('#get-director').addClass('hidden');
        $('#get-actor').addClass('hidden');
    }) 
    $('#get-director').on('click', 'button', function() {
        $('.form-inline').removeClass('hidden');
        $('#get-genre').addClass('hidden');
        $('#get-director').addClass('hidden');
    }) 



    $('#search-movies').on('click', function(e) {
        var query = $('#query-search').val();
        var genres = getGenreData(query.toLowerCase());
        $('#genre-input').val(genres);
        $.ajax({
            url: window.ajax_person_link,
            type: 'post',
            data: { 'query': query },
            success: function (actors) {
                $('#actor-input').val(actors);
                $('#frm-search-movies').submit();
            }
        });
    })
});

function handleChangeInput(e) {
    var _this = $(e);
    var container = _this.parent();
    if (_this.val()) {
        container.children('button').removeClass('disable');
    } else {
        container.children('button').addClass('disable');
    }
}

function getGenreData(query) {
    var result = [];
    for (var i = 0; i < window.genre_datas.length; i++) {
        if (query.indexOf((window.genre_datas[i]).toLowerCase()) !== -1) {
            result.push(window.genre_datas[i]);
        }
    }
    return result.join(';')
}