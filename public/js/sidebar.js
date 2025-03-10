const toggler = document.querySelector(".toggler-btn");
toggler.addEventListener("click", function () {
  document.querySelector("#sidebar").classList.toggle("collapsed");
});

// document.addEventListener("DOMContentLoaded", function () {
//   const sidebarLinks = document.querySelectorAll(".sidebar-dropdown .sidebar-item .sidebar-link");

//   sidebarLinks.forEach(link => {
//       link.addEventListener("click", function () {
//           // Remove active class from all links
//           sidebarLinks.forEach(item => item.classList.remove("active"));

//           // Add active class to clicked link
//           this.classList.add("active");

//           // Store active link in localStorage (so it stays active after refresh)
//           localStorage.setItem("activeLink", this.getAttribute("href"));
//       });
//   });

//   // Restore active link on page load
//   const savedActiveLink = localStorage.getItem("activeLink");
//   if (savedActiveLink) {
//       const activeLink = document.querySelector(`.sidebar-link[href="${savedActiveLink}"]`);
//       if (activeLink) {
//           activeLink.classList.add("active");
//       }
//   }
// });



