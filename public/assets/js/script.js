$(document).ready(function () {
    $.ajax({
        url: 'https://api.currencylayer.com/list',
        method: 'GET',
        data: {
            access_key: '172321636d7560919c654addd89d7612' // Your API key
        },
        success: function (data) {
            let addedCurrencies = new Set();
            let options = [
                `<option value="" selected disabled>Select a Currency</option>`
            ];

            // Assuming the 'currencies' data structure is similar to the previous one
            $.each(data.currencies, function (code, currency) {
                options.push(`
                    <option value="${code}">
                        ${currency} (${code})
                    </option>`);
            });

            $('#fromCurrency, #toCurrency').html(options.join('')).select2({
                templateResult: formatCountry,
                templateSelection: formatCountry,
                placeholder: "Select a Currency",
                allowClear: true
            });
        },
        error: function (error) {
            console.log('Error fetching currency data:', error);
        }
    });

    function formatCountry(state) {
        if (!state.id) return state.text;
        return $(`<span>${state.text}</span>`);
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
                $('#result').html(`<p class="text-danger">Conversion failed. Try again.</p>`);
            }
        });
    });
});
