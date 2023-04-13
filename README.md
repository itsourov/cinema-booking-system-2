
# Cinema Booking System- Laravel

The purpose of this project was to create a software system that would allow users to book movie tickets, watch movies in virtual reality, movie recommendation, and order food at a cinema. To achieve this goal, we used modern software development techniques, including Agile methodology and Object-Oriented Programming.



## Installation

Clone the repo to your environment then run these command in your terminal

```bash
  compser install
```
if .env file doesn’t exist in the root directory run this command
```bash
  cp .env.example .env
  php artisan key:generate
```
then 
```bash
  php artisan serve
  npm install
  npm run dev
```
populate database with dummy data and default users
```bash
  php artisan migrate:fresh --seed
```
    