var new_email=document.getElementById('new_email');
var new_username=document.getElementById('new_username');
var new_password=document.getElementById('new_password');
var curr_password=document.getElementById('curr_password');
var up_msg=document.getElementById('up_msg');

document.getElementById('change_cred_btn').onclick=()=>{
  if(!(new_email.value||new_username.value||new_password.value)){
    
    return;
  }
  
  if(!curr_password.value){
    up_msg.innerText="Enter Your Current Password";
    return;
  }

  let qstring="";
  if(new_username.value)qstring+=" username="+new_username.value;
  if(new_email.value)qstring+=" email="+new_email.value;
  if(new_password.value)qstring+=" password="+new_password.value;

  qstring+=" curr_password="+curr_password.value;

  qstring=qstring.trim();
  qstring=qstring.replaceAll(" ","&&");

  if(qstring.trim()!=null){
    console.log(qstring);
  
  let change_admin_cred=new XMLHttpRequest();
  change_admin_cred.onreadystatechange=function(){
    if(this.readyState==4&&this.status==200){
      up_msg.innerText=this.responseText;
      curr_password.value="";
    }
  }
  change_admin_cred.open("POST","/ChangeAdminCred",true);
  change_admin_cred.setRequestHeader("Content-type","application/x-www-form-urlencoded");
  change_admin_cred.send(qstring);

}

}