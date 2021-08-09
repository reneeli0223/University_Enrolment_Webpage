##University Enrolment Website##
Access = 0 Students
Username : Renee
Password : Ly19980223!

Access = 1 DC
Username : soonja
Password : Ly19980223!

Access = 2 UC
Username : Jack
Password : Ly19980223!

Access = 3 lecturer
Username : Son Tran
Password : Ly19980223!

Access = 4 Tutor
Username : Kitty
Password : Ly19980223!

###Index page :
1. The home page of the whole website.
2. In this page, users can access to Register page,
unit details page, MyTimetable page, unit enrollment page,
tutorial allocation page and the login button can pop up a window for users to sign in.
3. If user doesn't log in, they can not get access to any page.
4. Different access level users will have different page displayed once they logged in.

###Register now page :
1. Users can register as either a student or academic staff. Each option will have different requirements to complete.
2. If they did not achieve the requirement, they will not be succeed to register.
3. Press back button to return to the home page.
4. Register page is needed for the entire website except for register page.
5. Once a user registered, their data and information will be stored to be database.

###Login page:
1. Login page is needed for the entire website except for register and master pages.
2. Users must choose whether they are students or staff.
3. They need to log in with correct username and password.

###User Account page:
1. Once the user logged in, they can change their information by clicking their name.
2. Once they click submit, the information will update in the database.

###Unit Details page:
1. Users can view the detail information of the all units.
2. Users can get access to "unitEnrol.php" "and timetable.php" page.

###Timetable page:
1. Users can view their individual timetable.
2. User can get access to "unitEnrol.php" and "unitdetail.php" page.

###Tutorial allocation:
1. Users can choose each unit's preferred timetable.
2. When the users click the submit button, the action section will change to "Enrolled"
3. Users can get access to "unitEnrol.php" and "timetable.php" page.

###Unit Enrolment page:
1. Users will see the available unit and their corresponding semester and campus.
2. Once the user click enrol, the "semester and campus" will change to "Enrolled".
3. The database will be updated, the information will be stored on the table called "Enrol".
4. Users can access to "unitdetail.php" page and "timetable.php".

###Master_unit.php:
1. Only DC can access this page.
2. In this page, the DC can add, remove or edit the units for the course including the offering
semesters, campuses, consultation time.
3. The DC can also allocates the lecturer for the unit
4. DC can change the unit's description by press unit detail button and will lead them to another page called "editdetail.php"
5. Once they click edit and submit, the information in the database will update.

###Master_academic.php:
1. Only DC and UC can access this page.
2. They can edit staff's access level
3. The updated information will be stored in the database.

###editTutorial.php:
1. Only DC and UC can access this page.
2. They can edit tutorial's campus, tutor, tutorial time.
3. The updated information will be stored in the database.

###EnrolledStudents_DC.php:
1.Only DC and UC can access this page.
2. They can view all of the students' enrolled information including unit_code, student ID, student name and tutorial time.
3. They can also search unit_code, student ID, student name and tutorial time by clicking the right top button.

###EnrolledStudents_Tut.php
1. Only tutor can access this page.
2. For example, tutor_id = '10', when she access this page, this page will only display the students in her class.
They can also search unit_code, student ID, student name and tutorial time by clicking the right top button.
3.Each tutor will have different visible list.
