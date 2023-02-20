$(window).on('load', function() {
    $('.decode').each(function () {
        let text = $(this).html();
        let decrytedText = CryptoJS.AES.decrypt(text, $('#encryption').val()).toString(CryptoJS.enc.Utf8);
        if (decrytedText !== "") {
            $(this).html(decrytedText);
        } else {
            $(this).remove();
        }
    });
});