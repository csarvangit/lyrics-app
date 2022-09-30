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

    $('.show_confirm').click(function(event) {
        var form =  $(this).closest("form");
       // var name = $(this).data("name");
        event.preventDefault();
        swal({
            title: `Are you sure you want to delete this record?`,
            text: "If you delete this, it will be gone forever.",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {
          if (willDelete) {
            form.submit();
          }
        });
    });

});