function post(input_type){
    console.log("post type " + input_type);
    $.ajax({
        url: "php/dashboard.php", // URL of the main content HTML file
        type: 'POST',
        data:{type:input_type},
        input_type: "json",
        success: function(response){
            console.log("response");

            response_action(response);
        },
        error: function(xhr, status, error){
            console.error('AJAX Error:', status, error);
        }
    });
}

function response_action(json){
    console.log(json.response_type);
    switch(json.response_type){
        case 'log_out':
            loadMainContent(json.redirect);
            break;
    }
}

$(document).ready(function() {
    $("#uploadButton").click(function() {
        var formData = new FormData($("#imageForm")[0]);
        formData.append("type", "imgForm");
        console.log(formData);
        $.ajax({
            url: "php/dashboard.php",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.error('Request failed:', error);
            }
        });
    });
});

$(document).ready(function() {
    $("#addUserSubmit").click(function() {
        var formData = new FormData($("#addUser")[0]);
        formData.append("type", "addUser");
        var password = formData.get("password");
        var passwordAgain = formData.get("passwordAgain");
        formData.delete("password");
        formData.delete("passwordAgain");
        formData.append("hashedPassword", hashPassword(password));
        if(password != passwordAgain){
            const error = document.getElementById("warning");
            error.textContent = "Passwords are not the same!"; 
        }else{
            console.log(formData);
            $.ajax({
                url: "php/dashboard.php",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    const error = document.getElementById("warning");
                    error.textContent = response; 
                },
                error: function(xhr, status, error) {
                    console.error('Request failed:', error);
                }
            });
        }
    });
});

function updateDateToCurrent() {
    var dateInput = document.getElementById("date");
    if (dateInput) {
        dateInput.value = new Date().toISOString().split('T')[0];
    }
}

document.getElementById("prevDayButton").addEventListener("click", function() {
    // Call the function to update the date input to the previous day
    updateDateByDays(-1);
});

document.getElementById("nextDayButton").addEventListener("click", function() {
    // Call the function to update the date input to the next day
    updateDateByDays(1);
});


// Function to update date input by a specified number of days
function updateDateByDays(days) {
    console.log("updated by " + days + "days");
    var dateInput = document.getElementById("date");
    if (dateInput) {
        var currentDate = new Date(dateInput.value);
        currentDate.setDate(currentDate.getDate() + days);
        dateInput.value = currentDate.toISOString().split('T')[0];
    }
}

updateDateToCurrent();