document.addEventListener("DOMContentLoaded", function () {

    const form =
        document.getElementById("registrationForm");


    if (!form) {
        return;
    }


    form.addEventListener("submit", function (event) {

        const name =
            document.getElementById("name").value.trim();

        const email =
            document.getElementById("email").value.trim();

        const password =
            document.getElementById("password").value;

        const confirmPassword =
            document.getElementById("confirm_password").value;


        /* Name validation */

        if (name.length < 3) {

            alert(
                "Name must contain at least 3 characters."
            );

            event.preventDefault();

            return;
        }


        /* Password validation */

        if (password.length < 6) {

            alert(
                "Password must contain at least 6 characters."
            );

            event.preventDefault();

            return;
        }


        /* Confirm password */

        if (password !== confirmPassword) {

            alert(
                "Passwords do not match."
            );

            event.preventDefault();

            return;
        }


        /* Email validation */

        const emailPattern =
            /^[^\s@]+@[^\s@]+\.[^\s@]+$/;


        if (!emailPattern.test(email)) {

            alert(
                "Please enter a valid email address."
            );

            event.preventDefault();

            return;
        }

    });

});