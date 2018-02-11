function handleChangeInput(e) {
    var _this = $(e);
    var container = _this.parent();
    if (_this.val()) {
        container.children('button').removeClass('disable');
    } else {
        container.children('button').addClass('disable');
    }
}

$(document).ready(function() {
    $(window).keydown(function (event) {
        if (event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });
    $('#get-genre').on('click', 'button', function() {
        if ($('#get-genre input').val()) {
            $('.form-inline').removeClass('hidden');
            $('#get-genre').addClass('hidden');
        }
    }) 
    $('#get-actor').on('click', 'button', function() {
        if ($('#get-actor input').val()) {
            $('.form-inline').removeClass('hidden');
            $('#get-actor').addClass('hidden');
        }
    }) 
});