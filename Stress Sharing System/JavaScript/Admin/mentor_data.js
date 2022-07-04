
const mentor_table = document.getElementById("table_body");

document.querySelector("#search_bar button").onclick = function (e) {

  let button = e.target;
  let search = button.previousElementSibling.value;



  let search_mentor = new XMLHttpRequest();
  search_mentor.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      mentor_table.innerHTML = this.responseText;
    }
  }
  search_mentor.open("POST", "/SearchMentor", true);
  search_mentor.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  search_mentor.send("search=" + search);

}

document.querySelector("#search_bar input").oninput = function (e) {

  //let button = e.target;
  let search = e.target.value;



  let search_mentor = new XMLHttpRequest();
  search_mentor.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      mentor_table.innerHTML = this.responseText;
    }
  }
  search_mentor.open("POST", "/SearchMentor", true);
  search_mentor.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  search_mentor.send("search=" + search);

}
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

          let mentorid=remove_button.parentElement.firstElementChild.innerText;
          
          let remove_mentor = new XMLHttpRequest();
          remove_mentor.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
              if(this.responseText=="1")
              remove_button_container.style.display = "none";
   
            }
          }
          remove_mentor.open("POST", "/RemoveMentor", true);
          remove_mentor.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
          remove_mentor.send("id=" + mentorid);

        }
      }
      el.appendChild(remove_button);

      remove_button_container = el;
    }
  }
)


