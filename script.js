/*function login(event) {
    event.preventDefault();
    const username = document.getElementById("login-username").value;
    const password = document.getElementById("login-password").value;
  
    if (username && password) {
      document.getElementById("login-section").style.display = "none";
      document.getElementById("signup-section").style.display = "none";
      document.getElementById("home-nav").style.display = "flex";
      document.getElementById("home-section").style.display = "block";
      document.getElementById("shop-section").style.display = "none";
    } else {
      alert("Please enter both username and password.");
    }
  }
  
  function signup(event) {
    event.preventDefault();
    const username = document.getElementById("signup-username").value;
    const email = document.getElementById("signup-email").value;
    const password = document.getElementById("signup-password").value;
  
    if (username && email && password) {
      alert("Account created successfully! Please log in.");
      showLogin();
    } else {
      alert("Please fill in all the fields.");
    }
  }*/
  
  /*function showSignup() {
    document.getElementById("login-section").style.display = "none";
    document.getElementById("signup-section").style.display = "block";
  }
  
  function showLogin() {
    document.getElementById("signup-section").style.display = "none";
    document.getElementById("login-section").style.display = "block";
  }*/
document.getElementById("home-nav").style.display = "flex";
document.getElementById("home-section").style.display = "block";

function showShop() {
    document.getElementById("home-section").style.display = "none";
    document.getElementById("shop-section").style.display = "block";
    document.getElementById("aboutus-section").style.display = "none";
}
    
function showHome() {
    document.getElementById("shop-section").style.display = "none";
    document.getElementById("home-section").style.display = "block";
    document.getElementById("aboutus-section").style.display = "none";
}
    
function showAboutus() {
    document.getElementById("shop-section").style.display = "none";
    document.getElementById("home-section").style.display = "none";
    document.getElementById("aboutus-section").style.display = "block";
}

function logout() {
    document.getElementById("home-nav").style.display = "none";
    document.getElementById("home-section").style.display = "none";
    document.getElementById("shop-section").style.display = "none";
    document.getElementById("aboutus-section").style.display = "none";
    document.getElementById("login-section").style.display = "flex";
}
  
  
  