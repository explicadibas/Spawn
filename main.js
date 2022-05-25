const elemsDropdown = document.querySelectorAll(".dropdown-trigger");
const instancesDropdown = M.Dropdown.init(elemsDropdown, {
    coverTrigger: false
});

$(".dropdown-button").dropdown({ hover: true, constrainWidth: false });

document.getElementById("file").onchange = function() {
    document.getElementById("form").submit();
};