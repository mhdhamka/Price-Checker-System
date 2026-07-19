function limitCheckboxes(max) {
            var checkboxes = document.querySelectorAll('input[type="checkbox"]');
            checkboxes.forEach(function(checkbox) {
                checkbox.addEventListener('change', function() {
                    var checkedCount = document.querySelectorAll('input[type="checkbox"]:checked').length;
                    if (checkedCount >= max) {
                        checkboxes.forEach(function(box) {
                            if (!box.checked) {
                                box.disabled = true;
                            }
                        });
                    } else {
                        checkboxes.forEach(function(box) {
                            box.disabled = false;
                        });
                    }
                });
            });
        }

        function validateSearch() {
            const searchInput = document.getElementById('searchtextbox').value.trim();
            if (searchInput === "") {
                alert("Please enter a search term.");
                return false;
            }
            return true;
        }

        function validateCompare() {
            const checkboxes = document.querySelectorAll('input[type="checkbox"]:checked');
            if (checkboxes.length < 2 || checkboxes.length > 3) {
                alert("Please select 2 or 3 items to compare.");
                return false;
            }
            return true;
        }

        window.onload = function() {
            limitCheckboxes(3); // Set the limit to 3
        }

        // Ensure form submission with Enter key works
        document.getElementById("searchtextbox").addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                document.getElementById("search-btn").click();
            }
        });

document.querySelector('.custom-btn').style.marginRight = 'auto';