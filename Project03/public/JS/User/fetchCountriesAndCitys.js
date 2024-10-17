
 document.addEventListener('DOMContentLoaded', function() {
    fetch('https://countriesnow.space/api/v0.1/countries')
        .then(response => response.json())
        .then(data => {
            const countries = data.data;
            const countrySelect = document.getElementById('country');

            countries.forEach(country => {
                let option = document.createElement('option');
                option.value = country.country; 
                option.textContent = country.country; 
                countrySelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching countries:', error));
});

document.getElementById('country').addEventListener('change', function() {
    let countryName = this.value;

    const citySelect = document.getElementById('city');
    citySelect.innerHTML = '<option selected disabled >Select City...</option>';

    if (countryName) {
        fetchCitiesForCountry(countryName);
    }
});


function fetchCitiesForCountry(countryName) {
    fetch('https://countriesnow.space/api/v0.1/countries/cities', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                country: countryName,
            }),
        })
        .then(response => response.json())
        .then(data => {
            const cities = data.data;
            const citySelect = document.getElementById('city');

            cities.forEach(city => {
                let option = document.createElement('option');
                option.value = city; 
                option.textContent = city; 
                citySelect.appendChild(option);
            });
        })
        .catch(error => console.error('Error fetching cities:', error));
}