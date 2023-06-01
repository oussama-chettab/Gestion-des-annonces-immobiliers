function Show(){
  let password = document.getElementById('password');
  var eyeIcon = document.querySelector(".show-password i");
  if(password.type === "password" ){
    
    password.type = "text";
    eyeIcon.classList.remove("fa-eye");
    eyeIcon.classList.add("fa-eye-slash");

  }else{

    password.type = "password";
    eyeIcon.classList.remove("fa-eye-slash");
    eyeIcon.classList.add("fa-eye");
    
  }
}