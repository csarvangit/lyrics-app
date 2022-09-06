$(document).ready(function() {
    /* $('.multiselect-opt').select2({
        //placeholder: "Type three letters",
        allowClear: true,
       // theme: "bootstrap",
        tags: true,
       // tokenSeparators: [',', ' ']
    }); */

    $('.multiselect-opt').each(function () {
        $(this).select2({
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
            closeOnSelect: false,
            allowClear: true,
        });
    });


    $(".add_lyrics_to").click(function () {
        var lyrics_source = $("#lyrics_source").val();
        $("#lyrics").val(lyrics_source);
    });

});