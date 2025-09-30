# README
## Description
- **EduVault** is a collaborative learning platform that helps students and educators organize, share, and engage with study materials more effectively. It brings together key tools in one space, making group learning seamless and productive.
### Who it EduVault for
  - **Students** working on group assignments or preparing for exams.
  - **Study groups** who want a shared space for learning resources.
  - **Educators and tutors** who want to organize class materials.
## Setup

### Step 1
- Download and install [xampp](https://www.apachefriends.org/download.html).
- Make sure you have a browser

### Step 2
- You need to create a mysql database using xampp
- Go to the xampp control panel and start apache and mysql

### Step 4
- After you install xampp and setup the database go to the directory you installed xampp and go to the htdocs directory.

For Linux:
```bash
cd /opt/lampp/htdocs
```
### Step 5
- Clone the repository into the htdocs folder

### Step 6 
- Go to your browser and paste the following
```
http://localhost/eduvault
```
- You can now use the website as you please, **have fun :)**


## Technologies 
- HTML
- CSS
- PHP
- JS
- MySql
- XAMPP

## Database
### Entities
1. **User**:
   - ID(pk)
   - email (unique)
   - username
   - password
   - User Creation Data/Time
2. **Study Group**:
   - ID(pk)
   - Group Name
   - Group Description
   - Group Creation Data/Time
   - Group Created by (FK)
3. **Group Members**:
   - Group id (FK)
   - Member id (FK)
   - joined date
   - role (member, admin)
4. **Invitations**:
   - ID(PK)
   - Group id (FK)
   - Sender id (FK)
   - Reciever id (FK)
   - status (pending, accepted, declined)
   - sent_at Date/Time
   - responded_at Date/Time
5. **Files**:
   - ID(PK)
   - Group id (FK)
   - Uploader id (FK)
   - file name
   - file path
   - uploaded_at Date/Time
6. **Tasks**:
   - ID(PK)
   - Group id (FK)
   - Creator id (FK)
   - Title
   - Description
   - Status (pending, completed)
   - Created_at Date/Time
   - Completed_at Date/Time

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

## Functions

- str_trim(string): removes white spaces before or after the string
- str_cmp(str1, str2): compares two strings
- str_len(string): length of a string
- header(): for redirection after login
- password_has($password, PASSWORD_DEFAULT): $password is the password and PASSWORD_DEFAULT is the hashing algorithm it is gonna use
- password_verify($password, $hash): this function compares the password with the hash to see if they are compatible and returns a bool
- mysqli_query($conn, $sql): to send a query to the database
- mysqli_num_rows($result): returns the number of rows from the result of a query
- mysqli_close($conn): to close a mysql connection


## CHECK
- auto index
- ht access