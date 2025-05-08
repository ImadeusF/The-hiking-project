const sleepRedirect = () => {
    let countdownIndexElement = document.getElementById("countdownIndex");
    let countdownRegisterElement = document.getElementById("countdownRegister");
    let countdownLogin = document.getElementById("countdownLogin");

    let countdownElement = countdownIndexElement || countdownRegisterElement || countdownLogin;
    let countdown = 3;

    if (!countdownElement) {
        console.log('No countdown element found.');
        return;
    }

    let interval = setInterval(function () {
        countdown--;
        countdownElement.textContent = countdown;
        if (countdown <= 0) {
            clearInterval(interval);
            if (countdownElement === countdownIndexElement) {
                window.location.href = "../";
            } else if (countdownElement === countdownLogin) {
                window.location.href = "../login";
            }
            else if (countdownElement === countdownRegister) {
                window.location.href = "../register";
            }
        }
    }, 1000); // 1000 milliseconds = 1 second
};

//charging script after the DOM is loaded
document.addEventListener("DOMContentLoaded", function () {
    sleepRedirect();
});