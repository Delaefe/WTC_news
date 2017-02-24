$(document).ready(function () {
      $("#title").focus();
   });

      content_textarea = "";
      content_title = "";
      title_size= 85;
      max_size = 178;

      function check_length_title(){ 
         countt = document.getElementById("title").value.length;

         if (countt > title_size){ 
            document.getElementById("title").value = content_title;
         }else{ 
            content_title = document.getElementById("title").value;
         } 

      }
      
      function check_length(){ 
         count = document.getElementById("description").value.length;

         if (count > max_size){ 
            document.getElementById("description").value = content_textarea;
         }else{ 
            content_textarea = document.getElementById("description").value;
         } 

      }