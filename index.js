//code for the date
document.addEventListener("DOMContentLoaded", function() {
    const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
    const days = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"];

    const currentDate = new Date();
    const dayOfWeek = days[currentDate.getDay()];
    const month = months[currentDate.getMonth()];
    const dayOfMonth = currentDate.getDate();
    const year = currentDate.getFullYear();

    const formattedDate = `${dayOfWeek}, ${month}, ${dayOfMonth}, ${year}`;
    
    const currentDateElement = document.getElementById("currentDate");
    if (currentDateElement) {
        currentDateElement.textContent = formattedDate;
    }
});

//function for the log out button
function logout() {
    window.location.href = "login.php";
}