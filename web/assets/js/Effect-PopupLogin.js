function togglePopup(){
    document.getElementById("popup-1").classList.toggle("active");
}

function repassPopup(){
    document.getElementById("popup-2").classList.toggle("active");
    document.getElementById("popup-1").classList.remove("active");
}

function openUser(evt, actName ) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(actName).style.display = "block";
    evt.currentTarget.className += " active";
  }
