function loadContent(page) {
  fetch(page + ".php")
      .then(response => {
          if (!response.ok) throw new Error("Page not found");
          return response.text();
      })
      .then(data => {
          document.getElementById("mainContent").innerHTML = data;
          history.pushState({ page: page }, "", "?page=" + page);
      })
      .catch(error => console.error("Error loading content:", error));
}

// ✅ Handle Back/Forward Button Correctly
window.addEventListener("popstate", function(event) {
  const page = event.state?.page || "home";
  loadContent(page);
});

// ✅ Load Correct Page on Refresh
document.addEventListener("DOMContentLoaded", function() {
  const urlParams = new URLSearchParams(window.location.search);
  const page = urlParams.get("page") || "home";
  loadContent(page);
});
