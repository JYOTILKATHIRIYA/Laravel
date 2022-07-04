if (document.querySelector(".accept") != null) {

  document.querySelectorAll(".accept").forEach(el => {
    el.onclick = () => {
      //document.body.style.backgroundColor = "green";
      let tr = el.parentElement.parentElement;
      let requested_email = el.parentElement.firstElementChild.value;

      let approve_request = new XMLHttpRequest();
      approve_request.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
          if (this.responseText == "APPROVED")
            tr.remove();

        }
      }
      approve_request.open("POST", "/close_request", true);
      approve_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      approve_request.send("email=" + requested_email + "&approval=1");

    }
  });
}

if (document.querySelector(".reject") != null) {

  document.querySelectorAll(".reject").forEach(el => {
    el.onclick = () => {
      //document.body.style.backgroundColor = "red";
      let tr = el.parentElement.parentElement;
      let requested_email = el.parentElement.firstElementChild.value;

      let approve_request = new XMLHttpRequest();
      approve_request.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
          if (this.responseText == "DELETED")
            tr.remove();

        }
      }
      approve_request.open("POST", "/close_request", true);
      approve_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      approve_request.send("email=" + requested_email + "&reject=1");

    }
  });
}

if (document.querySelector(".undo_approved") != null) {

  document.querySelectorAll(".undo_approved").forEach(el => {
    el.onclick = () => {
      //document.body.style.backgroundColor = "red";
      let tr = el.parentElement.parentElement;
      let requested_email = el.parentElement.firstElementChild.value;

      let approve_request = new XMLHttpRequest();
      approve_request.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
          if (this.responseText == "APPROVAL REMOVED")
            tr.remove();

        }
      }
      approve_request.open("POST", "/close_request", true);
      approve_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      approve_request.send("email=" + requested_email + "&undo_approval=1");

    }
  });

}

if (document.querySelector(".undo_rejected") != null) {

  document.querySelectorAll(".undo_rejected").forEach(el => {
    el.onclick = () => {
      //document.body.style.backgroundColor = "red";
      let tr = el.parentElement.parentElement;
      let requested_email = el.parentElement.firstElementChild.value;

      let approve_request = new XMLHttpRequest();
      approve_request.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
          if (this.responseText == "REJECTION REMOVED")
            tr.remove();

        }
      }
      approve_request.open("POST", "/close_request", true);
      approve_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      approve_request.send("email=" + requested_email + "&undo_rejected=1");

    }
  });

}

if (document.querySelector(".remove_rejected") != null) {

  document.querySelectorAll(".remove_rejected").forEach(el => {
    el.onclick = () => {
      //document.body.style.backgroundColor = "red";
      let tr = el.parentElement.parentElement;
      let requested_email = el.parentElement.firstElementChild.value;

      let approve_request = new XMLHttpRequest();
      approve_request.onreadystatechange = function () {
        if (this.status == 200 && this.readyState == 4) {
          if (this.responseText == "REMOVED")
            tr.remove();

        }
      }
      approve_request.open("POST", "/close_request", true);
      approve_request.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      approve_request.send("email=" + requested_email + "&remove_rejected=1");

    }
  });

}

if (document.querySelector(".send_mail_btn") != null) {
  document.querySelector(".send_mail_btn").onclick = (e) => {
    let btn = e.target;
    let messagebox = document.querySelector(".send_mail_txt");
    let message = messagebox.value;
    if (message.trim() == "") {
      alert("Please Write Something");
      return;
    }

    let users = document.querySelector(".checked_user").checked;
    let mentors = document.querySelector(".checked_mentor").checked;

    if (!(users || mentors)) {
      alert("Please Select the Recievers");
      return;
    }

    let send_mails = new XMLHttpRequest();
    send_mails.onreadystatechange = function () {
      if (this.status == 200 && this.readyState == 4) {
        alert("Emails Sended Successfully");
        messagebox.disabled = false;
        btn.disabled = false;
        messagebox.value = "";
      } else
        messagebox.disabled = true;
      btn.disabled = true;

    }
    send_mails.open("POST", "/SendMails", true);
    send_mails.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    send_mails.send("message=" + message + "&&users=" + users + "&&mentors=" + mentors);



  }
}

if (document.querySelector(".feedback_remove_btn") != null) {
  document.querySelectorAll(".feedback_remove_btn").forEach(
    el => {
      el.onclick = () => {

        let id = el.previousElementSibling.value;

        let remove_feedback = new XMLHttpRequest();
        remove_feedback.onreadystatechange = function () {
          if (this.status == 200 && this.readyState == 4) {
            
            el.parentElement.parentElement.remove();

          }
        }
        remove_feedback.open("POST","/RemoveFeedback",true);
        remove_feedback.setRequestHeader("Content-type","application/x-www-form-urlencoded");
        remove_feedback.send("id="+id);
      }
    }
  )
}