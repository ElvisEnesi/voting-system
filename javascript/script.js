// script file!!!!!!!!!!!

// drop down function
// declare variable
const dropdownButtons = document.querySelectorAll('.dropbtn');
// loop through buttons and add click event listener to each
dropdownButtons.forEach(button => {
  button.addEventListener('click', function() {
    const dropdownContent = this.parentNode.querySelector('.dropdown_links');
    const isOpen = dropdownContent.style.display === 'flex';
    // Close ALL open dropdowns first
    document.querySelectorAll('.dropdown_links').forEach(content => {
      content.style.display = 'none';
    });
    // If the one we clicked wasn't already open, open it now
    if (!isOpen) {
      dropdownContent.style.display = 'flex';
    }
  });
});
// Window click listener to close dropdowns when clicking outside
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn') && !event.target.closest('.dropdown_links')) {
    const dropdowns = document.querySelectorAll('.dropdown_links');
    dropdowns.forEach(content => {
      if (content.style.display ='flex') {
        content.style.display ='none';
      }
    });
  }
};

// side nav bar active
const sideNavLinks = document.querySelectorAll(".links_side");
// loop through to get all links to function
sideNavLinks.forEach(div => {
  div.addEventListener('click', function (event) {
    // Prevent the default anchor link behavior (e.g., jumping to top of page)
    event.preventDefault;
    // check if there is any active link & remove it
    const currentActive = document.querySelector('.active');
    if (currentActive) {
      currentActive.classList.remove('active');
    }
    // add the active to link
    div.classList.add('active');
  });
});


// side bar function
// declare variables
let sideBar = document.querySelector("#aside");
let openSideBar = document.querySelector(".opensidebar");
let closeSideBar = document.querySelector(".closesidebar");
// add event listers functions
openSideBar.addEventListener("click", function showSide() {
  sideBar.style.left = "0px";
  openSideBar.style.display = "none";
  closeSideBar.style.display = "flex";
})
// close add event listers functions
closeSideBar.addEventListener("click", function closeSide() {
  sideBar.style.left = "-300px";
  openSideBar.style.display = "flex";
  closeSideBar.style.display = "none";
})


// media header query
// declare variables
let navbar = document.getElementsByClassName("nav")[0];
let openNav = document.getElementsByClassName("openNav")[0];
let closeNav = document.getElementsByClassName("closeNav")[0];
// function to open nav
function open_navigation() {
  navbar.style.right = "0px";
  openNav.style.display = "none";
  closeNav.style.display = "block";
}
// add event listeners
openNav.addEventListener('click', open_navigation);
closeNav.addEventListener('click', function() {
  navbar.style.right = "-300px";
  openNav.style.display = "block";
  closeNav.style.display = "none";
});


// newsletter form!!!!!!!!!!!!!!
// Select the modal and close button elements
const newsletter = document.getElementsByClassName("newsletter")[0];
const close_newsletter = document.querySelector(".close_newsletter");
// Function to open the modal
function openPopup() {
    newsletter.style.display = "flex"; // Use flex to center content easily
}
// Function to close the modal
function closePopup() {
    newsletter.style.display = "none";
}
// Event listeners
// Show the popup after 5 seconds when the page loads
window.addEventListener("load", () => {
    setTimeout(openPopup, 5000); // 5000 milliseconds = 5 seconds
});
// Close the modal when the close button is clicked
close_newsletter.addEventListener("click", closePopup);
// Close the modal if the user clicks anywhere outside of the content
window.addEventListener("click", (event) => {
    if (event.target !== newsletter) {
        //closePopup();
        newsletter.classList.add("expand_newsletter");
    }
});


// show password function
// declare variable 
let check =  document.getElementById("check");
function show_login_key() {
  let password = document.getElementById("password");
  if (password.type === "password") {
    password.type = "text";
  } else {
    password.type = "password";
  }
}


