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
  
  
  