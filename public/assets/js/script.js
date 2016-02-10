$(function() {
    $( ".add_author" ).bind( "click", function(e) {
        var id = $("#selectAuthor").val();
        var author = $("#selectAuthor option:selected").text();

        if ($('.author_list li input[value='+id+']').length) {
            return;
        }

        var $authorTemplate = $('li.author_templ');

        $('.author_list').append("<li><b>"+author+"</b> (<a href='javascript:void(0)' class='remove_author'>удалить</a>)<input type='hidden' name='book[authors][]' value='"+id+"'></li>");
        bindDeleteAuthor();
    });

    var bindDeleteAuthor = function() {
        $(".remove_author").unbind( "click" );
        $(".remove_author").bind( "click", function() {
            $(this).parent('li').remove();
        });
    };
    bindDeleteAuthor();
});

$(function() {
    $( "#datepicker" ).datepicker({
        format: 'dd.mm.yyyy'
    });
});