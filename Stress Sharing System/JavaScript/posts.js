document.querySelectorAll(".post .post_feedback .like .like_btn ").forEach(el => {
  el.onclick = () => {

    var post_status = el.innerText;
    let postid = el.parentElement.parentElement.firstElementChild.value;

    let post_feedback = new XMLHttpRequest();
    post_feedback.onreadystatechange = function () {
      if (this.status == 200 && this.readyState == 4) {
        el.parentElement.parentElement.previousElementSibling.lastElementChild.previousElementSibling.firstElementChild.innerText = this.responseText;
      }
    }


    if (post_status == "Like") {
      post_feedback.open("POST", "/LikePost", true);
      el.innerText = "Liked";
      el.classList.add("liked");
    }
    if (post_status == "Liked") {
      post_feedback.open("POST", "/UnlikePost", true);
      el.innerText = "Like";
    }
    post_feedback.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    post_feedback.send("postid=" + postid);

  }

})

document.querySelectorAll(".post .post_feedback .comment input[type='button']").forEach(el => {
  el.onclick = (e) => {
    let postid = el.parentElement.parentElement.firstElementChild.value;

    let commentNode = el.parentElement.firstElementChild;
    let comment = commentNode.value;
    if (comment.trim == "") return;
    //console.log(postid);

    let post_feedback = new XMLHttpRequest();
    post_feedback.onreadystatechange = function () {
      if (this.status == 200 && this.readyState == 4) {
        el.parentElement.parentElement.previousElementSibling.lastElementChild.lastElementChild.innerHTML = this.responseText;

      
        commentNode.value = "";
        if (sessionStorage.render_comments == "true") {
          render_comments(postid);
        }

      }
    }

    post_feedback.open("POST", "/NewComment", true);
    post_feedback.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    post_feedback.send("postid=" + postid + "&comment=" + comment);

  }
})


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