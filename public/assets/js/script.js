$(document).ready(function () {
    $.ajax({
        url: 'https://restcountries.com/v3.1/all',
        method: 'GET',
        success: function (data) {
            let options = [
                `<option value="" selected disabled>Select a Currency</option>`
            ]; // Default empty option

            data.forEach(function (country) {
                if (country.currencies) {
                    $.each(country.currencies, function (code, currency) {
                        let flag = country.flags?.png || '';
                        let countryName = country.name.common;

                        options.push(`<option value="${code}" data-flag="${flag}" data-country="${countryName}">
                    ${countryName} (${code})
                </option>`);
                    });
                }
            });

            $('#fromCurrency, #toCurrency').html(options.join('')).select2({
                templateResult: formatCountry,
                templateSelection: formatCountry,
                placeholder: "Select a Currency",
                allowClear: true // Allow clearing selection
            });
        },
        error: function (error) {
            console.log('Error fetching country data:', error);
        }
    });

    function formatCountry(state) {
        if (!state.id) return state.text;
        let flagUrl = $(state.element).attr('data-flag') || '';
        return $(
            `<span><img src="${flagUrl}" width="20" height="15" style="margin-right:5px;"> ${state.text}</span>`
        );
    }

    $('#currencyForm').on('submit', function (e) {
        e.preventDefault();
        var amount = $('#amount').val();
        var fromCurrency = $('#fromCurrency').val();
        var toCurrency = $('#toCurrency').val();

        $.ajax({
            url: '/convert-currency',
            method: 'POST',
            data: {
                amount: amount,
                from: fromCurrency,
                to: toCurrency
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                $('#result').html(
                    `<p>${amount} ${fromCurrency} = <strong>${response.convertedAmount}</strong> ${toCurrency}</p>`
                );
            },
            error: function (error) {
                console.log('Error converting currency:', error);
            }
        });
    });
});