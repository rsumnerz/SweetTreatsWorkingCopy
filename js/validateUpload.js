function validate(form){
      fail = validatefname(picUpload.fname.value)
      fail += validatelname(picUpload.lname.value)
      fail += validatephone(picUpload.phone.value)
      fail += validateemail(picUpload.email.value)
      
      if(fail=="") return true
      else{
        alert(fail);
        return false
      }
    }
    function validatefname(field){
      return (field=="") ? "Please enter your First Name.\n" : "";
    }
    function validatelname(field){
      return (field=="") ? "Please enter your Last Name.\n" : "";
    }
    function validatephone(field){
      return (field=="") ? "Please enter your Phone Number.\n" : "";
    }
    function validateemail(field){
      return (field=="") ? "Please enter your Email.\n" : "";
    }
    
