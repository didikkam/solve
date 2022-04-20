<style>
    a.cke_dialog_tab{
        display:none !important;
    }
    .cke_dialog_contents{
        margin-top:0;
    }
</style>
{{-- https://github.com/ckeditor/ckeditor4-docs-sample --}}
<script src="https://ckeditor.com/assets/libs/ckeditor4/4.17.1/ckeditor.js"></script>
<script>
  var options = {
    filebrowserImageBrowseUrl: '/filemanager?type=Images',
    filebrowserImageUploadUrl: '/filemanager/upload?type=Images&_token=',
    filebrowserBrowseUrl: '/filemanager?type=Files',
    filebrowserUploadUrl: '/filemanager/upload?type=Files&_token=',
    height: 300,
    extraPlugins: 'sourcedialog',
    extraAllowedContent: 'iframe(*)',
    allowedContent: true,
    removePlugins: 'sourcearea',
    removeButtons: 'PasteFromWord'
  };

  CKEDITOR.on('dialogDefinition', function (e) {
    var dialogName = e.data.name;
    var dialog = e.data.definition.dialog;
    if (dialogName === 'image') {
      setTimeout(function () {
        var preview = $('.ImagePreviewBox a')[0]
        $('.ImagePreviewBox td').html(preview)
      }, 300)
    }
  });

  $('.ckeditor').each(function (index, e) {
    var height = $(this).attr('height')
    if (height > 0) {
      options.height = height
    }
    CKEDITOR.replace(e.id, options)
  })
</script>
