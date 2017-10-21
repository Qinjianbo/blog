import {markdown} from 'markdown';

$("#content").bind("input propertychange", function () {
    $("#parsing_content").html(markdown.toHTML($(this).val()));
});
