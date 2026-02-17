 function checkForm(form) {
 
            // checks to make sure no fields are empty
            if (form.firstname.value == "" || form.lastname.value == "" || form.username.value == "" || form.passwordfield.value == ""
                || form.passwordcheck.value == "" || form.emailfield.value == "") {
                alert("Error: One of the fields is empty! Do not leave any fields empty!");
                return false;
            }
 
            // checks to make sure passwords match
            if (form.passwordfield.value != form.passwordcheck.value) {
                alert("Error: passwords do not match!");
                form.passwordfield.focus();
                return false;
            }
 
            // checks to make sure emails match
         
 
            // regular expressions needed
            var name = /^[A-z]+$/;
            var pass = /^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/;
            var email = /^([0-9a-zA-Z]([-\.\w]*[0-9a-zA-Z])*@([0-9a-zA-Z][-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9})$/;
 
            // validate firstname, lastname, and username
            if (!name.test(form.firstname.value) || !name.test(form.lastname.value) || !name.test(form.username.value)) {
                alert("Error: Firstname, lastname, username contains invalid characters!");
                return false;
            }
 
            // validate password
            if (!pass.test(form.passwordfield.value)) {
                alert("Error: Password must contain an intiger");
                return false;
            }
 
            // validate email
            if (!email.test(form.emailfield.value)) {
                alert("Error: mail not valid");
                return false;
            }
 
            // all tests passed, submit form
            return alert('successful submit');
        }
