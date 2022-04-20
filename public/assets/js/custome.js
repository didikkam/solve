
 function readURL(input, image) {
    set_null_image(image + '');
    var FileUploadPath = input.value;
    var Extension = FileUploadPath.substring(
        FileUploadPath.lastIndexOf('.') + 1).toLowerCase();

    if (Extension == "png" || Extension == "jpeg" || Extension == "jpg") {

        if (input.files && input.files[0]) {
            var size = input.files[0].size;
            var name = input.files[0].name;
            if (size > 2000000) {
                $('#' + image + '_error').html('Ukuran Maksimum 2Mb');
                $('#' + image + '_error').show();
                $('#' + image).addClass("is-invalid");
                $('#' + image).val('');
            } else {
                $('#' + image + '-label').html(name);
                var reader = new FileReader();

                $('#' + image + '-display').html(`<img id="blah-` + image + `" src="" alt="Mengambil Foto ..." class="mt-2" style="max-height: 200px; max-width: 100%;" />`);
                reader.onload = function(e) {
                    $('#blah-' + image)
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
                $('#' + image).addClass("is-valid");
            }
        }
    } else {
        $('#' + image + '_error').html('Foto hanya boleh (PNG, JPG dan JPEG)');
        $('#' + image + '_error').show();
        $('#' + image).addClass("is-invalid");
        $('#' + image).val('');
    }
}

function set_null_image(image) {
    $('#' + image).removeClass("is-valid");
    $('#' + image).removeClass("is-invalid");
    $('#' + image + '-display').html("");
    $('#' + image + '_error').html("");
    $('#' + image + '-label').html("Pilih file");
}
