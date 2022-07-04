
const absolute_container = document.getElementById("mentor_profile_con");
const absolute_section = document.getElementById("mentor_profile");

document.querySelector("#invisible").onclick = () => {

  document.getElementById("chatbox").style.height = "0";
  sessionStorage.is_chatbox_open = "0";
  document.getElementById("matching_people_sec").style.height = "0";
  document.getElementById("followed_mentors_sec").style.top = "100vh";
  profile_popup.style.height = "0";

}

document.querySelector("#content_left span:first-of-type").onclick = () => {
  document.getElementById("matching_people_sec").style.height = "93vh";
}
document.querySelector("#content_left span:last-of-type").onclick = () => {
  document.getElementById("followed_mentors_sec").style.top = "50px";
}

document.querySelector("#mentor_profile_con .back_button_con ").onclick = () => {
  document.getElementById("mentor_profile").innerHTML = "";
  if (sessionStorage.render_comments) sessionStorage.removeItem("render_comments");
}


document.querySelectorAll(".back_button_con button").forEach(
  el => {
    el.onclick = () => {
      el.parentElement.parentElement.style.display = "none";

    }
  }
)

var script_adding_flag = true;
document.querySelectorAll("#experts_suggession .expert_profile .profile_info a").forEach(el => {
  el.onclick = (e) => {

    let mentorid = el.name;
    console.log(mentorid);


    let mentorprofile = new XMLHttpRequest();
    mentorprofile.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {
        //document.querySelector("#mentor_profile_con .back_button_con button").insertAdjacentHTML("afterend",this.responseText);
        absolute_section.innerHTML = this.responseText;
        if (!script_adding_flag) return;
        let script = document.createElement("script");
        script.src = "js/mentors/profile.js"

        document.body.appendChild(
          script
        )
        let script2 = document.createElement("script");
        script2.src = "js/posts.js"

        document.body.appendChild(
          script2
        )
      }
    }
    mentorprofile.open("GET", "/mentor/" + mentorid, "true");
    mentorprofile.send();

    absolute_container.style.display = "block";


  }

})



document.querySelectorAll("#experts_suggession .expert_profile button").forEach(el => {
  el.onclick = (e) => {

    let hide = function () { el.parentElement.remove(); };


    mentorid = el.parentElement.children[1].children[0].name;

    let add_follower = new XMLHttpRequest();
    add_follower.addEventListener("readystatechange", function () {
      if (this.readyState == 4 && this.status == 200) {
        if (this.responseText) {
          el.style.color = "white";
          el.style.backgroundColor = "green";
          el.style.backgroundImage = "none";
          el.disabled = true;

          el.innerHTML = '<i class="fa-solid fa-check"></i>&nbspFollowing';
          setTimeout(hide, 1200);

        }
      }
    });
    add_follower.open("POST", "/Follow", true);
    add_follower.setRequestHeader('Content-type', "application/x-www-form-urlencoded");
    add_follower.send("mentorid=" + mentorid);
  }


});


document.querySelectorAll(".matching_people_comp button").forEach(el => {
  el.onclick = () => {
    let talkerid = el.parentElement.firstElementChild.value;
    let talkername = el.previousElementSibling.innerText;

    show_message_box(talkerid, talkername);
  }
})

document.querySelectorAll(".post .post_feedback .like .comment_btn").forEach(
  el => {
    el.onclick = () => {
      let postid = el.parentElement.previousElementSibling.value;

      render_comments(postid);
      sessionStorage.setItem("render_comments", "true");

    }
  }
)

const profile_popup = document.getElementById("profile_popup");

document.querySelector("#dashboardheader a").addEventListener("click", () => {
  profile_popup.style.height = "20%";
});

document.querySelector("#profile_popup .signout_btn").onclick = () => {
  location.replace("/SignOut");
}


document.querySelector("#profile_popup .updateprofile_btn").onclick = () => {
  location.replace("/UpdateProfile");
}
function render_comments(postid) {



  let post_comments = new XMLHttpRequest();
  post_comments.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      absolute_section.innerHTML = "<section id='posts_section'>" + this.responseText + "</section>";

      let script = document.createElement("script");
      script.src = "js/posts.js";

      absolute_section.appendChild(script);
    }
  }
  post_comments.open("POST", "/GetComments", true);
  post_comments.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  post_comments.send("postid=" + postid);

  absolute_container.style.display = "block";

}

if (document.querySelector(".unfollow_followed_btn") != null) {
  document.querySelectorAll(".unfollow_followed_btn").forEach(
    el => {
      el.onclick = () => {
        if (confirm("Want to Unfollow this Mentor??")) {

          let mentorid=el.previousElementSibling.value;
          let remove_follower = new XMLHttpRequest();
          remove_follower.addEventListener("readystatechange", function () {
            if (this.readyState == 4 && this.status == 200) {
              if (this.responseText) {
                
                el.parentElement.parentElement.remove();

              }
            }
          });
          remove_follower.open("POST", "/Unfollow", true);
          remove_follower.setRequestHeader('Content-type', "application/x-www-form-urlencoded");
          remove_follower.send("mentorid=" + mentorid);


        }
      }
    }
  )
}