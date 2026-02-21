//--BEGIN COMMENT--
// these lines of code triggers sidebar collapse and expand
let sideBtn = document.getElementById("sideIcon");
let main = document.querySelector(".main");
sideBtn.addEventListener("click", function(event) {
    main.classList.toggle("collapsed")
})
//--END COMMENT--

//--BEGIN COMMENT--
// creates a modal window returning a response based on time input
function modal_window(text) {
    modalWindow.style.display = "flex";
    modalWindow.style.alignItems = "flex-end";
    modalWindow.style.justifyContent = "flex-end";
    confirm.textContent = text;
    close.onclick = function () {
        modalWindow.style.display = "none";
    }
    window.onclick = function() {
        if (event.target == modalWindow) {
            modalWindow.style.display = "none";
        }
    }
}
//--END COMMENT--

//--BEGIN COMMENT--
// these area insert rows of new data from the form submission
let submit = document.getElementById("submit");
let modalWindow = document.getElementById("modalWindow");
let close = document.getElementsByClassName("close")[0];
let confirm = document.getElementById("confirmAppointment");
submit.addEventListener("click", function(event) {
    event.preventDefault();

    let surname = document.getElementById("surname").value;
    let firstname = document.getElementById("firstname").value;
    let department = document.getElementById("department").value;
    let date = document.getElementById("date").value;
    let time = document.getElementById("time").value;
    let purpose = document.getElementById("purpose").value;

    // split_time splits the time targeting ':' character
    // new_time modifies the time format that will adhere to
    // hh:min AM/PM format 
    let split_time = time.split(":");
    let new_time = `${(split_time[0] > 12) ? split_time[0] - 12 : split_time[0]}:${split_time[1]} ${(split_time[0] > 12) ? 'PM' : 'AM'}`;

    // calculates the minutes in total for the set time
    let checkOpen = (Number(split_time[0]) * 60) + Number(split_time[1]);
    
    // if time is within 8:00am (min. 480) and 5:00pm (min. 1020)
    if (checkOpen > 480 && checkOpen < 1020) {
        let displayTable = document.getElementById("displayTable");
        let newRow = displayTable.insertRow();
        newRow.classList.add("bodyTable"); // add styling to the table
        newRow.insertCell(0).innerHTML = "IT12-34EF-56"
        newRow.insertCell(1).innerHTML = firstname + " " + surname;
        newRow.insertCell(2).innerHTML = department;
        newRow.insertCell(3).innerHTML = purpose;
        newRow.insertCell(4).innerHTML = date;
        newRow.insertCell(5).innerHTML = new_time;
        newRow.insertCell(6).innerHTML = "Pending";
        modal_window("Appointment Set Successfully."); // function call
    // if time is outside the set operating hours, no addition will be made
    } else {
        modal_window("Time Outside Operating Hours."); // function call
    }
})
// TODO: remove later when PHP is added.
//--END COMMENT--
