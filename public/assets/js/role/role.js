function checkAllByName(name) {
    if ($(`.${name}`).length == $(`.${name}:checked`).length) {
        $(`.${name}-parent`).find(".check-all").prop("checked", true);
    } else {
        $(`.${name}-parent`).find(".check-all").prop("checked", false);
    }
}

$(function () {
    function checkAll() {
        $(".check-all").change(function () {
            let name = $(this).attr("data-name");
            if ($(this).is(":checked")) {
                $(`.${name}`).prop("checked", true);
            } else {
                $(`.${name}`).prop("checked", false);
            }
        });
    }
    function checkSingle() {
        $(`.single-checkbox`).change(function () {
            let name = $(this).attr("data-name");
            checkAllByName(name);
        });
    }
    checkAll();
    checkSingle();
});
