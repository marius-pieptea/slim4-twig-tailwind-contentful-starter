document.addEventListener("DOMContentLoaded", function () {
  const cookieConsent = document.getElementById("cookie-consent");
  const acceptButton = document.getElementById("cookie-consent-accept");
  const rejectButton = document.getElementById("cookie-consent-reject");

  // Check if user has already made a choice
  const consentChoice = localStorage.getItem("cookieConsent");

  // If no choice has been made yet, show the banner
  if (!consentChoice) {
    setTimeout(() => {
      cookieConsent.classList.remove("translate-y-full");
    }, 1000);
  }

  // Handle accept button click
  acceptButton.addEventListener("click", function () {
    localStorage.setItem("cookieConsent", "accepted");
    cookieConsent.classList.add("translate-y-full");

    // Here you could initialize analytics or other cookie-dependent services
    console.log("Cookies accepted");
  });

  // Handle reject button click
  rejectButton.addEventListener("click", function () {
    localStorage.setItem("cookieConsent", "rejected");
    cookieConsent.classList.add("translate-y-full");

    // Here you could disable any tracking cookies
    console.log("Cookies rejected");
  });
});
