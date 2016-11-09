function getParameterByName(name) 
{
    var url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
        results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return '';
    return decodeURIComponent(results[2].replace(/\+/g, " "));
}

function setUsername(username)
{
    $("#usernameField").val(username);
}

function invalidUsername(isInvalid)
{
    if(isInvalid)
    {
        $("#usernameField").css('border-left', '4px solid #F44336');
    } else {
        $("#usernameField").css('border', '1px solid #A9A9A9');
    }
}

function checkUsername()
{
    if(!isRegistering) {invalidUsername(false); return;}

        $.ajax({
            type: "POST",
            url: "check.php",
            data: "username=" + $("#usernameField").val(),
            cache: false,
            success: function(response) {
                    invalidUsername(response == 1);
            }
        });
}

var isRegistering = false;

$(function(){
    var nameField = $("#nameField");
    var btn = $(".auth-form form input[type='submit']");
    var a = $(".auth-form form a");

    nameField.hide();

    function showLogin()
    {
            btn.attr('value', 'Login');
            btn.attr('name', 'login');
            a.text('Not registered? Sign Up!');

            nameField.hide();

            $(".auth-form form input").removeClass('top');
            $(".auth-form form input :visible :first").addClass('top');

            isRegistering = false;
            checkUsername();
    }

    function showRegister()
    {
            btn.attr('value', 'Register');
            btn.attr('name', 'register');
            a.text('Already a member? Sign In!');

            nameField.show();

            $(".auth-form form input").removeClass('top');
            $(".auth-form form input :visible :first").addClass('top');

            isRegistering = true;
            checkUsername();
    }

    $("#usernameField").on('keyup input', function(){
            checkUsername();
    });

    $(".auth-form form a").on('click', function(e){
        
        e.preventDefault();

        if($(".auth-form form input[type='submit']").val() == 'Login') {
            
            showRegister();

        } else {
            
            showLogin();
        }

        $("#errorLabel").text("");
    });

    if(getParameterByName("error") === '1') {
        $("#errorLabel").text("Wrong credentials!");
    } else if (getParameterByName("error") === '2') {
        $("#errorLabel").text("Oops! There was an error registering you.");
        showRegister();
    } else {
        $("#errorLabel").hide();
    }
});