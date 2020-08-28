//Front eend reeposnisble for calling the api using jquery
//Update the datta
console.log("JAVASCRIPT");

var fetchWeather = "/weather"

const weatherForm = document.querySelector('form');
//Use it to call c clicker functiton oni
const search = document.querySelector('input');

const weatherIcon = document.querySelector('.weatherIcon i')//i represents the icon
const weatherCondition  = document.querySelector('.weatherCondition');

const tempElement  = document.querySelector('.temperature span');
const locationElement  = document.querySelector('.place');
const dateElement  = document.querySelector('.date');

const months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

dateElement.textContent = new Date().getDate() + " " + months[new Date().getMonth()].substring(0,3) + " " + new Date().getFullYear();

//When you press tthe search butotn on thee form the listener is called
weatherForm.addEventListener('submit', (event) =>{
    event.preventDefault();
    //Gets what you typed in the search box
    console.log("serach");
    console.log(search.value);
    //Unttil the data isn't loaded up
    locationElement.textContent = "Loading" ;
    tempElement.textContent = "";
    dateElement.textContent = "";
    const locationurl = fetchWeather + "?address=" + search.value;
    console.log(locationurl);

    //Fetch the api data based on
    fetch(locationurl).then(response =>{
        //Convert it into json form
        response.json().then(data => {
            //This returns the ttemperate, decripttion and citty name
            console.log(data)
            if (data.error){
                locationElement.textContent = data.error ;
                tempElement.textContent = "";
                dateElement.textContent = "";
            } else{
                //Display the data
                locationElement.textContent = data.cityName ;
                //sHOW THE DEGREE HERE

                tempElement.textContent = data.temperature + String.fromCharCode(176) + "C";
                dateElement.textContent = data.description.toUpperCase();
            }
        })
            console.log(response);
    });

})

