import '../css/categorie.css';

$(function(){
    
    $(".like").click(function(){
        var id_type = $(this).attr('id').slice(0, -4);
        var id = id_type.slice(0, -1);
        var type = id_type.substr(1, 1);
        $.ajax({
            type: 'GET',
            url: '/ajax/likeUpdate?id=' + id + '&type=' + type + '&rate=like',
            dataType: 'json',
            success: function (data) {
                $("#"+ id + type + "like > span").text(data);
            },
            error: function () {
                console.log('Probleme sur la requette ajax');
            }
        });
    })

    $(".unlike").click(function(){
        var id_type = $(this).attr('id').slice(0, -6);
        var id = id_type.slice(0, -1);
        var type = id_type.substr(1, 1);
        $.ajax({
            type: 'GET',
            url: '/ajax/likeUpdate?id=' + id + '&type=' + type + '&rate=unlike',
            dataType: 'json',
            success: function (data) {
                $("#"+ id + type + "unlike > span").text(data);
            },
            error: function () {
                console.log('Probleme sur la requette ajax');
            }
        });
    })
})