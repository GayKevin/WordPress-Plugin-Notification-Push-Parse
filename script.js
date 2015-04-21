jQuery(document).ready(function($) {

  $('input[name="pn_text"]').on('input',function(){outputLength()});

  function outputLength(){

        var length = 42
         + checkLength( $('input[name="pn_text"]').val()  )

         if (length > 255) {

          $("#output").html("<b style='color:#f00'>"+length+"</b>"); 
          $("#push_button").prop('disabled', true);

         }else{
          $("#push_button").prop('disabled', false);
          $("#output").html(length);
        }
  }

  function checkLength(text) {

      var escapedStr = encodeURI(text);
      if (escapedStr.indexOf("%") != -1) {
          var count = escapedStr.split("%").length - 1;
          if (count == 0) count++; 
          var tmp = escapedStr.length - (count * 3);
          count = count + tmp;
      } else {
          count = escapedStr.length;
      }
      return count;
  }
});