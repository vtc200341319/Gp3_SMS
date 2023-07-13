$(document).ready(function () {
    $("#submit-username").on("click", function () {
        const username = $("#forgot-username").val();
        fetchSecurityQuestion(username);
    });

    $("#forgot-username").keypress(function (event) {
        if (event.keyCode == 13 || event.which == 13) {
            event.preventDefault();
            var username = $("#forgot-username").val();
            fetchSecurityQuestion(username);
        }
    });

    $("#submit-security-answer").on("click", function () {
        var username = $("#forgot-username").val();
        var answer = $("#security-answer").val();
        validateSecurityAnswer(username, answer);
    });

    $("#security-answer").keypress(function (event) {
        if (event.keyCode == 13 || event.which == 13) {
            event.preventDefault();
            var username = $("#forgot-username").val();
            var answer = $("#security-answer").val();
            validateSecurityAnswer(username, answer);
        }
    });

    $("#submit-new-password").on("click", function () {
        var username = $("#forgot-username").val();
        var newPassword = $("#new-password").val();
        var confirmPassword = $("#confirm-password").val();
        if (newPassword === confirmPassword) {
            resetPassword(username, newPassword, confirmPassword);
        } else {
            alert("New Password and Confirm Password do not match.");
        }
    });

    $("#confirm-password").keypress(function (event) {
        if (event.keyCode == 13 || event.which == 13) {
            event.preventDefault();
            var username = $("#forgot-username").val();
            var newPassword = $("#new-password").val();
            var confirmPassword = $("#confirm-password").val();
            if (newPassword === confirmPassword) {
                resetPassword(username, newPassword, confirmPassword);
            } else {
                alert("New Password and Confirm Password do not match.");
            }
        }
    });

    var securityQuestion = "<?php echo $user['securityQ']; ?>";
    if (securityQuestion == null || securityQuestion === '') {
        showAnotherPopup();
    }
});



function showPopup() {
    $("#popup").show();
}

function hidePopup() {
    $("#popup").hide();
}

function fetchSecurityQuestion(username) {
    console.log("fetchSecurityQuestion called with username:", username);
    if (username) {
        $.ajax({
            type: "POST",
            url: "fetch_security_question.php",
            data: {username: username},
            dataType: "json",
            success: function (response) {
                if (response.error) {
                    alert(response.error);
                } else {
                    $('#security-question').text(response.question);
                    $('#security-question-container').show();
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                alert("An error occurred. Please try again.");
            }
        });
    } else {
        alert("Please enter your username.");
    }
}

function validateSecurityAnswer(username, answer) {
    $.post("validate_security_answer.php", {username: username, answer: answer}, function (data) {
        if (data.success) {
            $("#reset-password-container").show();
        } else {
            alert("Security Answer is incorrect.");
        }
    }, "json");
}
function resetPassword(username, newPassword, confirmPassword) {
    const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

    if (!passwordPattern.test(newPassword)) {
        alert("Password must be at least 8 characters long and contain at least one uppercase letter, one lowercase letter, one number, and one special character.");
        $("#new-password").val("");
        $("#confirm-password").val("");
        return;
    }

    if (newPassword !== confirmPassword) {
        alert("New Password and Confirm Password do not match.");
        $("#new-password").val("");
        $("#confirm-password").val("");
        return;
    }


    $.ajax({
        url: "reset_password.php",
        type: "POST",
        dataType: "json",
        data: {
            username: username,
            newPassword: newPassword,
            confirmPassword: confirmPassword,
        },
        success: function (response) {
            if (response.success) {
                alert("Password has been reset successfully.");
                hidePopup();
                $("#forgot-username").val("");
                $("#security-answer").val("");
                $("#new-password").val("");
                $("#confirm-password").val("");
                $('#security-question').text("");
                $('#security-question-container').hide();
                $("#reset-password-container").hide();
            } else {
                alert(response.error);
            }
        },
        error: function () {
            alert("An error occurred while processing the request.");
        },
    });
}

function togglePasswordVisibility() {
    var passwordField = document.getElementById("password");
    var showPasswordCheckbox = document.getElementById("show-password");
    if (showPasswordCheckbox.checked) {
        passwordField.type = "text";
    } else {
        passwordField.type = "password";
    }
}

function showAnotherPopup() {
    $("#another-popup").show();
}

function hideAnotherPopup() {
    $("#another-popup").hide();
}
