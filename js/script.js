$(document).ready(function() {
    'use strict';

    $('#ingredient_cocktail-form').submit(function () {
        alert("coucou");
        $.ajax({
            'url': $(this).attr('action'),
            'method': 'list_ingredient.php',
            'data': $(this).serialize()
        }).done(function (data) {
            alert(data.message);

        }).fail(function () {
            $('body').html('Une erreur est survenue...');
        });
        return false;
    });

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
        let body;
        $.ajax({
            'url': $(this).attr('action'),
            'method': $(this).attr('method'),
            'data': $(this).serialize()
        }).done(function (data) {
            if (data.success === true)
            {
                alert(data.message);
                let e = $('<form>');
                for(let row in data.message)
                {
                    let f = $('<input>');
                    e.append(f);
                    f.attr('name', 'ingredient_cocktail-button')
                        .attr('type', 'submit')
                        .attr('value', data.message[row]);
                }
                $('body').append('<br/>').append(e);
                e.attr('id', 'ingredient_cocktail-form')
                    .attr('action', 'list_ingredient.php')
                    .attr('method', 'post');
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