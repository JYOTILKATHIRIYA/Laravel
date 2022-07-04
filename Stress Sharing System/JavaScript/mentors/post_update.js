
document.querySelector(".post_update_btn button").onclick = function () {
  let postid = this.previousElementSibling.value;

  let content = this.parentElement.previousElementSibling.firstElementChild.getElementsByTagName("textarea")[0];
  if (content.value.trim() == "") {
    content.focus();
    return;
  }




  let post_updation = new XMLHttpRequest();
  post_updation.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      absolute_container.innerHTML = "<section id='posts_section'>" + this.responseText + "</section>";

      var script = document.createElement("script");
      script.src = "js/mentors/post_update.js";
      absolute_container.appendChild(script);

    
    }
  }
  post_updation.open("POST", "/UpdatePost", "true");
  post_updation.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  post_updation.send("postid=" + postid + "&&content=" + content.value.trim());

}