$(document).ready(function() {
    'use strict';
    //fu
    // fonction de connexion au site de cocktail
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

    //fonction de deconnexion au site de cocktail
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

    //fonction d'inscription au site de cocktail
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

    //fonction affichant la liste des différents cocktails, qui en cliquant dessus affiche les ingrédients necessaire pour réaliser le cocktail
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
                                if(data.success === true)
                                {
                                    window.location.reload(true);
                                }
                            }).fail(function () {
                                $('body').html('Une erreur est survenue...');
                            });
                            return false;
                        });
                    e.append(f).append('<br/>');

                }
                $('body').append('<br/>').append(e);
                e.slideDown();
                $('#add_ingredient-form').slideUp();
                $('#add_unite-form').slideUp();
                $('#add_cocktail_form').slideUp();
                $('#add_ingredient-button').show();
                $('#liste_cocktail-form').hide();
                $('#form_to_add_cocktail').show();
                $('#add_unite-button').show()
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

    //fonction d'ajout d'ingrédient dans la base de données
    $('#add_ingredient-form').submit(function () {
        $.ajax({
            'url': $(this).attr('action'),
            'method': $(this).attr('method'),
            'data': $(this).serialize()
        }).done(function (data) {
            alert(data.message);
            if(data.success === true)
            {
                window.location.reload(true);
            }
        }).fail(function () {
            $('body').html('Une erreur est survenue...');
        });
        return false;
    });

    //fonction d'ajout d'unité dans la base de données
    $('#add_unite-form').submit(function () {
        $.ajax({
            'url': $(this).attr('action'),
            'method': $(this).attr('method'),
            'data': $(this).serialize()
        }).done(function (data) {
            alert(data.message);
            if(data.success === true)
            {
                window.location.reload(true);
            }
        }).fail(function () {
            $('body').html('Une erreur est survenue...');
        });
        return false;
    });

    //fonction qui va cherhcer les différents ingrédients et unités à disposition pour créer son cocktails, qui va être stockés dans la base de données
    $('#form_to_add_cocktail').submit(function () {
        let message_erreur = false;
       $.ajax({
           'url': $(this).attr('action'),
           'method': $(this).attr('method'),
           'data': $(this).serialize()
       }).done(function (data) {
           if (data.success === true)
           {
               let e = $('#add_cocktail_form');
               let label = $('<label for="nom_cocktail">Nom cocktail</label>');
               let f = $('<input>').attr('name', 'nom_cocktail')
                   .attr('type', 'text')
                   .attr('id', 'nom_cocktail');
               e.append(label).append(f);
               let ul = $('<ul>');
               for(let ingredient in data.message)
               {
                   let li = $('<li>');
                   li.append('<input type="checkbox" name="ingredient[]" value="'+ data.message[ingredient] +'"/>'+ data.message[ingredient] + '<input type="text" value="1" name="nombre'+data.message[ingredient]+'" />');
                   let select = $('<select>').attr('name', 'unite_'+data.message[ingredient]);
                   $.ajax({
                      'url':'unite_to_add_cocktail.php'
                   }).done(function (data) {
                       if(data.success === true)
                       {
                           for(let unite in data.message)
                           {
                               select.append('<option value="'+data.message[unite]+'">'+data.message[unite]+'</option>');
                           }
                       }
                   }).fail(function () {
                       $('body').html('Une erreur est survenue...');
                   });
                   li.append(select);
                   ul.append(li);

               }
               e.append(ul);
               let g =  $('<input>')
                   .attr('name', 'add_cocktail-button')
                   .attr('type', 'submit')
                   .click(function(){
                       $.ajax({
                           'url': $(e).attr('action'),
                           'method': $(e).attr('method'),
                           'data': $(e).serialize()
                       }).done(function (data) {
                           alert(data.message);
                           if(data.success === true)
                           {
                               window.location.reload(true);
                           }
                       }).fail(function () {
                           $('body').html('Une erreur est survenue...');
                       });
                       return false;
                   });
               e.append(g);
               $('body').append('<br/>').append(e);
               e.slideDown();
               $('#ingredient_cocktail-form').slideUp();
               $('#add_ingredient-form').slideUp();
               $('#add_unite-form').slideUp();
               $('#form_to_add_cocktail').hide();
               $('#liste_cocktail-form').show();
               $('#add_ingredient-button').show();
               $('#add_unite-button').show();
           }
           else
               alert(data.message);
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
            $('#add_ingredient-button').show();
            $('#add_unite-button').show();
            $('#form_to_add_cocktail').show();
        } else {
            $('#inscription-button').show();
            $('#connexion-button').show();
        }
    })
        .fail();

    $('#add_ingredient-button').click(function() {
        $('#ingredient_cocktail-form').slideUp();
        $('#add_ingredient-form').slideDown();
        $('#add_unite-form').slideUp();
        $('#add_cocktail_form').slideUp();
        $('#liste_cocktail-form').show();
        $('#add_ingredient-button').hide();
        $('#add_unite-button').show();
        $('#form_to_add_cocktail').show();
    });

    $('#add_unite-button').click(function() {
        $('#ingredient_cocktail-form').slideUp();
        $('#add_cocktail_form').slideUp();
        $('#add_ingredient-form').slideUp();
        $('#add_unite-form').slideDown();
        $('#liste_cocktail-form').show();
        $('#add_ingredient-button').show();
        $('#form_to_add_cocktail').show();
        $('#add_unite-button').hide();
    });

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