# Currency Converter

This is a simple Currency Converter application built using Laravel and jQuery. It allows users to select currencies, input an amount, and get real-time converted values using an external exchange rate API.

## Features

- Fetches currency data dynamically from the [REST Countries API](https://restcountries.com/v3.1/all)
- Uses Select2 for enhanced dropdowns with country flags
- Converts currency using an exchange rate API
- Built with Laravel and jQuery

## Installation


### Steps

1. **Clone the repository**

   ```sh
   git clone https://github.com/yourusername/currency-converter.git
   cd currency-converter
   ```

2. **Install Laravel dependencies**

   ```sh
   composer install
   ```

3. **Create ****`.env`**** file**

   ```sh
   cp .env.example .env
   ```

   Update database details in `.env` if needed.

4. **Generate application key**

   ```sh
   php artisan key:generate
   ```

5. **Run Laravel server**

   ```sh
   php artisan serve
   ```

6. **Visit the application**
   Open `http://127.0.0.1:8000/` in your browser.

## Usage

1. Enter the amount you want to convert.
2. Select the "From" and "To" currencies from the dropdown.
3. Click on "Convert" to get the converted amount.

## API Used

- [REST Countries API](https://restcountries.com/v3.1/all) - For country and currency details.
- [Exchange Rate API](https://www.exchangerate-api.com/) - For live currency exchange rates.

## Technologies Used

- **Laravel 10**
- **jQuery & AJAX** 
- **Bootstrap** 

## Contributing

Feel free to fork the repository and submit pull requests. Any contributions are welcome!
