function ajaxDelete(url, modalId = null, tableId = null) {
    $.ajax({
        type: "DELETE",
        url: url,
        success: function (res) {
            toastr.success(res.message);
            if (modalId) $(`#${modalId}`).modal("hide");
            if (tableId) $(`#${tableId}`).DataTable().ajax.reload();
        },
        error: function (res) {
            toastr.error(res.message);
        },
    });
}
