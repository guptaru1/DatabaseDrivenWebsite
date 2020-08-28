//const cities = require(’cities’);
//const url = require(’url’);

//Works like http
const express = require('express');
const app = express();


//const weatherData = require('../utils/weatherData');

const hbs = require("hbs");
const path = require("path");

const port = process.env.PORT || 3000

//So you have access to the files
const publicStaticDirPath = path.join(__dirname, '../public')

const viewsPath = path.join(__dirname, '../templates/views');

const partialPath = path.join(__dirname, '../templates/partials');

const weatherData = require('../utils/weatherData');

app.set('view engine', 'hbs');
app.set('views', viewsPath);
hbs.registerPartials(partialPath);



//Use the css and js files there
app.use(express.static(publicStaticDirPath));

//home page
app.get('',(req,res) => {
    //Send file in form of html thats your indeex file
    res.render('index',{
        //Pass in the title to be wriiten in the html code
        title: 'Weather app'

    })
    //res.send(" THIS IS THE WEATHER APP");
});

//Gets with the weather url at the end of it
//localhost:3000/weather?address=london

app.get('/weather',(req,res) => {

    //res.send("Works with the api");


    const address = req.query.address
    console.log("WHAT THE USER TYPES IN");
    console.log(address);

    if (!address){
        //Breaks out of the if statement
        return res.send({
            error: "You must enter a city name to search"
        })
    }

    //Call the objectt which returns the weather data
    weatherData(address, (error, {temperature, description, cityName} = {}) => {
        if (error) {
            return res.send({
                error
            })
        }
        console.log(temperature, description, cityName);
        res.send({
            temperature,
            description,
            cityName
        })
    })


    //res.send("THIS IS TTHE WEATHER API CALL");
    /*weatherData(address, (error, {temperature, decription,cityName}) => {
        //Error returned from api call
        if (error){
           return res.send({
               error
           })
        }
        console.log(decription,cityName)
        res.send({
            temperature,
            description,
            cityName
        })
    })*/
});

//THIS ROUTEE DOESNTT EXISTT Static route comes at the end
app.get("*",(req,res) => {
    //send the 404 error page found
    res.render('error',{
        title: "page not found"
    })

});

app.listen(port, ()=> {
    console.log("THE SERVER IS WORKING ON port", port);
});


//const http = require('http');
//const app = http.createServer((request, response) =>  {
  //  var city, query;
//query = url.parse(request.url, true).query;
//if (query.zipCode) city = cities.zip_lookup(query.zipCode).city;
//else city = "not found"
//response.writeHead(200, {"Content-Type": "text/html"});
//response.write(`LOS ANGELES`);
//response.end();
//});

//app.listen(3000);

