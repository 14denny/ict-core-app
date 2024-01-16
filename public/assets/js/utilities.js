function indicatorOn(selector){
    $(selector).attr('disabled', true)
    $(selector).attr('data-kt-indicator', 'on')
}
function indicatorOff(selector){
    $(selector).attr('disabled', false)
    $(selector).removeAttr('data-kt-indicator')
}