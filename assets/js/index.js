document.oncontextmenu = () => {
    alert=("Mohon jangan diklik")
    return false
}

document.onkeydown = e => {
    if(e.key == "F12") {
        alert("Tidak bisa diinspect")
        return false
    }
    if(e.ctrlKey && e.key == "u") {
        alert("./")
        return false
    }
    if(e.ctrlKey && e.key == "c") {
        alert("./")
        return false
    }
    if(e.ctrlKey && e.key == "v") {
        alert("./")
        return false
    }
}