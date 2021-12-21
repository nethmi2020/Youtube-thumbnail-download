<?php
if(isset($_POST['download'])){ // if download btn clicked
    $imgurl=$_POST['imgurl']; //get img url from hidde input
    $ch=curl_init($imgurl); //initializing curl
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
    $download=curl_exec($ch);
    curl_close($ch);
    header('Content-type:image/jpg');
    header('Content-Disposition:attachment; filename="thumbnail.jpg"');

}
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-Fo3rlrZj/k7ujTnHg4CGR2D7kSs0v4LLanw2qksYuRlEzO+tcaEPQogQ0KaoGN26/zrn20ImR1DfuLWnOo7aBA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
</head>
<body >
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
        <header>Download Thumbnail</header>
        <div class="url-input">
            <span class="title">Paste Video Url:</span>
            <div class="field">
                <input type="text"  class="" placeholder="https://youtu.be/DyclIVevIes" required>
                <input type="hidden" class="hidden-input" name="imgurl">
                <div class="bottom-line"></div>
            </div>
        </div>
            <div class="preview-area">
                <img src="" alt="" class="thumbnail">
                <i class="fas fa-cloud-download-alt icon"></i>
                <span>Paste video URL to see preview</span>
            </div>
            <button class="download-btn" type="submit" name="download">Download Thumbnail</button>
        
    </form>

    <script>

        const uriField=document.querySelector(".field input"),
        previewArea=document.querySelector(".preview-area"),
        imgTag=previewArea.querySelector(".thumbnail"),
        hiddenInput=document.querySelector(".hidden-input");

        uriField.onkeyup=()=>{

            let imgUrl=uriField.value;
          
            previewArea.classList.add("active");

            // https://www.youtube.com/watch?v=DyclIVevIes example of video url ----DyclIVevIes this is a video id and its unique.

            if(imgUrl.indexOf("https://www.youtube.com/watch?v=") != -1){ //if entered value is yt vieo url
                let vidId=imgUrl.split("v=")[1].substring(0,11); // splitting yt video url from v- so we can only get video id
                console.log(vidId);
                let yThumbUrl=` https://img.youtube.com/vi/${vidId}/maxresdefault.jpg`;
                console.log(yThumbUrl);
                imgTag.src = yThumbUrl;

            }else if(imgUrl.indexOf("https://youtu.be/") != -1){ //if video url is look like this
                let vidId=imgUrl.split("be/")[1].substring(0,11); // splitting yt video url from v- so we can only get video id
                console.log(vidId);
                let yThumbUrl=` https://img.youtube.com/vi/${vidId}/maxresdefault.jpg`;
                console.log(yThumbUrl);
                imgTag.src = yThumbUrl;

            }else if(imgUrl.match(/\.(jpe?g|png|gif|bmp|webp)$/i)){ // if entered value is other img file url}
                imgTag.src=imgUrl;

            }else{
                imgTag.src="";
            }
            hiddenInput.value=imgTag.src;
    }
    </script>
</body>
</html>