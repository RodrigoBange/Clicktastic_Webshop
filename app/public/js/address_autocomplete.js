let countries = [];
const countryDropdown = document.querySelector("#country");
const countryDropDownShip = document.querySelector("#countryShip");

function fetchCountries() {
    fetch("https://restcountries.com/v3.1/all")
        .then((response) => response.json())
        .then((data) => {
            countries = data.map((x) => x.name.common);
            countries.sort();
            loadData(countries, countryDropdown);
            if (countryDropDownShip !== null) {
                loadData(countries, countryDropDownShip);
            }
        });
}

function loadData(data, element) {
    if (data) {
        element.innerHTML = "";
        let innerElement = "";
        data.forEach((item) => {
            innerElement += `<option>${item}</option>`;
        });

        element.innerHTML = innerElement;
    }
}

fetchCountries();
