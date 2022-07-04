//var msg_count;
let notification = document.querySelector("#dashboardheader #content_right .message_icon .unreads");
const chat_messages = document.getElementsByClassName("messages")[0];
const _chatbox_ = document.getElementById('chatbox');
sessionStorage.setItem("is_chatbox_open", "0");

function msg_notify() {
  let get_unreads = new XMLHttpRequest();
  get_unreads.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {

      if (this.responseText == "0") {

        notification.style.display = "none";
        return;
      }


      notification.innerText = this.responseText;
      notification.style.display = "inline";
      msg_count = this.responseText;

      if (sessionStorage.is_chatbox_open != "0") {
        // console.log("called");
        Rerender_chatbox()
      };

    }
  }
  get_unreads.open("POST", "/GetUnreads", true);
  get_unreads.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

  get_unreads.send();

}

setInterval(msg_notify, 2000);


document.querySelector(".message_icon").onclick = function () {
  Rerender_chatbox();

}


document.querySelectorAll("#chatbox .element").forEach(
  el => {
    el.onclick = () => {
      let talkerid = el.firstElementChild.value;
      let talkername = el.firstElementChild.nextElementSibling.innerText;

      show_message_box(talkerid, talkername);
    }
  }
)

function show_message_box(talkerid, talkername) {
  let message_box = document.getElementById("message_box");
  chat_messages.innerHTML = "";
  message_box.style.display = "block";
  message_box.firstElementChild.value = talkerid;
  message_box.getElementsByTagName("h1")[0].innerHTML = talkername;

  let load_messages = new XMLHttpRequest();
  load_messages.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      chat_messages.innerHTML = this.responseText;
    }
  }
  load_messages.open("POST", "/GetMessages", true);
  load_messages.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  load_messages.send("talker=" + talkerid);


  setTimeout(scroll_chatbox, 500, true);

}

document.querySelectorAll(".send_message_con button").forEach(
  el => {
    el.onclick = () => {


      let textarea = el.parentElement.firstElementChild;
      let message = textarea.value;

      if (message.trim() == "") return;
      let talkerid = el.parentElement.parentElement.firstElementChild.value;
      let talkername = el.parentElement.parentElement.getElementsByTagName("h1")[0].innerText;

      let send_message = new XMLHttpRequest();
      send_message.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          let sended_msg = "<div class='msg_con'><span class='sended'>" + this.responseText + "</span></div>";
          chat_messages.insertAdjacentHTML("beforeend", sended_msg);
          setTimeout(scroll_chatbox, 500, true);

        }
      }
      send_message.open("POST", "/SendMessage", true);
      send_message.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      send_message.send("talker=" + talkerid + "&&message=" + message);

      //console.log(talker.value);
      textarea.value = "";
      //console.log(message);



    }
  }
)


var sy = true;

function scroll_chatbox(sy) {
  //console.log(chat_messages.scrollTop);
  if (sy) {
    chat_messages.scrollTop = chat_messages.scrollHeight +2;
  }
  sy = false;


  /*chat_messages.scrollTo({
    top: chat_messages.scrollHeight,
    left: 0,
    behavior: 'smooth'
  })*/

}
var script_adding_flag = true;



function Rerender_chatbox() {


  let render_chatbox = new XMLHttpRequest();
  render_chatbox.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      _chatbox_.innerHTML = this.response;


    }
  }
  render_chatbox.open("POST", "/ChatBox", true);
  render_chatbox.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  render_chatbox.send();



  let script = document.createElement("script");
  script.src = "js/chatbox.js";

  _chatbox_.appendChild(
    script
  )

  _chatbox_.style.height = "93vh";
  sessionStorage.is_chatbox_open = "1";
}

function set_active_chat_session(talkerid) {

  let new_chats = new XMLHttpRequest();
  new_chats.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      if (this.responseText) {
        chat_messages.insertAdjacentHTML("beforeend", this.responseText);
        setTimeout(scroll_chatbox, 500, true);

      }
    }
  }
  new_chats.open("POST", "/GetChats", true);
  new_chats.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  new_chats.send("talker=" + talkerid);


}

function testing() {
  console.log("interval ongoing");
}
