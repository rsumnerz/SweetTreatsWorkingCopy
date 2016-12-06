function validate(form){
      fail = validatefname(orderform.first_name.value)
      fail += validatelname(orderform.last_name.value)
      fail += validatephone(orderform.phone.value)
      fail += validateemail(orderform.email.value)
      fail += validatedate(orderform.pickUpDate.value)
      fail += validateorder(orderform.cakeSize.value, orderform.cakeFav.value, orderform.cakeFil.value, orderform.cakeIce.value, orderform.cupCake.value, orderform.cupFav.value, orderform.cupIce.value)
     
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
    function validatedate(field){
      return (field=="")? "Please enter your Pick up Date and Time.\n" : "";
    }
    function validateorder(cakeSize, cakeFav, cakeFil, cakeIce, cupCake,cupFav,cupIce){
      if (cakeSize == "" && cupCake=="") return "You must select to order a cake or cupcakes.\n";
      
      else if (cakeSize != "" && cupCake != "") return "You must choose either cake or cupcakes for this order.\n";
      else if(cakeSize != "" && cupCake ==""){
        if(cakeFav == "" || cakeFil =="" || cakeIce =="")return"You must select all 3 options \n Cake Flavor \n Cake Filling and \n Cake Icing\n";
        else return "";
      }
      else if (cakeSize == "" && cupCake !=""){
        if(cupFav=="" || cupIce =="")return"You must select both options \n Cupcake Flavor and \n Cupcake Icing.\n"
        else return "";
      }
    }


      function changeSelect(){
        if (document.getElementById("cakeSize").value!="customSheet"){
          document.getElementById("numPeople").value ="";
          document.getElementById("numPeople").setAttribute("disabled", true);

        }else document.getElementById("numPeople").removeAttribute("disabled");
      }  