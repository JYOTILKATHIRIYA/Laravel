
document.querySelectorAll(".form_con form table textarea").forEach(el => {
  el.onkeypress = (e) => {
    if ((e.code == "NumpadEnter" || e.code == "Enter") && el.value.trim() != "") {
      if (e.target.rows < 7)
        e.target.rows += 1;
    }
  }
})


document.querySelectorAll(".form_con form table textarea").forEach(el => {
  el.onkeydown = (e) => {
    if (e.code == "Backspace") {

      let newline = el.value.lastIndexOf("\n");
      let len = el.value.length;

      if (e.target.rows > 4 && newline == len - 1)
        e.target.rows -= 1;
    }
  }

})