// 显示弹出图片和按钮
function showPopup(thumbnail) {
    var imgSrc = thumbnail.src;
    document.getElementById("popup-img").src = imgSrc;
    document.getElementById("popup").style.display = "block";
    document.addEventListener("keydown", handleKeyDown);
}

// 隐藏弹出图片和按钮
function hidePopup() {
    document.getElementById("popup").style.display = "none";
    document.removeEventListener("keydown", handleKeyDown);
}

// 切换到前一个图片
function showPrev() {
    var currentImg = document.getElementById("popup-img");
    var currentSrc = currentImg.src;
    var imgList = document.querySelectorAll(".thumbnail");
    for (var i = 0; i < imgList.length; i++) {
        if (imgList[i].src == currentSrc) {
            var prevIndex = i - 1;
            if (prevIndex < 0) {
                prevIndex = imgList.length - 1;
            }
            currentImg.src = imgList[prevIndex].src;
            break;
        }
    }
}

// 切换到后一个图片
function showNext() {
    var currentImg = document.getElementById("popup-img");
    var currentSrc = currentImg.src;
    var imgList = document.querySelectorAll(".thumbnail");
    for (var i = 0; i < imgList.length; i++) {
        if (imgList[i].src == currentSrc) {
            var nextIndex = i + 1;
            if (nextIndex >= imgList.length) {
                nextIndex = 0;
            }
            currentImg.src = imgList[nextIndex].src;
            break;
        }
    }
}

// 处理键盘事件
function handleKeyDown(event) {
    switch (event.key) {
        case "ArrowLeft":
            showPrev();
            break;
        case "ArrowRight":
            showNext();
            break;
        case "Escape":
            hidePopup();
            break;
    }
}
