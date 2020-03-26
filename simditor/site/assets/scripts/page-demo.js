(function() {
  $(function() {
    var $preview, editor, mobileToolbar, toolbar;
    Simditor.locale = 'en-US';
    toolbar = ['title', 'bold', 'italic', 'underline', 'strikethrough', 'fontScale', 'color', '|', 'ol', 'ul', 'blockquote', 'code', 'table', '|', 'link', 'hr', '|', 'indent', 'outdent', 'alignment'];
    mobileToolbar = ["bold", "underline", "strikethrough", "color", "ul", "ol"];
    if (mobilecheck()) {
      toolbar = mobileToolbar;
    }
    editor = new Simditor({
      textarea: $('#txt-content'),
      placeholder: '',
      toolbar: toolbar,
      pasteImage: true,
      defaultImage: '/simditor/site/assets/images/image.png',
      upload: location.search === '?upload' ? {
        url: ''
      } : false
    });
      editor = new Simditor({
          textarea: $('#txt-content1'),
          placeholder: '',
          toolbar: toolbar,
          pasteImage: true,
          defaultImage: '/simditor/site/assets/images/image.png',
          upload: location.search === '?upload' ? {
              url: ''
          } : false
      });
      editor = new Simditor({
          textarea: $('#txt-content2'),
          placeholder: '',
          toolbar: toolbar,
          pasteImage: true,
          defaultImage: '/simditor/site/assets/images/image.png',
          upload: location.search === '?upload' ? {
              url: ''
          } : false
      });
      editor = new Simditor({
          textarea: $('#txt-content3'),
          placeholder: '',
          toolbar: toolbar,
          pasteImage: true,
          defaultImage: '/simditor/site/assets/images/image.png',
          upload: location.search === '?upload' ? {
              url: ''
          } : false
      });

    $preview = $('#preview');
    if ($preview.length > 0) {
      return editor.on('valuechanged', function(e) {
        return $preview.html(editor.getValue());
      });
    }
  });

}).call(this);

