function indicatorOn(selector){
    $(selector).attr('disabled', true)
    $(selector).attr('data-kt-indicator', 'on')
}
function indicatorOff(selector){
    $(selector).attr('disabled', false)
    $(selector).removeAttr('data-kt-indicator')
}
function ajax(type, url, data, onSuccess, beforeSend = null, onFailure = null) {
    $.ajax({
        url: url,
        dataType: 'json',
        type: type,
        data: data,
        beforeSend: beforeSend == null ? showSwalLoader() : beforeSend(),
        success: (res) => {
            //refresh csrf
            csrf_token = res.csrf_token;
            $("input[name=_token]").val(csrf_token)

            onSuccess(res)
        }
    }).fail(() => {
        if (onFailure == null) {
            swalFailed()
        } else {
            onFailure()
        }
    })
}
function ajaxNoProcessData(type, url, data, onSuccess, beforeSend = null, onFailure = null) {
    $.ajax({
        url: url,
        dataType: 'json',
        type: type,
        data: data,
        processData: false, // Tell jQuery not to process the data
        contentType: false, // Tell jQuery not to set contentType
        beforeSend: beforeSend == null ? showSwalLoader() : beforeSend(),
        success: (res) => {
            //refresh csrf
            csrf_token = res.csrf_token;
            $("input[name=_token]").val(csrf_token)

            onSuccess(res)
        }
    }).fail(() => {
        if (onFailure == null) {
            swalFailed()
        } else {
            onFailure()
        }
    })
}