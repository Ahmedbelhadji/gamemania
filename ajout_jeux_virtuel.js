function toggleText() {
    var checkBox = document.getElementById("myCheckbox");
    var text = document.getElementById("myText");
    if (checkBox.checked == true) {
        text.style.display = "block";
    } else {
        text.style.display = "none";
    }
}
const value = document.getElementById("value");
const input = document.getElementById("pi_input");
value.textContent = input.value;
input.addEventListener("input", (event) => {
    value.textContent = event.target.value;
});