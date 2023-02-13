$(window).on('load', function() {
    $('.decode').each(function () {
        let text = $(this).text()
        $(this).text(CryptoJS.AES.decrypt(text, $('#encryption').val()).toString(CryptoJS.enc.Utf8));
    });
});