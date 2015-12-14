$(document).ready(function () {
    //Declare a variable to store the username entered by the user
    var username;
    
    //Declare a variable for a timer
    var timer;
    
    //Declare the minimum and maximum length of the username
    var minimumLength = 6;
    var maximumLength = 18;
    
    //Text errors to display
    var mininmumCharacterLength = "It has to be greater than 6 characters!";
    var maximumCharacterLength ="It needs to be less than 18 characters!";
    var doesNotHaveNumbersOrLetters = "It needs to contain numbers and letters!";
    
    //Triggers the event when the user stops typing
    $("#username").keyup(function (e) {
        //Clear the timer
        clearTimeout(timer);
        
        //Get the username entered in the form
        username = $(this).val();
        
        //Check the length of the username
        if (username.length < minimumLength && username.length >= 1) {
            $("#userresult").html(mininmumCharacterLength);
            username = null;
        }
        else if (username.length > maximumLength) {
            $("#userresult").html(maximumCharacterLength);
            username = null;
        }
        else if (username.length == 0) {
            $("#userresult").html("");
            username = null;
        }
        else {
            $("#userresult").html("");
            //Set timer a time out with the checkUsername function
            timer = setTimeout(function() {
                checkUserName(username);
            }, 0);
        }
    });
});

//Does a AJAX request to query the database for the username
function checkUserName(username) {
    $.post("checkusername.php", {username: username},
          function (result){
                //If the AJAX request returned zero
                if (result == 0) {
                    //Let the user know that the username entered is not avaliable
                    $("#userresult").html("Oops, that username isn't avaliable");
                }
                else {
                     //Let the user know that the username entered is avaliable
                    $("#userresult").html("It's Avaliable!");
                }
    });
}