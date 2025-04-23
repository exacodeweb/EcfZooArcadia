// (validation côté client)
// Écoute la soumission du formulaire
document.getElementById("contactForm").addEventListener("submit", function(e) {
    let formValid = true;

    // Champ nom
    const nom = document.getElementById("nom");
    if (nom.value.trim() === "") {
        nom.classList.add("is-invalid");
        formValid = false;
    } else {
        nom.classList.remove("is-invalid");
    }

    // Champ email // Vérifie le champ email avec une expression régulière
    const email = document.getElementById("email");
    const emailRegex = /^[^@\s]+@[^@\s]+\.[^@\s]+$/;
    if (email.value.trim() === "" || !emailRegex.test(email.value)) {
        email.classList.add("is-invalid");
        formValid = false;
    } else {
        email.classList.remove("is-invalid");
    }

    // Champ message // Vérifie que le message n’est pas vide
    const message = document.getElementById("message");
    if (message.value.trim() === "") {
        message.classList.add("is-invalid");
        formValid = false;
    } else {
        message.classList.remove("is-invalid");
    }
    // Si une erreur est détectée, on empêche l’envoi du formulaire
    if (!formValid) {
        e.preventDefault(); // ⛔ Empêche l’envoi
    }
});
