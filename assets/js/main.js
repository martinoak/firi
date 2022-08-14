document.addEventListener("DOMContentLoaded", loadAfterDom);

function loadAfterDom() {
    const form = document.getElementById("form")
    form.addEventListener("submit", async (event) => {
        const mailSuccess = document.getElementById("mailSuccess")
        event.preventDefault();
        const response = await fetch("actions/action.php", {
            method: "POST",
            body: new FormData(form)
        })
        if (response.ok) {
            mailSuccess.classList.add("color-secondary");
            mailSuccess.innerText = "";
            mailSuccess.innerText = "Email byl úspěšně odeslán!";
        } else {
            mailSuccess.classList.add("color-primary");
            mailSuccess.innerText = "";
            mailSuccess.innerText = "Při odesílání e-mailu nastala chyba!";
        }
    });
}