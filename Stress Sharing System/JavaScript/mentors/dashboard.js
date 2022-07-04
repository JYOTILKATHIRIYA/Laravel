

const absolute_section = document.getElementById("absolute_section");
const absolute_container = document.getElementById("absolute_container");



document.querySelectorAll(".post .post_feedback .comment textarea").forEach(el => {
  el.onkeypress = (e) => {
    if ((e.code == "NumpadEnter" || e.code == "Enter") && el.value.trim() != "") {
      if (e.target.rows < 5)
        e.target.rows += 1;
    }
  }
})


document.querySelectorAll(".post .post_feedback .comment textarea").forEach(el => {
  el.onkeydown = (e) => {
    if (e.code == "Backspace") {

      let newline = el.value.lastIndexOf("\n");
      let len = el.value.length;

      if (e.target.rows > 1 && newline == len - 1)
        e.target.rows -= 1;
    }
  }

})


document.querySelectorAll("#create_post_section .container div:first-of-type textarea").forEach(el => {
  el.onkeypress = (e) => {
    if ((e.code == "NumpadEnter" || e.code == "Enter") && el.value.trim() != "") {


      if (e.target.rows < 20)
        e.target.rows += 1;
    }

  }

})

document.querySelectorAll("#create_post_section .container div:first-of-type textarea").forEach(el => {
  el.onkeydown = (e) => {


    if (e.code == "Backspace") {

      let newline = el.value.lastIndexOf("\n");
      let len = el.value.length;

      if (e.target.rows > 2 && newline == len - 1)
        e.target.rows -= 1;
    }
  }

})


document.querySelector("#create_post_section .container div:last-of-type button").onclick = () => {

  let post_content = document.querySelector("#create_post_section .container div:first-of-type textarea");

  if (post_content.value.trim() == "") return;


  let disable = function () {
    document.querySelector("#create_post_section .container div:first-of-type textarea ").disabled = true;
    document.querySelector("#create_post_section .container div:last-of-type button ").disabled = true;
  }

  let enable = function () {
    document.querySelector("#create_post_section .container div:first-of-type textarea ").disabled = false;
    document.querySelector("#create_post_section .container div:last-of-type button ").disabled = false;
    post_content.value = "";

  }

  disable();
  var post_request = new XMLHttpRequest();
  post_request.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {

     /* const first_element = document.getElementById("posts_section");
      
      
      let html = this.responseText;
      
      

      first_element.insertAdjacentHTML("afterbegin", html);*/
      location.reload();
      //document.getElementById("posts_section").innerHTML+=this.responseText;

    }
  }
  post_request.open("POST", "/NewPost", "false");
  post_request.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  post_request.send("content=" + post_content.value.trim());

  setTimeout(enable, 800);
}

document.querySelectorAll('.post .post_content .buttons button:first-of-type').forEach(
  el => {
    el.onclick = () => {
      //console.log("Clicked");
      absolute_section.style.display = "block";
      let postid = el.parentElement.parentElement.parentElement.firstElementChild.value;
      //console.log(postid);

      let post_updation = new XMLHttpRequest();
      post_updation.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          absolute_container.innerHTML = "<section id='posts_section'>" + this.responseText + "</section>";

          var script = document.createElement("script");
          script.src = "js/mentors/post_update.js";
          absolute_container.appendChild(script);

        }
      }
      post_updation.open("POST", "/GetPostToUpdate", "true");
      post_updation.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      post_updation.send("postid=" + postid);

      absolute_section.style.display = "block";
    }
  }
)

document.querySelectorAll('.post .post_content .buttons button:last-of-type').forEach(
  el => {
    el.onclick = () => {
      document.getElementById('delete_popup_con').style.display = "flex";
      let postid = el.parentElement.parentElement.parentElement.firstElementChild.value;
      sessionStorage.setItem("delete_post_id", postid);
      el.parentElement.parentElement.parentElement.classList.add('delete_post');
      console.log(postid);
    }

  }


);

document.querySelector("#delete_popup .buttons button:first-of-type").onclick = () => {
  document.querySelector(".delete_post").classList.remove("delete_post");

  document.getElementById('delete_popup_con').style.display = "none";

}

document.querySelector("#delete_popup .buttons button:last-of-type").onclick = () => {

  let postid = sessionStorage.getItem('delete_post_id');
  let delete_post = new XMLHttpRequest();
  delete_post.onreadystatechange = function () {
    if (this.status == 200 && this.readyState == 4) {
      document.getElementById('delete_popup_con').style.display = "none";
      document.querySelector(".delete_post").remove();
    }
  }
  delete_post.open("POST", "/DeletePost", true);
  delete_post.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  delete_post.send("postid=" + postid);

}




document.querySelector(".mentor_update_profile_btn").addEventListener("click", function () {
  location.assign("/MentorProfileUpdate");

})

document.querySelector(".mentor_signout_btn").addEventListener("click", function () {
  location.replace("/MentorSignOut");

})


document.querySelectorAll(".back_button_con button").forEach(
  el => {
    el.onclick = () => {
      el.parentElement.parentElement.style.display = "none";
      absolute_container.innerHTML = "";

    }
  }
)


document.querySelectorAll(".comment_btn").forEach(
  el => {
    el.onclick = () => {
      let postid = el.previousElementSibling.value;

      let load_comments = new XMLHttpRequest();
      load_comments.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
          absolute_container.innerHTML = "<section id='posts_section'>" + this.responseText + "</section>";

        }
      }
      load_comments.open("POST", "/GetPostComments", "true");
      load_comments.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      load_comments.send("postid=" + postid + "&&mentor=1");

      absolute_section.style.display = "block";
    }

  }
)

const update_profile_picture_icon = document.querySelector("#profile_section .profile_con .profile_picture .edit_profile_picture_btn");

document.querySelector("#profile_section .profile_con .profile_picture").onmouseover = () => {
  update_profile_picture_icon.style.display = "inline-block";
}

document.querySelector("#profile_section .profile_con .profile_picture").onmouseleave = () => {
  update_profile_picture_icon.style.display = "none";
}

update_profile_picture_icon.onclick = () => {
  var file_upload = document.createElement("input");
  file_upload.type = "file";
  file_upload.accept="image/png, image/jpeg"
  file_upload.name = "profile_picture";
  file_upload.click();

  file_upload.onchange = async function () {
    let formData = new FormData();
    formData.append("email",update_profile_picture_icon.firstElementChild.value);
    formData.append("profile_picture", file_upload.files[0]);
    const response=await fetch('/justfile', {
      method: "POST",
      body: formData
    });

    response.text().then(function(text) {
      absolute_container.innerHTML = text;

      
    });

    absolute_section.style.display="block";
    

      setTimeout(function(){
        let script=document.createElement("script");
      script.src="/js/mentors/profile_picture_update.js";
        absolute_container.appendChild(script)

      },1000);

  }




}