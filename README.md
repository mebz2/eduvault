# README

## Table of Contents


- [README](#readme)
  - [Table of Contents](#table-of-contents)
  - [Setup](#setup)
    - [Step 1](#step-1)
    - [Step 2](#step-2)
    - [Step 3](#step-3)
    - [Step 4](#step-4)
    - [Step 5](#step-5)
  - [Technologies](#technologies)
  - [Todo](#todo)
- [Functions](#functions)


## Setup

### Step 1
- Download and install [xampp](https://www.apachefriends.org/download.html).
- Make sure you have a browser

### Step 2
- You need to create a mysql database using xampp
- Go to the xampp control panel and start apache and mysql

### Step 3
- After you install xampp and setup the database go to the directory you installed xampp and go to the htdocs directory.

For Linux:
```bash
cd /opt/lampp/htdocs
```
### Step 4
- Clone the repository into the htdocs folder

### Step 5
- Go to your browser and paste the following
```
http://localhost/eduvault
```
- You can use the website as you please, **have fun :)**

## Technologies 
- HTML
- CSS
- PHP
- JS
- MySql
- XAMPP
## Todo
- [ ] Design the database
- [x] Make the name of the student that logged in appear on the homepage
- [x] Instead of sign in and out buttons havea an account button to logout
- [ ] Design account page to accept invites and logout
- [ ] Design study group page
  - [ ] The page to show every group you are in
  - [ ] popup to create a group
  - [ ] pages inside each group
    - [ ] overview page
      - [ ] upload file popup
      - [ ] add todo item popup
      - [ ] add member popup
    - [ ] Files page
    - [ ] To do list page
      - [ ] feature to clear all tasks that are done
      - [ ] button to delete a certain task 
    - [ ] Members page

# Functions

- str_trim(string): removes white spaces before or after the string
- str_cmp(str1, str2): compares two strings
- str_len(string): length of a string
- header(): for redirection after login
- password_has($password, PASSWORD_DEFAULT): $password is the password and PASSWORD_DEFAULT is the hashing algorithm it is gonna use
- password_verify($password, $hash): this function compares the password with the hash to see if they are compatible and returns a bool
- mysqli_query($conn, $sql): to send a query to the database
- mysqli_num_rows($result): returns the number of rows from the result of a query
- mysqli_close($conn): to close a mysql connection

