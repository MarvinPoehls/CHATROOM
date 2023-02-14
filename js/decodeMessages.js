$(window).on('load', function() {
    $('.decode').each(function () {
        let text = $(this).html()
        $(this).html(CryptoJS.AES.decrypt(text, $('#encryption').val()).toString(CryptoJS.enc.Utf8));
    });
});