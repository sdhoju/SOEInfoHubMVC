# SOEInfoHub 
## Author  
   Sameer Dhoju samee.dhoju@gmail.com
## Sponsored By:  
Marni Kendrick

## Requirements
   -	PHP 5.3.0+ 
   -	MySQL
   -	mod_rewrite activated
## Installation 
  PHP, MySQL can be installed with XAMPP https://www.apachefriends.org/index.html.  It is a free PHP development environment. Once the       installation is complete you can start PHP and MySQL from XAMPP Control Panel. Open the Shell in XAMPP Control Panel and you can check     the PHP version by typing php –version and MySQL version by typing mysql –version. In the browser type localhost and you will see default   website for XAMPP. After all the requirement are fulfilled, we can get started. 

### Getting Started 
Download the repository and set up in a folder. Let’s work with mod_rewrite to block all access to everything outside the /public folder.
1.	Create a .htaccess file in your working directory and write the following. It will redirect to the homepage of the website. 

```
RewriteEngine on
RewriteRule ^(.*) public/$1 [L]
```
2.	Create a .htaccess file in app directory and write the following. It will block all the access to app file.

```
Options -Indexes
```
3.	Create a .htaccess file in public directory and write the following. This is where the URL are broken down.

```
# If the following conditions are true, then rewrite the URL:
# If the requested filename is not a directory,
RewriteCond %{REQUEST_FILENAME} !-d
# and if the requested filename is not a regular file that exists,
RewriteCond %{REQUEST_FILENAME} !-f
# and if the requested filename is not a symbolic link,
RewriteCond %{REQUEST_FILENAME} !-l
RewriteRule ^(.+)$ index.php?url=$1 [QSA,L]
```
### Database
- Edit the credential in app/config/config.php. 
- Execute the .sql statements in _install folder. 
It will create database SOEInfoHub and create following tables in database.
   1.	Announcement
   2.	Major
   3.	Classification
   4.	announceMajor
   5.	annoucneCLS
   6.	submitter
   7.	announceFile
   8.	admin
   9.	subscribers

- Edit the credential for gmail in app/lib/Mailer.php to send the emails. Once the above steps are completed SOEInfoHub is ready to be used. 
### Use
The users of this applications are students, faculty members, student organizations as public and the school of engineering as admin.
#### Public Interface
There are 4 pages for public interfaces. 
   1.	Feed page.
   2.	Announcement page.
   3.	Submission form. 
   4.	Unsubscribe page.

Public can simply browse through the feed page and read all the events going on. They can get zoom image by clicking on it. By clicking the title of the announcement, they can navigate to the announcement page. It has two links on side menu. By clicking Submit an announcement they can go to submission form. They can also click on Join our email list and fill out small form to get listed as subscriber. In announcement page, an individual announcement with more details is present. It also has 5 links on the side menu. All events will take them back to the feed page. Share in Facebook allows them to share the announcement in Facebook. By clicking on add to google calendar or add to icalendar/outlook they can add it to their calendar. They can send the details of this announcement by typing the email and pressing email to self/fiend button.
Submission form is the form student organizations will fill out to submit an announcement about their events. The input fields in this form are as follows.
   1.	Contact name
   2.	Contact email
   3.	Contact phone
   4.	Organization
   5.	Event’s title
   6.	Event’s description
   7.	Location
   8.	Start date
   9.	Start time
   10.	End date
   11.	End time
   12.	Selection of relevant major
   13.	Selection of relevant classification 
   14.	External link
   15.	Attachment.
   
Once they fill it out and press Submit button, the announcement will be submitted. They will receive an email and if they need to change anything they can reply to that email and ask to edit the announcement. 

#### Administration
SOEInfohub is designed to be easy to use as an admin. To get to the dashboard simply login with the admin credential. 
 
We can see a snapshot of dashboard above. This dashboard has 7 colums.
   1.	Start at 
   2.	Title
   3.	Contact name
   4.	Details
   5.	Edit
   6.	Publish 
   7.	Delete
   
First four columns are the details about the announcement. Admin can navigate to the announcement by clicking on the title. They will be taken to announcement page and view all the details. EDIT will take admin to Edit form where the announcement can be edited. Publish button have two color settings. Unpublished announcement has red button and published announcement has green button. The published status of an announcement can be toggled with this button. Delete button will delete the announcement.

### Maintenance 
 
After the end of the semester, the student lists get changed. Information of students can be changed by uploading an excel file that has following details.
	1st column: First name
	2nd column: Middle name
	3rd column: Last name
	4th column: email
	5th column: major
	6th column: hours earned. 
   
This site was built using [panique/mini](https://github.com/panique/mini).


