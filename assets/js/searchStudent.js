// Ensure form submission with Enter key works
        document.getElementById("searchtextbox").addEventListener("keypress", function(event) {
            if (event.key === "Enter") {
                event.preventDefault();
                document.getElementById("search-btn").click();
            }
        });

        // Validate search form
        function validateSearch() {
            const searchInput = document.getElementById('searchtextbox').value.trim();
            if (searchInput === "") {
                alert("Please enter a search term.");
                return false;
            }
            return true;
        }