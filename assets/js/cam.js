const video = document.getElementById('video');

if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
    navigator.mediaDevices.getUserMedia({ video: true })
        .then(function (stream) {
            video.srcObject = stream;
        })
        .catch(function (error) {
            console.log("Ada masalah dalam mengakses kamera: ", error);
        });
} else {
    alert('Browser Anda tidak mendukung akses kamera!');
}
