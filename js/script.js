$(document).ready(function() {
    'use strict';

    $('#connexion-form').submit(function () {
        $.ajax({
            'url': $(this).attr('action'),
            'method': $(this).attr('method'),
            'data': $(this).serialize()
        }).done(function (data) {
            alert(data.message);
            if (data.success === true) {
                window.location.reload(true);
            }
        }).fail(function () {
            $('body').html('Une erreur est survenue...');
        });
        return false;
    });

    $('#deconnexion-form').submit(function () {
        $.ajax({
            'url': $(this).attr('action'),
            'method': $(this).attr('method'),
            'data': $(this).serialize()
        }).done(function (data) {
            if (data.success === true) {
                window.location.reload(true);
            }
        }).fail(function () {
            $('body').html('Une erreur est survenue...');
        });
        return false;
    });

    $('#inscription-form').submit(function () {
        let message;
        $.ajax({
            'url': $(this).attr('action'),
            'method': $(this).attr('method'),
            'data': $(this).serialize()
        }).done(function (data) {
            alert(data.message);
            if (data.success === true) {

                window.location.reload(true);
            }
        }).fail(function () {
            $('body').html('Une erreur est survenue...');
        });
        return false;
    });

    $.ajax({
        'url': 'isConnect.php',
        'method': 'get'
    }).done(function (data) {
        if (data) {
            $('#deconnexion-form').show();
        } else {
            $('#inscription-button').show();
            $('#connexion-button').show();
        }
    })
        .fail();

    $('#inscription-button').click(function () {
        $('#inscription-form').slideDown();
        $('#connexion-form').slideUp();
        $('#connexion-button').show();
        $('#inscription-button').hide();
    });

    $('#connexion-button').click(function () {
        $('#connexion-form').slideDown();
        $('#inscription-form').slideUp();
        $('#inscription-button').show();
        $('#connexion-button').hide();
    });
});