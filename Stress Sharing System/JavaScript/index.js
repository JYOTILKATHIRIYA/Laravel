var sy = window.scrollY;

document.onscroll = () => {
  if (window.scrollY > sy) {
    document.getElementById('header').style.boxShadow = "0 5px 5px rgba(104, 101, 101, 0.8)";

    document.getElementById('header').style.height = "0";
    sy = window.scrollY;
    return;
  }
  if (window.scrollY < sy) {
    var hide = () => { document.getElementById('header').style.boxShadow = "none" };

    setTimeout(hide, 500);

    document.getElementById('header').style.height = "60px";
    sy = window.scrollY;
    return;
  }
}

document.body.onload = () => {
  LoadExtSections();


}

function closepopup(id, dir) {
  if (dir == 0)
    document.getElementById(id).style.transform = "translate(-100vw)";
  if (dir == 1)
    document.getElementById(id).style.transform = "translate(100vw)";

  var hide = () => { document.getElementById(id).style.display = "none" };
  setTimeout(hide, 300);
}

function LoadExtSections() {

  let err = sessionStorage.getItem("error");
  let dname = sessionStorage.getItem("displayName");
  let email = sessionStorage.getItem("email");


  var req = new XMLHttpRequest();
  req.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {

      document.querySelector("#SignUpSec").innerHTML = document.querySelector("#SignUpSec").innerHTML + this.responseText;
    }

  }
  if (err)
    req.open("GET", "/register/" + err + "/" + dname + "/" + email, true);
  else
    req.open("GET", "/register/", true);
  req.send();

  sessionStorage.removeItem("error");
  sessionStorage.removeItem("displayName");
  sessionStorage.removeItem("email");


  let login_err = sessionStorage.getItem("login_error");

  var req = new XMLHttpRequest();
  req.onreadystatechange = function () {

    if (this.readyState == 4 && this.status == 200) {

      document.querySelector("#SignInSec").innerHTML = document.querySelector("#SignInSec").innerHTML + this.responseText;

    }

  }
  if (login_err)
    req.open("GET", "/login/" + login_err, true);
  else
    req.open("GET", "/login", true);
  req.send();
  sessionStorage.removeItem("login_error");


}

document.querySelector("#joinnowpopup div button").onclick = () => {
  displaysignup();
  document.querySelector("#SignInLink").onclick = () => {
    closesignup();
    displaysignin();
  }

}

document.getElementById("loginbtn").onclick = () => {
  displaysignin();
  document.querySelector("#SignUpLink").onclick = () => {
    closesignin();
    displaysignup();
  }
}




function displaysignup() {
  document.querySelector("#SignUpSec").style.height = "100vh";
}
function displaysignin() {
  document.querySelector("#SignInSec").style.width = "425px";
}

function closesignup() {
  document.querySelector("#SignUpSec").style.height = "0vh";
}

function closesignin() {
  document.querySelector("#SignInSec").style.width = "0";

}

var flag = true;
function display_leftnav() {
  if (flag) {
    document.querySelector("#leftnav").style.marginLeft = "0";
    document.querySelector(" #leftnav #notch span").innerText = "⮜";
    flag = false;
    return;
  }
  hide_leftnav();
}
function hide_leftnav() {
  document.querySelector("#leftnav").style.marginLeft = "-104px";
  document.querySelector(" #leftnav #notch span").innerText = "⮞";

  flag = true;
}

function setlinks() {
  closesignup();
  displaysignin();
}

