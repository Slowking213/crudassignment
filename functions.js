function signup(toadmin=false)
{
    var salt;

    $.ajax({
        url: '.env/salt.php',
        type: 'POST',
        data: {},
        success: function(response)
        {
            salt = response;

            // Now that we have the salt, proceed with the second AJAX call
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;
            var username = document.getElementById("username").value;
            
            if(email == "" || password == "" || username == "")
            {
                alert("Please fill in all fields");
                return;
            }else if(password.length < 8)
            {
                alert("Password must be at least 8 characters long");
                return;
            }
            if(!validateEmail(email))
            {
                alert("Please enter a valid email address");
                return;
            }

            $.ajax({
                url: 'validators/performsignup.php',
                type: 'POST',
                data: {
                    email: email,
                    password: password,
                    username: username,
                    salt: salt,
                    admin: toadmin
                },
                success: function(response)
                {
                    if(response == "success" && !toadmin)
                    {
                        window.location.href = "index.php";
                    }else if(!toadmin)
                    {
                        alert(response);
                    }
                    else
                    {
                        location.reload();
                    }
                }
            });
        },
        error: function() {
            alert('Error fetching salt');
        }
    });
}

function validateEmail(email)
{
    var re = /\S+@\S+\.\S+/;
    return re.test(email);
}

function login()
{
    var username = document.getElementById("username").value;
    var password = document.getElementById("password").value;

    if(username == "" || password == "")
    {
        alert("Please fill in all fields");
        return;
    }

    $.ajax({
        url: '.env/salt.php',
        type: 'POST',
        data: {},
        success: function(response)
        {
            salt = response;

            // Now that we have the salt, proceed with the second AJAX call
            
            if(password == "" || username == "")
            {
                alert("Please fill in all fields");
                return;
            }
            $.ajax({
                url: 'validators/checklogin.php',
                type: 'POST',
                data: {
                    password: password,
                    username: username,
                    salt: salt
                },
                success: function(response)
                {
                    window.location.href = "index.php";
                }
            });
        },
        error: function() {
            alert('Error fetching salt');
        }
    });
}

function addbook(id="")
{
    var title = document.getElementById("title").value;
    var author = document.getElementById("author").value;
    var genre = document.getElementById("genre").value;
    var isbn = document.getElementById("ISBN").value;
    var year = document.getElementById("year").value;
    var owner = "";
    try{
    var owner = document.getElementById("owner").value;
    }catch(e)
    {
        
    }
    if(owner == "")
    {
        owner = id;
    }


    if(title == "" || author == "" || genre == "" || isbn == "")
    {
        alert("Please fill in all fields");
        return;
    }

    $.ajax({
        url: 'operators/addbook.php',
        type: 'POST',
        data: {
            title: title,
            author : author,
            genre : genre,
            isbn : isbn,
            year : year,
            user_id : owner
        },
        success: function(response)
        {
            if(response == "success")
            {
                location.reload();
            }else
            {
                alert(response);
            }
        }});

}

function updateprofile(id,reload=true)
{
    var email = document.getElementById("new_email").value;
    var username = document.getElementById("new_username").value;

    if(email == "" || username == "")
    {
        alert("Please fill in all fields");
        return;
    }

    $.ajax({
        url: 'operators/updateprofile.php',
        type: 'POST',
        data: {
            email: email,
            username : username,
            id : id
        },
        success: function(response)
        {
            if(response == "success")
            {
                if(reload)
                {
                    location.reload();
                }
            }else
            {
                alert(response);
            }
        }});
}

function deletebook(element,id)
{
    var row = element.parentNode.parentNode.parentNode;
    row.parentNode.removeChild(row);
    $.ajax({
        url: 'operators/deletebook.php',
        type: 'POST',
        data: {
            id: id
        },
        success: function(response)
        {
            if(response == "success")
            {
                location.reload();
            }else
            {
                alert(response);
            }
        }});
}

function deleteuser(element,id)
{
    var row = element.parentNode.parentNode.parentNode;
    row.parentNode.removeChild(row);
    $.ajax({
        url: 'operators/deleteuser.php',
        type: 'POST',
        data: { id: id},
        success: function(response)
        {
            if(response == "success")
            {
                location.reload();
            }else
            {
                alert(response);
            }
        }});
}

function editbook(ISBN,Title,Author,Genre,Year,Owner)
{
    var form = document.createElement("form");
    form.method = "POST";
    form.action = "editbook.php";

    var input1 = document.createElement("input");
    input1.type = "text";
    input1.name = "ISBN";
    input1.value =  ISBN;
    form.appendChild(input1);

    var input2 = document.createElement("input");
    input2.type = "text";
    input2.name = "Title";
    input2.value = Title;
    form.appendChild(input2);

    var input3 = document.createElement("input");
    input3.type = "text";
    input3.name = "Author";
    input3.value = Author;
    form.appendChild(input3);

    var input4 = document.createElement("input");
    input4.type = "text";
    input4.name = "Genre";
    input4.value = Genre;
    form.appendChild(input4);

    var input5 = document.createElement("input");
    input5.type = "text";
    input5.name = "Year";
    input5.value = Year;
    form.appendChild(input5);

    var input6 = document.createElement("input");
    input6.type = "text";
    input6.name = "Owner";
    input6.value = Owner;
    form.appendChild(input6);

    var submitButton = document.createElement("input");
    submitButton.type = "submit";
    submitButton.value = "Submit";
    form.appendChild(submitButton);

    document.body.appendChild(form);

    form.submit();
}

function edituser(username,email,id)
{
    var form = document.createElement("form");
    form.method = "POST";
    form.action = "edituser.php";

    var input2 = document.createElement("input");
    input2.type = "text";
    input2.name = "username";
    input2.value = username;
    form.appendChild(input2);

    var input3 = document.createElement("input");
    input3.type = "text";
    input3.name = "email";
    input3.value = email;
    form.appendChild(input3);

    var input4 = document.createElement("input");
    input4.type = "text";
    input4.name = "id";
    input4.value = id;
    form.appendChild(input4);

    var submitButton = document.createElement("input");
    submitButton.type = "submit";
    submitButton.value = "Submit";
    form.appendChild(submitButton);

    document.body.appendChild(form);

    form.submit();
}