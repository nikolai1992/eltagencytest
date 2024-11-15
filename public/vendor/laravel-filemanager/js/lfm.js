(function( $ ){

  $.fn.filemanager = function(type, options) {
    type = type || 'file';

    this.on('click', function(e) {
      var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
      localStorage.setItem('target_input', $(this).data('input'));
      localStorage.setItem('target_preview', $(this).data('preview'));
      // console.log($(this).data('preview'))
      // console.log($(this).data('input'))
      window.open(route_prefix + '?type=' + type, 'FileManager', 'width=900,height=600');
      window.SetUrl = function (url) {
          //set the value of the desired input to image url
          var target_input = $('#' + localStorage.getItem('target_input'));
          console.log("target_input = "+localStorage.getItem('target_input'));
          console.log(target_input);
          var file_path = url[0].url;
          console.log(file_path);
          file_path = file_path.replace(window.location.origin, '');
          console.log(file_path);
          target_input.val(file_path).trigger('change');

          //set or change the preview image src
          var target_preview = $('#' + localStorage.getItem('target_preview'));
          console.log(url[0]);
          target_preview.attr('src', url[0].url).trigger('change');
      };
      return false;
    });
  }

})(jQuery);
