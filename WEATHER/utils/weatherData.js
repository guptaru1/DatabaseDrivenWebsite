const request = require('request');
//Call the api object in here
const constants = require('../config');

//create  a function that does a callback
//fetched informattion from tthe api server

const weatherData = (address, callback) => {
    //encodeuricomponent is a builtt in function
    console.log("ADDRESS");
    console.log(address);
    const url = constants.openWeatherMap.BASE_URL + "lahore" + '&appid=' + constants.openWeatherMap.SECRET_KEY;
    //encodeURIComponent(address)
    console.log(url);
    request({url, json:true}, (error, {body})=> {
        if(error) {
            callback("Can't fetch data from open weather map api ", undefined)
        }
         else {

            callback(undefined, {
                temperature: body.main.temp,
                description: body.weather[0].description,
                cityName: body.name
            })
            //gets the information you want from the weather api

        }
    })
}






module.exports = weatherData();