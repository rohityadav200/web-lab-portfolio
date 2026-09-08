document.addEventListener("DOMContentLoaded", function () {

    const form = document.querySelector("form");

    if (form) {

        form.addEventListener("submit", function (event) {

            const name = document.getElementById("name");
            const email = document.getElementById("email");
            const phone = document.getElementById("phone");

            if (!name || !email || !phone) {
                return;
            }

            const nameValue = name.value.trim();
            const emailValue = email.value.trim();
            const phoneValue = phone.value.trim();

            if (nameValue.length < 2) {
                alert("Name must contain at least 2 characters.");
                name.focus();
                event.preventDefault();
                return;
            }

            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (!emailPattern.test(emailValue)) {
                alert("Please enter a valid email address.");
                email.focus();
                event.preventDefault();
                return;
            }

            const phonePattern = /^[0-9]{10}$/;

            if (!phonePattern.test(phoneValue)) {
                alert("Phone number must contain exactly 10 digits.");
                phone.focus();
                event.preventDefault();
                return;
            }

        });

    }


    /* Contact Search */

    const searchInput = document.getElementById("searchInput");
    const table = document.getElementById("contactsTable");

    if (searchInput && table) {

        searchInput.addEventListener("input", function () {

            const searchText = this.value.toLowerCase();

            const rows = table.querySelectorAll("tbody tr");

            rows.forEach(function (row) {

                const rowText = row.textContent.toLowerCase();

                if (rowText.includes(searchText)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }

            });

        });

    }

});