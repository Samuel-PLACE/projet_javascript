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

    $('#liste_cocktail-form').submit(function() {
        let message;
        $.ajax({
            'url': $(this).attr('action'),
            'method': $(this).attr('method'),
            'data': $(this).serialize()
        }).done(function (data) {
            if (data.success === true)
            {
                message = data.message;
                alert(data.message);
                let e = $('#ingredient_cocktail-form');
                for(let row in data.message) {
                    let f = $('<input>').css("margin", "5px").css("padding", "5px", "2px")
                        .attr('name', 'ingredient_cocktail-button')
                        .attr('type', 'submit')
                        .attr('value', data.message[row])
                        .click(function() {
                            $.ajax({
                                'url': $(e).attr('action'),
                                'method': 'GET',
                                'data': 'ingredient_cocktail=' + data.message[row]
                            }).done(function (data) {
                                alert(data.message);
                            }).fail(function () {
                                $('body').html('Une erreur est survenue...');
                            });
                            return false;
                        });
                    e.append(f).append('<br/>');

                }
                $('body').append('<br/>').append(e);
                e.show();
                $('#liste_cocktail-form').hide();
            }
            else
            {
                alert(data.message);
            }
        }).fail(function () {
            $('body').html('Une erreur est survenue...');
        });
        return false;
    });

    /*$('#ingredient_cocktail-form').submit(function () {
        $.ajax({
            'url': $(this).attr('action'),
            'method': $(this).attr('method'),
            'data': $(this).serialize()
        }).done(function (data) {
            alert(data.message);
        }).fail(function () {
            $('body').html('Une erreur est survenue...');
        });
        return false;
    });*/

    $.ajax({
        'url': 'isConnect.php',
        'method': 'get'
    }).done(function (data) {
        if (data) {
            $('#deconnexion-form').show();
            $('#liste_cocktail-form').show();
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