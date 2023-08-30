function home_function(){
    window.location.href="admin_home.php";
}

function view_emp(){
    window.location.href="admin_view_emp.php";
}

function view_senior(){
    window.location.href="admin_view_senior.php";
}

function view_requests(){
    window.location.href="admin_requests.php";
}

function scan_function(){
    window.location.href="admin_scan.php";
}

function logout_function(){
    window.location.href="../admin_logout.php";
}


function reject_function() {
    window.location.href="../reject_senior.php";
}

function add_empFunction() {
    window.location.href="create_emp.php";
}

function event_logs() {
    window.location.href="event_log_emp.php";
}


//this is for the theme selection

const colorThemes = document.querySelectorAll('[name="theme"]');

//store theme to local storage
const storeTheme = function(theme) {
    localStorage.setItem("theme", theme);
};

//this will retrieve the them from local storage
const retrieveTheme = function() {
    const activeTheme = localStorage.getItem("theme");
};

colorThemes.forEach((themeOption) => {
    themeOption.addEventListener("click", () => {
        storeTheme(themeOption.id);
    });
});