var video = document.getElementById('video');
var canvas = document.getElementById('canvas');
var context = canvas.getContext('2d');
var imageLoader = document.getElementById('imageLoader');
    imageLoader.addEventListener('change', handleImage, false);

navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia ||
navigator.mozGetUserMedia || navigator.oGetUserMedia || navigator.msGetUserMedia;

if (navigator.getUserMedia){
    navigator.getUserMedia({video:true}, streamWebCam, throwError);
}

function streamWebCam(stream){
    video.srcObject = stream;
    video.play();
}

function throwError(e){
    alert(e.name);
}

function addSticker(id){
    var sticker = new Image();
    sticker.src = "./images/"+id+".png";
    if (canvas.width == 640){
        document.getElementById("errdiv").innerHTML = ""; 
        context = canvas.getContext('2d');
        context.drawImage(sticker,0,0,video.clientWidth, video.clientHeight);
        img.src = canvas.toDataURL('image/png');
        document.getElementById("canvdiv").innerHTML = "<img src="+img.src+">";
    }
    else{
        document.getElementById("errdiv").innerHTML = "You need to add/take a picture first."; 
    }
}

function snap(){
    document.getElementById("errdiv").innerHTML = ""; 
    canvas.width = video.clientWidth;
    canvas.height = video.clientHeight;
    context.translate(canvas.width, 0);
    context.scale(-1, 1);
    context.save();
    context.restore();
    context.drawImage(video, 0, 0);
    document.getElementById("canvas").style.transform = "rotateY(0deg)";
    document.getElementById("imageLoader").value="";
}
var image = document.querySelector('canvas');

function handleImage(e){
    var reader = new FileReader();
    reader.onload = function(event){
        var img = new Image();
        img.onload = function(){
            canvas.width = video.clientWidth;
            canvas.height = video.clientHeight;
            context.drawImage(img,0,0,img.width,img.height,0,0,canvas.width,canvas.height);
        }
        img.src = event.target.result;
    }
    reader.readAsDataURL(e.target.files[0]);
    document.getElementById("canvas").style.transform = "rotateY(0deg)";
}

function download(){
    var download = document.getElementById("download");
    var image = document.getElementById("canvas").toDataURL("image/png")
                .replace("image/png", "image/octet-stream");
    
    download.setAttribute("href", image);
}

function replaceImage(){
    var src = "./<?php echo $_SESSION['username']?>new.png"
    var img1 = new Image();
    img1.src = src;
    canvas.width = video.clientWidth;
    canvas.height = video.clientHeight;
    context.drawImage(img1,0,0,640,480,0,0,canvas.width,canvas.height);
}

document.getElementById("add_gal").addEventListener("click", function(){
    var img = new Image();
    img.src = canvas.toDataURL();
    if (canvas.width == video.clientWidth){
        var json = {
                pic: img.src
            }
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'function/save.php', true);
            xhr.setRequestHeader('Content-type', 'application/json');
            xhr.onreadystatechange = function (data) {
                if (xhr.readyState == 4 && xhr.status == 200)
                    console.log(xhr.responseText);
            }
            xhr.send(JSON.stringify(json))
    }
    });