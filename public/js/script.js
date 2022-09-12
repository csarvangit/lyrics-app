$(document).ready(function() { 

    /* Select Option Multi Select - select2 */    
    $('.multiselect-opt').each(function () {
        $(this).select2({
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
            closeOnSelect: false,
            allowClear: true,
        });
    });

    /* Copy Lyrics to Textbox */
    $(".add_lyrics_to").click(function () {
        var lyrics_source = $("#lyrics_source").val();
        $("#lyrics").val(lyrics_source);
    });

    /* Image Upload - Thumnail Preview */
    $('#image_path').change(function(){
           
        let reader = new FileReader();    
        reader.onload = (e) => {     
          $('.thumb-preview').attr('src', e.target.result); 
        }    
        reader.readAsDataURL(this.files[0]);       
    });

});