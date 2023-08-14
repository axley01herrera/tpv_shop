function checkRequiredValues(className) {

    let response = 0;
    let value = "";
    let inputID = "";

    $("." + className).each(function () {

        value = $(this).val();

        if (value === "") {
            let selectContainer = $(this).next('.select2-container');

            if (selectContainer.length != 0) // CASE THE INPUT IS A SELECT 2
            {
                selectContainer.css('border', '1px solid #f34e4e');
                selectContainer.css('border-radius', '.25rem');
            } else
                $(this).addClass("is-invalid");

            inputID = $(this).attr("id");
            $('#msg-' + inputID).html("Campo Requerido");
            response = 1;
        }
    });

    return response;
}

$(document).ready(function () {
    $('.focus').on('change input', function () {
        $(this).removeClass('is-invalid');
        let inputID = $(this).attr("id");
        $('#msg-' + inputID).html("");
    });
    $('.number').on('input', function () {
        jQuery(this).val(jQuery(this).val().replace(/[^0-9]/g, ''));
    });
});



