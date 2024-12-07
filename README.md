
# Exotic Rentals (Car Rental System) (Secure)

## Pages
- Home page: The page used to view FAQs, Browse rental information & view slideshow of cars.
- Login page: The page where current users can log in to their account by inputting their username and password.
- Signup page: This page allows new users to register an account by entering their name, email, and password.
- Luxury cars page: The page where users can view and book luxury cars.
- Sport cars page: The page where users can view and book sport cars.
- SUV cars page: The page where users can view and book SUV cars.
- Booking form page: This page allows users to enter rental information, including pick-up and drop-off times, vehicle specifications, and personal data.
- Bookings page: The page where individuals who are signed in can see their recent reservations.
- Completed booking page: The page to which users are routed after submitting a booking form successfully.
- Contact us page: The website where customers can submit a contact form to request support from the business.

## Tools & Technologies used
- HTML
- CSS
- PHP
- MYSQL
- XAMPP 
- JAVASCRIPT

## Login Page
This page provides a easy login form to validate registered users. It allows users to enter their username and password, and it queries the database to check if the username and password match. If there is a match, the user is redirected to the home page. Otherwise, an error message is displayed indicating that the provided credentials are invalid.
### Usage
1.	Enter your username and password in the form provided.
2.	Click on the "Login" button to submit the form.
3.	If your credentials match, you will be redirected to the home page.
4.	If your credentials do not match, an error message will be displayed.


## Sign Up Page
New users can register on a website using this sign-up page. A straightforward form with three input fields; username, password, and email is present on the website. In order to finish the registration procedure, the user must fill out all fields. After the user accepts the form, their login information will be compared to the sign-up table saved in the exotic-rentals MySQL database.
### Usage
- Your selected username, password, and email should be entered into the form.
- Click on the "Sign Up" button to submit the form.
- You will be sent to the "home.html" page if the registration process is successful.
- An error notice will appear on the page if the registration procedure fails.
- Note that the "user_data" cookie is also set by the PHP code to store the user's information. In 30 days, the cookie will expire. You can alter the value of the second parameter in the "setcookie" function to adjust the expiration time.

## Home Page
Exotic Rentals is a high-end car rental company that specialises in offering upscale supercars and luxurious vehicles for rent. This is their home page. The page has a navigational header, a slider showing the fleet of rental cars, a section outlining the rental process, and a footer with details about the business and its offerings.
### Usage
Simply open this page in a web browser to utilize it. Without the need for any additional configuration or software, the page should appear properly.

The page's header has a navigation menu that the user can utilize to access the various website sections. To return to the home page, click "Home" or the corporate logo. When "Our Fleet" is clicked, a dropdown menu with links to pages exhibiting the various car rental categories will appear. The "Contact Us" link will direct the user to a website where they may contact the business. A dropdown menu with links to the user's bookings and a "Sign Out" option may be shown by clicking the "user" icon. Some of the rental cars are displayed in the slider in the page's main body. To view other photographs, the user can click on the navigation links located beneath the slider.

The process of renting a supercar is highlighted and explained in the area below the slider. The consumer can rent a premium automobile from Exotic Rentals by following the three straightforward procedures provided.

The company and its services are described in the page's footer. A "Find a Luxury Car" section and a "For Egyptian Nationalities" and "For Foreign Nationalities" part is also included in the footer, providing details on where to find and how to hire a luxury car, as well as the prerequisites for renting a car for Egyptian citizens & Foreigners.
## Luxury Cars Page
This is a website for renting out luxury vehicles. The top of the page features a navigation bar with buttons for Home, Our Fleet, Contact Us, Bookings, and Sign Out. There are three choices for renting a premium, sport, or SUV vehicle under the "Our Fleet" drop-down menu. Each rental car card includes a photograph of the vehicle, its identification number, a description of the vehicle, the daily rental rate, and a reservation button.

### Usage
Open this website with a web browser like Microsoft Edge, Mozilla Firefox, or Google Chrome to utilise it. You can access other pages by clicking on the respective links in the navigation bar. Scroll down to check the rental vehicle cards to discover the available luxury car rentals. Each card features a photograph of the vehicle, its vehicle details, the daily rate, and a reservation button. You can reserve a car by clicking the "Book Now" button on the rental vehicle's card. This will take you to a booking form.
## Sport Cars Page
The page called Sport Car Rentals displays high-end sports cars that may be rented. It is made to offer a quick and effective way to browse the available cars, their specifications, and prices, as well as to reserve them. HTML and CSS were used in the page's development. While the CSS file is in charge of the styling and layout, the HTML file houses the page structure and content.
### Usage
Simply launch a web browser and open the HTML file to access the Sport Car Rentals page.  The Home page, Our Fleet page, Contact Us page, and Bookings page are all accessible from the page's navigation bar. When you select Our Fleet, a drop-down menu with links to SUV, Sport, and Luxury Car Rentals appears.

Four luxurious sports automobiles that are available for rental are shown in the Sport Car Rentals section. Each automobile has a picture, a name, information about its specs, such as its horsepower, seating capacity, and price per day. Click the "Book Now" button and complete the booking form to reserve a car.
## SUV Cars Page
A list of available luxury SUVs for rent is shown on the website SUV Car Rentals, along with information about each vehicle's features and daily rental rates. By clicking the "Book Now" button, which leads to a booking form, visitors to the page can also reserve any of the automobiles that are visible.
### Usage
Simply launch a web browser and open the accompanying HTML file to access the SUV Car Rentals page. The main page, the luxury vehicle rental area, the sports car rental section, and the SUV car rental section are just a few of the website's various sections that can be reached with ease thanks to the navigation bar at the top of the page.

Users can browse down the page to see the SUV vehicles that are available for rental, as well as additional information about each vehicle, including as its year, horsepower, and number of seats. By clicking the "Book Now" button, which leads to a booking form, users can reserve any of the automobiles that are visible.
## Booking Form Page
Customers can submit a reservation request through the website for the rental of exotic cars using this PHP script. It records the pick-up and drop-off times, the automobile chosen, the customer's name and contact information, as well as the username of the person making the booking request. This data is kept by the script in a MySQL database.
### Usage
- Enter the rental pickup date where you intend to start the renting process.
- Enter the rental dropoff date where you intend to end the renting process.
- Select the vehicle from the drop-down menu.
- Enter your full name for validation upon call confirmation (read FAQs).
- Enter your  phone number that you wish to be contacted on for documentation follow up & booking confirmation.

## Bookings Page
This bookings page shows the user's most recent reservations. The mysqli_connect() function is used to establish a connection to a MySQL database, and a cookie is used to obtain the user's login information. The required information is then retrieved to display on the webpage after it queries the database for bookings made by the user.
### Usage
- View the page to see the most recent bookings done by this specific user (logged on user)
- Copy Booking Reference Number incase the need of validation.

## Completed Booking Page
This PHP page shows a confirmation message after a successful automobile rental reservation. It is intended to be used along with a system for making automobile rentals that keeps booking data in a MySQL database.
### Usage
You need to set up a MySQL database called "exotic-rentals" and a table called "booking" in order to use this page. The following columns have to be in the table:
- Id (int)
- Customername(varchar)
- Phone(varchar)
- Car (varchar)
- Pickup(date)
- Dropoff (date)

Once the database is configured, you can use this PHP page to show the customer a confirmation message following a successful reservation. A confirmation message and a button to go back to the home page or reservations page are also displayed on the screen along with the most recent booking information that was obtained by connecting to the database.

## Contact Us Page
Exotic Rentals, a company that rents out luxury and supercars, is profiled on this website. Two major sections make up the page. The company, its offerings, and its fleet of vehicles are all described in the first part. Visitors can get in touch with the business in the second section using a contact form with questions, comments, or booking requests.
### Usage
Simply open the HTML file in a web browser to access the webpage.  Users can move through the website's various sections using the navigation bar at the top of the page. Users can access the contact form area by clicking the "Contact Us" link in the navigation bar.

Users can fill out the form in the "Contact Us" section to get in touch with Exotic Rentals. Users must fill out the form by providing their name, email address, and message. After the form is submitted, PHP is used to store the data in a MySQL database. Customers may also get in touch with the business through phone or email, as stated on the page.
