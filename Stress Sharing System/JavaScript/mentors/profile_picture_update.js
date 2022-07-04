
const pro_pic_update_btn=document.querySelector("#profile_picture_update .set_btn button");
pro_pic_update_btn.onclick=()=>{
let src=pro_pic_update_btn.parentElement.firstElementChild.value;
let email=pro_pic_update_btn.previousElementSibling.value;

let pro_pic_update=new XMLHttpRequest();
pro_pic_update.onreadystatechange=function(){
  if(this.readyState==4&&this.status==200){
    absolute_container.innerHTML = this.responseText;
    
  }
}
pro_pic_update.open("POST", "/UpdateProfilePicture", "true");
pro_pic_update.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
pro_pic_update.send("src=" + src + "&&email="+email);

}