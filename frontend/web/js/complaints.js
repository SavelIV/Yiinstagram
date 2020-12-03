$(document).ready(function () {
    $('a.button-complain').click(function () { 
        var button = $(this);
        var preloader = $(this).find('i.icon-preloader');
        var params = {
            'id': $(this).attr('data-id')
        };
        preloader.show();
        $.post('/post/default/complain', params, function(data) {
            preloader.hide();
            $("#reported-success").show();
            $("#unreported-success").hide();
            button.hide();
            button.siblings('.text-danger').show().html(data.text);
            button.siblings('.button-undo').show();
        });
        return false;
    });

    $('a.button-undo').click(function () {
        var button = $(this);
        var preloader = $(this).find('i.icon-preloader');
        var params = {
            'id': $(this).attr('data-id')
        };
        preloader.show();
        $.post('/post/default/uncomplain', params, function(data) {
            preloader.hide();
            $("#unreported-success").show();
            $("#reported-success").hide();
            button.hide();
            button.siblings('.text-danger').html(data.text);
            button.siblings('.button-complain').show();
        });
        return false;
    });
});