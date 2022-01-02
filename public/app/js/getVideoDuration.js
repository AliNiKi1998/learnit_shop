var myVideos = [];

window.URL = window.URL || window.webkitURL;

document.getElementById('fileUp').onchange = setFileInfo;

function setFileInfo() {
    var files = this.files;
    myVideos.push(files[0]);
    var video = document.createElement('video');
    video.preload = 'metadata';

    video.onloadedmetadata = function () {
        window.URL.revokeObjectURL(video.src);
        var duration = video.duration;
        myVideos[myVideos.length - 1].duration = duration;
        updateInfos();
    }

    video.src = URL.createObjectURL(files[0]);;
}

function format(time) {
    // Hours, minutes and seconds
    var hrs = ~~(time / 3600);
    var mins = ~~((time % 3600) / 60);
    var secs = ~~time % 60;

    // Output like "1:01" or "4:03:59" or "123:03:59"
    var ret = "";
    if (hrs > 0) {
        hrs = hrs * 60;
    }
    ret += hrs + mins;
    return ret;
}

function updateInfos() {
    var videoTime = document.getElementById('videoTime');
    videoTime.value = "";
    for (var i = 0; i < myVideos.length; i++) {
        videoTime.value = format(myVideos[i].duration);
    }
}