async function getWeather() {

    const city = document.getElementById("cityInput").value.trim();

    const loading = document.getElementById("loading");

    const error = document.getElementById("error");

    const weatherCard = document.getElementById("weatherCard");


    // Clear previous results

    error.style.display = "none";

    weatherCard.style.display = "none";


    // Validate city

    if (city === "") {

        error.textContent = "Please enter a city name.";

        error.style.display = "block";

        return;

    }


    loading.style.display = "block";


    try {

        /*
            First AJAX request:
            Get city coordinates.
        */

        const locationResponse = await fetch(
            `https://geocoding-api.open-meteo.com/v1/search?name=${encodeURIComponent(city)}&count=1&language=en&format=json`
        );


        if (!locationResponse.ok) {

            throw new Error("Unable to connect to weather service.");

        }


        /*
            Convert response into JSON.
        */

        const locationData = await locationResponse.json();


        if (!locationData.results ||
            locationData.results.length === 0) {

            throw new Error("City not found.");

        }


        const location = locationData.results[0];


        /*
            Second AJAX request:
            Get weather information.
        */

        const weatherResponse = await fetch(
            `https://api.open-meteo.com/v1/forecast?latitude=${location.latitude}&longitude=${location.longitude}&current=temperature_2m,relative_humidity_2m,wind_speed_10m&timezone=auto`
        );


        if (!weatherResponse.ok) {

            throw new Error("Unable to fetch weather data.");

        }


        /*
            Convert weather response into JSON.
        */

        const weatherData = await weatherResponse.json();


        /*
            Display JSON data on webpage.
        */

        document.getElementById("cityName").textContent =
            location.name + ", " + location.country;


        document.getElementById("temperature").textContent =
            weatherData.current.temperature_2m;


        document.getElementById("weatherDescription").textContent =
            "Current Weather";


        document.getElementById("wind").textContent =
            weatherData.current.wind_speed_10m + " km/h";


        document.getElementById("humidity").textContent =
            weatherData.current.relative_humidity_2m + "%";


        document.getElementById("latitude").textContent =
            location.latitude;


        document.getElementById("longitude").textContent =
            location.longitude;


        weatherCard.style.display = "block";


    } catch (err) {

        error.textContent = err.message;

        error.style.display = "block";

    }


    loading.style.display = "none";

}