jQuery(document).ready(function () {
    price = $(this.#price).val();
    $("#seat").on('change keyup', function (value) {
        $(this.#price).val(value);
        // document.getElementById("price").value = val * price;
    });
});


// jQuery(function ($) {

//     // price = $(this.#price).val();
//     $('#price').text($('#seacts').val());

//     $('#seats').on('input', function () {
//         $('#price').text($('#seats').val());
//     });
// });
