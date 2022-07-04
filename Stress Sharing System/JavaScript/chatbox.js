var active_chat;

document.querySelectorAll("#chatbox .element").forEach(
  el => {
    el.onclick = () => {

      let talkerid = el.firstElementChild.value;
      let talkername = el.firstElementChild.nextElementSibling.innerText;

      show_message_box(talkerid, talkername);
      active_chat = setInterval(set_active_chat_session, 1000, talkerid);

    }
  }
)

document.querySelector("#message_box .back_button_con button ").onclick = () => {
  document.getElementById("message_box").style.display = "none";
  clearInterval(active_chat);


  Rerender_chatbox();
}

