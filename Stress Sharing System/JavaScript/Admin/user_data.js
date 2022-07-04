
const mentor_table = document.getElementById("table_body");

var remove_button_container;

document.querySelectorAll("#table_body tr").forEach(
  el => {
    el.onclick = () => {

      if (remove_button_container) {
        remove_button_container.lastElementChild.remove();
      }
      let remove_button = document.createElement("button");
      remove_button.innerText = "Remove";
      remove_button.className = "remove_btn";
      remove_button.onclick = () => {
        if (confirm("Are You Sure???... ")) {

          let userid=remove_button.parentElement.firstElementChild.innerText;
          
          let remove_mentor = new XMLHttpRequest();
          remove_mentor.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
              if(this.responseText=="1")
              remove_button_container.style.display = "none";
   
            }
          }
          remove_mentor.open("POST", "/RemoveUser", true);
          remove_mentor.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          remove_mentor.send("id=" + userid);

        }
      }
      el.appendChild(remove_button);

      remove_button_container = el;
    }
  }
)


