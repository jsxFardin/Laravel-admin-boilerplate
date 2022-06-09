function autocomplete(selector, route, params = null) {
    $(selector).autocomplete({
        source: function (request, response) {
            $.ajax({
                url: route,
                dataType: "json",
                data: {
                    term: request.term,
                    ...params
                },
                success: function (data) {
                    response(data);
                },
            });
        },
        minLength: 1,
        select: function (event, ui) {
            if (event)
            $(this).val(ui.item.value);
            return false;
        },
        change: function (event, ui) {
            if (params) {
                $(selector).attr('value', ui.item ? ui.item.value : '')
            }
        }
    });
}
