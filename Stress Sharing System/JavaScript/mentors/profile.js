/* 
//foreach example
const toggleElements = document.querySelectorAll('.toggle');
toggleElements.forEach(el => {
  el.addEventListener('click', (e) => {
    e.currentTarget.classList.toggle('active'); // works correctly
  });
});
*/

document.querySelector("#profile_section .profile_con .profile_info .followers .follow").onclick = (e) => {
  el = e.target;
  mentorid = el.parentElement.parentElement.parentElement.firstElementChild.value;
  follow_mentor(e, mentorid);

}

function follow_mentor(e, mentorid) {
  let el = e.target;
  //console.log("clicked");


  let add_follower = new XMLHttpRequest();
  add_follower.addEventListener("readystatechange", function () {
    if (this.readyState == 4 && this.status == 200) {
      if (this.responseText) {
        el.classList.remove("follow");
        el.classList.add("following");
        el.innerHTML = '<i class="fa-solid fa-check"></i>&nbsp;Following';
        el.parentElement.firstElementChild.innerHTML = "<i class='fa-solid fa-wifi' style='transform: rotate(35deg)'></i>&nbsp;Followed By " + this.responseText;
        hide_mentor_suggetion(mentorid);

        document.querySelector("#profile_section .profile_con .profile_info .followers .following").onclick = (e) => {
          unfollow_mentor(e, mentorid);

        }

      }
    }
  });
  add_follower.open("POST", "/Follow", true);
  add_follower.setRequestHeader('Content-type', "application/x-www-form-urlencoded");
  add_follower.send("mentorid=" + mentorid);
}

function unfollow_mentor(e, mentorid) {
  el = e.target;
  let remove_follower = new XMLHttpRequest();
  remove_follower.addEventListener("readystatechange", function () {
    if (this.readyState == 4 && this.status == 200) {
      if (this.responseText) {
        el.classList.remove("following");
        el.classList.add("follow");
        el.innerHTML = 'Follow';
        el.parentElement.firstElementChild.innerHTML = "<i class='fa-solid fa-wifi' style='transform: rotate(35deg)'></i>&nbsp;Followed By " + this.responseText;
        show_mentor_suggetion(mentorid);
        document.querySelector("#profile_section .profile_con .profile_info .followers .follow").onclick = (e) => {
          follow_mentor(e, mentorid);

        }

      }
    }
  });
  remove_follower.open("POST", "/Unfollow", true);
  remove_follower.setRequestHeader('Content-type', "application/x-www-form-urlencoded");
  remove_follower.send("mentorid=" + mentorid);
}

function hide_mentor_suggetion(mentorid) {
  document.querySelectorAll(".expert_profile .profile_info a").forEach(el => {
    if (el.name == mentorid) {
      el.parentElement.parentElement.style.display="none";
    }
  });

}

function show_mentor_suggetion(mentorid) {
  document.querySelectorAll(".expert_profile .profile_info a").forEach(el => {
    if (el.name == mentorid) {
      el.parentElement.parentElement.style.display="flex";
    }
  });

}

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

















