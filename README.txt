This is a modified website based on some of the functionalities of students and professors' most used website, Canvas. The webpage was created on GCP and contains the following functionalities:
(login starts on  http://35.224.242.211/login.php)

Question 7: Student Course Page
Design a webpage(s) that allows a student to view a particular course they have taken or are taking. You have freedom to design the webpage(s) however you think is the easiest for you so long as it meets the following requirements:
(a) (5 points) At least one webpage that allows the student to view a particular course content (e.g., CS 377 Fall 2021).
(b) (5 points) Allow the student to view their current assignment grades.
(c) (5 points) Allow the student to view the details of any assignment (i.e., due date, text, and total number of points).
(d) (5 points) Allow the student to view their final letter grade for the course.
Question 8: Teaching Staff Page(s)
Design a webpage(s) that allows the instructor/teaching assistant to see all the students who are taking a specific course they are teaching. You have freedom to design the webpage(s) however you think is the easiest for you so long as it allows the teacher to perform the following actions:
Page 5
(a) (5 points) At least one webpage that allows the instructor/teaching assistant to view a particular course content (e.g., CS 377 Fall 2021).
(b) (8 points) Create a new assignment for the course with text (e.g., Final Project worth 200 points due 12/7 at 11:59 PM).
(c) (7 points) Enter grades for each student for a specific assignment.
(d) (5 points) Show the current grades of all students in the course for all the assignments.
(e) (5 points) Enter the letter grade for the student at the end of the semester.
Question 9: Q&A Page(s)
Design a webpage(s) that allows users (i.e., students, instructors, teaching assistants) to view, post, and answer questions associated with their courses. For the purpose of this project, you can assume the user can only choose tags that have already been defined in the database for the course (i.e., those already existing in the qa.csv file for that particular course/semester). You have the freedom to incorporate this functionality into the above pages from the previous two questions or as new standalone pages.
(a) (15 points) Allow the user to view existing posts and their associated threads. Posts should be displayed in the order of their timestamp. You have the freedom to choose ascending or descending.
(b) (5 points) Allow the user to filter the questions and threads based on the tag of the posts.
(c) (8 points) Allow the user to create a new post by entering the title, one or more tags that are pre-defined in the database, and the text of their post. Note that the date should automatically be populated once they submit.
(d) (7 points) Allow the user to respond to a post by entering their reply text.
Question 10: Home/Login Page
Design a webpage(s) that allows the user to login to your application, which will then lead them to a “home” page that shows all the courses applicable to that user. This home page should be used to navigate to the specific student course page or teaching course page built in the previous two questions.
(a) (10 points) A webpage to “login” to the application. Users will enter their student ID and their login ID. If the student ID / login ID pair is not valid, your application should inform the user of this. Note that authentication has been significantly simplified to make it easier for the project. You do not need to support HTTP authentication, this is simply a check to make sure that there is such a user in the system.
(b) (10 points) Once the user has logged in, they should be shown all the courses that they can access either as a student or a faculty.
(c) (10 points) The user should then be able to click on a specific course that takes them to the webpages built in Questions 7-9 depending on whether they are a student or member of the teaching staff for the course in question.
