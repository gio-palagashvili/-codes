       $("#file").change(function (e) { 
            var prop = document.getElementById("file").files[0];
            
            var image_name = prop.name;
            var image_ext = image_name.split(".").pop();
            if(jQuery.inArray(image_ext,['png','jpg','jpeg']) == -1) {
                alert("File Extension Not Supported");
            } else{
            var image_size = prop.size;
            if (image_size/1024 > 3000) {
                alert("File Too Big"+" "+image_size);
            }
            }
            });