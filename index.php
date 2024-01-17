<?php
if(isset($_POST['DOW'])){
    $imgUrl=$_POST['imgUrl'];
    $ch=curl_init($imgUrl);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    $DOW= curl_exec($ch);
    curl_close($ch);
    header('Content_type : image/jpg');
    header('Content-Disposition:attachment; filename="thumbnail.jpg"');
    echo $DOW;

}


?>








<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="style.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Poppins&family=Rubik:wght@300;400;500;600;800&display=swap" rel="stylesheet">
        <title>The dowloader</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha384-GLhlTQ8i7uZu25LlC5GRSNZXAgJQcjnL/6xVM+SH" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">


    </head>
    <body>
        <form action="<?php echo $_SERVER['PHP_SELF'];   ?>" method="POST">
            <header>Download Thumbnail</header>
            <div class="url-input">
                <span class="title">Paste your video URL:</span>
                <div class="field">
                    <input type="text" name="video" placeholder="https://www.youtube.com/watch?v=Ac_4TZ-FL74" required>
                    <input class="hidden-input" type="hidden" name="imgUrl">
                    <div class="bottom-line"></div>
                </div>
            </div>
            <div class="preview-area">
                <img class="Thumbnail" src="" alt="Thumbnail">
                <i class="fas fa-cloud-download-alt"></i>
                <span>Paste video url to see preview</span>
                
                   
            </div>
            <i class="fas fa-cloud-download-alt"></i>
            <input type="submit" name="DOW" value="Download" class="downloader" >

        </form>
        <script>
            const urlField = document.querySelector(".field input"),
                previewArea = document.querySelector(".preview-area"),
                imgTag = previewArea.querySelector(".Thumbnail"),
                hiddenInput = document.querySelector(".hidden-input");
        
            urlField.onkeyup = () => {
                let imgUrl = urlField.value;
                previewArea.classList.add("active");
        
                // Check conditions inside the event handler
                if (imgUrl.indexOf("https://www.youtube.com/watch?v=") != -1) {
                    let vidId = imgUrl.split("v=")[1].substring(0, 11);
                    let ytThumbUrl=`https://img.youtube.com/vi/${vidId}/maxresdefault.jpg`;
                    imgTag.src = ytThumbUrl;
                } else if (imgUrl.indexOf("https://youtu.be") != -1) {
                    let vidId = imgUrl.split("be/")[1].substring(0, 11);
                    let ytThumbUrl=`https://img.youtube.com/vi/${vidId}/maxresdefault.jpg`;
                    imgTag.src = ytThumbUrl;
                } else if (imgUrl.match(/\.(jpe?g|png|gif|bmp|webp)$/i)) {
                    imgTag.src = imgUrl;
                }
                else{
                    imgTag.src=""
                    previewArea.classList.remove("active");
                }
                hiddenInput.value= imgTag.src;

            };
        </script>
        
    </body>
</html>