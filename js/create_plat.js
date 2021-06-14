function change_title_color() {
    var title = document.getElementById("password-entry");
    if (pass.type === "password") {
        pass.type = "text";
    } else {
        pass.type = "password";
    }
}