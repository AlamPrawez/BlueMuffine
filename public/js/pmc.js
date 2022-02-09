//This is for single image compress

function compress() {
    var file = document.getElementById('imgInp').files[0];    //Get the file from input
    var reader = new FileReader();                                  // create file reader
    reader.readAsDataURL(file);                                     // Read file as url with file reader
    reader.onload = function (event) {                      
        const elem = document.createElement('img');                 // On reader load create an element called img
        elem.src = event.target.result;                             // Get image src from reader load event
        // document.querySelector('#input').src = event.target.result;
        elem.onload = function (e) {                                    
            const canvas = document.createElement('canvas');        // Once image src loaded create a canvas.
            const MAX_WIDTH = 400;                                  // Set max width for the canvas.
            const scaleSize = MAX_WIDTH / e.target.width;           // define scalesize
            canvas.width = MAX_WIDTH;                               // Assigning max_width to canvas width.
            canvas.height = e.target.height * scaleSize;            // Calculating height of canvas 
            const ctx = canvas.getContext("2d");                    // Get 2d canvas created.
            ctx.drawImage(e.target, 0, 0, canvas.width, canvas.height);
            var dataUrl = canvas.toDataURL();                        // Get the base64 value of canvas 
            $("#srcVal").val(dataUrl);                              // Assigning base64 value to id in input field.
            const srcEncoded = ctx.canvas.toDataURL(e.target, 'image/jpg'); 
            document.querySelector('#img-upload').src = srcEncoded;

        }
    }
}

let g_image ;

function compress_parameter(uploadid,storeid) {
    var file = document.getElementById(uploadid).files[0];  
      //Get the file from input
    var reader = new FileReader();                                  // create file reader
    reader.readAsDataURL(file);                                     // Read file as url with file reader
    reader.onload = function (event) {                      
        const elem = document.createElement('img');                 // On reader load create an element called img
        elem.src = event.target.result;                             // Get image src from reader load event
        // document.querySelector('#input').src = event.target.result;
        elem.onload = function (e) {                                    
            const canvas = document.createElement('canvas');        // Once image src loaded create a canvas.
            const MAX_WIDTH = 400;                                  // Set max width for the canvas.
            const scaleSize = MAX_WIDTH / e.target.width;           // define scalesize
            canvas.width = MAX_WIDTH;                               // Assigning max_width to canvas width.
            canvas.height = e.target.height * scaleSize;            // Calculating height of canvas 
            const ctx = canvas.getContext("2d");                    // Get 2d canvas created.
            ctx.drawImage(e.target, 0, 0, canvas.width, canvas.height);
            var dataUrl = canvas.toDataURL(); 
         g_image = dataUrlToFile(dataUrl,file.name); 
          // $("#srcVal").val(dataUrlToFile(dataUrl,file.name));  
            const srcEncoded = ctx.canvas.toDataURL(e.target, 'image/jpg'); 
            document.querySelector("#"+storeid).src = srcEncoded;

        }
    }
}


//This is for multiple image compress
// var imageurl_global = [];
function multipleCompress(i) {
    var file = document.getElementById('image-upload' + i).files[0];
    var reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function (event) {
        const elem = document.createElement('img');
        elem.src = event.target.result;
        // document.querySelector('#input').src = event.target.result;
        elem.onload = function (e) {
            const canvas = document.createElement('canvas');
            const MAX_WIDTH = 1152;
            const scaleSize = MAX_WIDTH / e.target.width;
            canvas.width = MAX_WIDTH;
            canvas.height = e.target.height * scaleSize;
            const ctx = canvas.getContext("2d");
            ctx.drawImage(e.target, 0, 0, canvas.width, canvas.height);
            var dataUrl = canvas.toDataURL();
            $("#srcVal" + i).val(dataUrl);
            // imageurl_global = dataUrlToFile(dataUrl,file.name);
            // imageurl_global.push(dataUrlToFile(dataUrl,file.name));


            // console.log(imageurl);
            // // imageurl.src = dataUrl;
            // $("#imageId").html(imageurl);

            const srcEncoded = ctx.canvas.toDataURL(e.target, 'image/jpg');
            document.querySelector('#output' + i).src = srcEncoded;
        }
    }
}

// Decode base64 to image
function dataUrlToFile(dataurl, filename) {
    var arr = dataurl.split(','),
        mime = arr[0].match(/:(.*?);/)[1],
        bstr = atob(arr[1]),
        n = bstr.length,
        u8arr = new Uint8Array(n);

    while (n--) {
        u8arr[n] = bstr.charCodeAt(n);
    }
    return new File([u8arr], filename, {type: mime});
}