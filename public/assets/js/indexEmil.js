let form = document.getElementById("form-absen")
let wid,hei;
const form_popup = () =>{
    const x = window.matchMedia("(max-width: 750px)");
    form.style.display = "flex";
    let box = document.querySelector('.camera');
    let width = box.offsetWidth;
    let height = box.offsetHeight;
    let pluswid = 200;
    let plushei = 200;
    if(wid == null){
      wid = width;
      hei = height;
      if (x.matches) {
          pluswid = 220;
          plushei = 10;
        }
    }
    Webcam.set({
        video: true,
        facingMode: "environment",
        enable_flash: true,
        width: wid+pluswid,
        height: hei+plushei,
        crop_width: wid,
        crop_height: hei,
        
        image_format: 'jpg',
        jpeg_quality: 600
    });
    Webcam.attach('#my_camera');
    console.log("test")
    if (navigator.geolocation) {
      navigator.geolocation.watchPosition(showPosition);
    } else { 
      x.innerHTML = "Geolocation is not supported by this browser.";
    }
  }

const close_form = () =>{
    console.log("tutup")
    form.style.display = "none"
}

$(".close").click(function() {
  $(this)
    .parent(".alert")
    .fadeOut();
});