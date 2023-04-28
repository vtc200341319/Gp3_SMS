function validateForm() {
    const grade = document.forms.uploadForm.grade.value;
    const classSelection = document.forms.uploadForm.class.value;
    const subject = document.forms.uploadForm.subject.value;
    const file = document.forms.uploadForm.file.value;
    const deadline = document.forms.uploadForm.deadline.value;
    if (grade === "") {
        alert("Please select a grade.");
        return false;
    }

    if (classSelection === "") {
        alert("Please select a class.");
        return false;
    }

    if (subject === "") {
        alert("Please select a subject.");
        return false;
    }

    if (file === "") {
        alert("Please select a file to upload.");
        return false;
    }

    if (deadline === "") {
        alert("Please enter a deadline.");
        return false;
    }

    return true;
}

function deleteExercise(id) {
    if (confirm("Are you sure you want to delete this exercise?")) {
// Send an AJAX request to delete the exercise
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                // Reload the page to show the updated table
                location.reload();
            }
        };
        xhttp.open("POST", "delete.php", true);
        xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhttp.send("id=" + id);
    }
}


function editExercise(id) {
// Get the exercise data from the server via AJAX request
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // Display the exercise data in a form for editing
            var exercise = JSON.parse(this.responseText);
            document.getElementById("editForm").style.display = "block";
            document.getElementById("editGrade").value = exercise.grade;
            document.getElementById("editClass").value = exercise.class;
            document.getElementById("editSubject").value = exercise.subjectCode;
            document.getElementById("editDeadline").value = exercise.deadline;
            document.getElementById("editId").value = exercise.id;
        }
    };
    xhttp.open("GET", "getExercise.php?id=" + id, true);
    xhttp.send();
}

function updateExercise() {
// Send an AJAX request to update the exercise data
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            // Hide the edit form and reload the page to show the updated table
            document.getElementById("editForm").style.display = "none";
            location.reload();
        }
    };
    var id = document.getElementById("editId").value;
    var grade = document.getElementById("editGrade").value;
    var classSelection = document.getElementById("editClass").value;
    var subject = document.getElementById("editSubject").value;
    var deadline = document.getElementById("editDeadline").value;
    xhttp.open("POST", "updateExercise.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("id=" + id + "&grade=" + grade + "&class=" + classSelection + "&subject=" + subject + "&deadline=" + deadline);
}

function editExercise(id) {
// Create a new popup window
    var popup = window.open("", "editExercisePopup", "width=600,height=400");
    // set the URL of the edit form with the exercise ID as a query parameter
    popup.location.href = "edit_exercise.php?id=" + id;
    // Get the exercise data from the server
    var xhr = new XMLHttpRequest();
    xhr.onreadystatechange = function () {
        if (xhr.readyState == XMLHttpRequest.DONE) {
            if (xhr.status == 200) {
                // Create a form in the popup window with the exercise data
                var exercise = JSON.parse(xhr.responseText);
                var formHtml = "<h2>Edit Exercise</h2>";
                formHtml += "<form name='editForm' onsubmit='return validateEditForm()'>";
                formHtml += "<input type='hidden' name='exerciseID' value='" + exercise.exerciseID + "'>";
                formHtml += "<div class='form-group'>";
                formHtml += "<label for='grade'>Grade:</label>";
                formHtml += "<select name='grade' id='grade'>";
                formHtml += "<option value='1'" + (exercise.grade == 1 ? " selected" : "") + ">1st grade</option>";
                formHtml += "<option value='2'" + (exercise.grade == 2 ? " selected" : "") + ">2nd grade</option>";
                formHtml += "<option value='3'" + (exercise.grade == 3 ? " selected" : "") + ">3rd grade</option>";
                formHtml += "<option value='4'" + (exercise.grade == 4 ? " selected" : "") + ">4th grade</option>";
                formHtml += "<option value='5'" + (exercise.grade == 5 ? " selected" : "") + ">5th grade</option>";
                formHtml += "<option value='6'" + (exercise.grade == 6 ? " selected" : "") + ">6th grade</option>";
                formHtml += "</select>";
                formHtml += "</div>";
                formHtml += "<div class='form-group'>";
                formHtml += "<label for='class'>Class:</label>";
                formHtml += "<select name='class' id='class'>";
                formHtml += "<option value='A'" + (exercise.class == "A" ? " selected" : "") + ">Class A</option>";
                formHtml += "<option value='B'" + (exercise.class == "B" ? " selected" : "") + ">Class B</option>";
                formHtml += "<option value='C'" + (exercise.class == "C" ? " selected" : "") + ">Class C</option>";
                formHtml += "<option value='D'" + (exercise.class == "D" ? " selected" : "") + ">Class D</option>";
                formHtml += "</select>";
                formHtml += "</div>";
                formHtml += "<div class='form-group'>";
                formHtml += "<label for='subject'>Subject:</label>";
                formHtml += "<select name='subject' id='subject'>";
                formHtml += "<option value='Math'" + (exercise.subjectCode == "Math" ? " selected" : "") + ">Math</option>";
                formHtml += "<option value='Science'" + (exercise.subjectCode == "Science" ? " selected" : "") + ">Science</option>";
                formHtml += "<option value='English'" + (exercise.subjectCode == "English" ? " selected" : "") + ">English</option>";
                formHtml += "<option value='History'" + (exercise.subjectCode == "History" ? " selected" : "") + ">History</option>";
                formHtml += "</select>";
                formHtml += "</div>";
                formHtml += "<div class='form-group'>";
                formHtml += "<label for='question'>Question:</label>";
                formHtml += "<textarea name='question' id='question' rows='5'>" + exercise.question + "</textarea>";
                formHtml += "</div>";
                formHtml += "<div class='form-group'>";
                formHtml += "<label for='answer'>Answer:</label>";
                formHtml += "<textarea name='answer' id='answer' rows='5'>" + exercise.answer + "</textarea>";
                formHtml += "</div>";
                formHtml += "<input type='submit' value='Save'>";
                formHtml += "</form>";
                // Set the content of the popup window to the form HTML
                popup.document.body.innerHTML = formHtml;
            } else {
                // Display an error message if the request fails
                alert("Error retrieving exercise data");
            }
        }
// Set the content of the popup window to the form HTML
        popup.document.body.innerHTML = formHtml;
    }
}



function validateEditForm() {
// Validate the form data
    var grade = document.forms["editForm"]["grade"].value;
    var classname = document.forms["editForm"]["class"].value;
    var subject = document.forms["editForm"]["subject"].value;
    var deadline = document.forms["editForm"]["deadline"].value;
    var file = document.forms["editForm"]["file"].value;
    if (grade == "" || classname == "" || subject == "" || deadline == "" || file == "") {
        alert("Please fill in all fields!");
        return false;
    }

}

