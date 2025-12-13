# 🍕 Pizza Configurator

A dynamic web application that allows users to customize and order their perfect pizza with various options for dough, ingredients, and special requests.

## 🚀 Features

- **Dough Selection**: Choose from different types of pizza dough
  - Normal (€10)
  - Whole Wheat (€13)
  - Kamut (€15)

- **Basic Ingredients** (included in base price)
  - Tomato Sauce (€2)
  - Mozzarella (€3)

- **Extra Toppings** (additional cost)
  - Mushrooms (€1.50)
  - Ham (€3)
  - Salami (€2)
  - Spicy Salami (€5)
  - Wurstel (€2)

- **Customization Options**
  - Add special notes for the cook
  - Select preferred pick-up time
  - Choose pizza box color

- **Real-time Price Calculation**: Automatically updates the total cost as you customize your pizza
- **Configuration Summary**: View a detailed recap of your pizza configuration

## 🖥️ Preview

<img width="982" height="906" alt="image" src="https://github.com/user-attachments/assets/1afe6746-a7e6-4a8a-b622-19534eb216a8" />

## 🛠️ Requirements

- PHP 7.0 or higher
- Web server (Apache/Nginx) with PHP support
- Modern web browser

## 🚀 Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/yourusername/php-pizza-configurator.git
   ```

2. Place the files in your web server's root directory (e.g., `htdocs` or `www`)

3. Access the application through your web browser:
   ```
   http://localhost/php-pizza-configurator/
   ```

## 📝 Usage

1. Select your preferred dough type
2. Choose your basic ingredients (at least one required)
3. Add any extra toppings you'd like
4. Add special instructions for the cook (optional)
5. Select your preferred pick-up time
6. Choose a box color
7. Review your order in the Configuration Recap section
8. The total price updates automatically as you make selections

## 📋 Configuration

The application uses PHP sessions to maintain your pizza configuration. All configurations are stored server-side during your session.

## 📝 License

This project is open source and available under the [MIT License](LICENSE).

## 🙏 Credits

- Developed with ❤️ using PHP and Bootstrap 5
- Icons by Twemoji

---

*Note: This is a demo application. Actual pizza ordering functionality is not implemented in this version.*
