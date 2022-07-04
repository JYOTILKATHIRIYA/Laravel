
const issues_table = document.getElementById("table_body");

document.querySelector("#add_new_issue button").onclick = function (e) {

  let button = e.target;
  let issue = button.previousElementSibling.value;



  let new_issue = new XMLHttpRequest();
  new_issue.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      location.reload();
    }
  }
  new_issue.open("POST", "/AddNewIssue", true);
  new_issue.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  new_issue.send("issue=" + issue);

}

var button_container;
var update_flag = false;

document.querySelectorAll("#table_body tr").forEach(
  el => {
    el.onclick = () => {

      if (button_container) {
        button_container.lastElementChild.remove();
        button_container.lastElementChild.remove();
        button_container.lastElementChild.remove();
        button_container.lastElementChild.remove();
      }

      let remove_button = document.createElement("button");
      let edit_button = document.createElement("button");
      let cancle_button = document.createElement("button");
      let save_btn = document.createElement("button");

      remove_button.innerText = "Remove";
      edit_button.innerText = "Edit";
      cancle_button.innerText = "Cancle";
      save_btn.innerText = "Save";

      remove_button.className = "remove_btn";
      edit_button.className = "edit_btn";
      cancle_button.className = "cancle_btn";
      save_btn.className = "save_btn";

      let issueid = el.firstElementChild.innerText;


      remove_button.onclick = () => {
        if (confirm("Are You Sure???... ")) {


          let remove_issue = new XMLHttpRequest();
          remove_issue.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
              if (this.responseText == "1")
                button_container.style.display = "none";

            }
          }
          remove_issue.open("POST", "/RemoveIssue", true);
          remove_issue.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          remove_issue.send("id=" + issueid);

        }
      }

      edit_button.onclick = () => {
        let textbox = edit_button.parentElement.firstElementChild.nextElementSibling.firstElementChild;
        textbox.disabled = false;
        textbox.style.border = "1px solid black";
        textbox.focus();
        sessionStorage.setItem("old_textbox_value", textbox.value);

        textbox.oninput = function () {
          let issue = textbox.value;

        }
      }

      save_btn.onclick = () => {
        let issue = save_btn.parentElement.firstElementChild.nextElementSibling.firstElementChild.value;
        if (confirm("Are You Sure???... ")) {

          let edit_issue = new XMLHttpRequest();
          edit_issue.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
              location.reload();
            }
          }
          edit_issue.open("POST", "/EditIssue", true);
          edit_issue.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          edit_issue.send("id=" + issueid + "&&issue=" + issue);

        }
      }

      cancle_button.onclick = () => {
        let textbox = cancle_button.parentElement.firstElementChild.nextElementSibling.firstElementChild;
        if (sessionStorage.old_textbox_value)
          textbox.value = sessionStorage.old_textbox_value;
          else
          location.reload();
        textbox.disabled = true;
        textbox.style.border = "none";
        
        sessionStorage.removeItem("old_textbox_value");

      }

      el.appendChild(edit_button);
      el.appendChild(save_btn);
      el.appendChild(cancle_button);
      el.appendChild(remove_button);

      button_container = el;
    }
  }
)


document.querySelector(".padding_infor_info").onclick = () => {

}

function free_btn_container() {

}