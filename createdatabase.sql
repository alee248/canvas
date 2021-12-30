DROP DATABASE IF EXISTS canvas;
create database canvas;
use canvas;

CREATE TABLE student
(
sID varchar(10) NOT NULL, 
login_ID varchar(20),
fname char(9),
lname char(10),
CONSTRAINT studentPK PRIMARY KEY (sID),
CONSTRAINT studentUK UNIQUE (sID, login_ID)
);

CREATE TABLE class
(
cid char(5) NOT NULL,
cnum varchar(5), 
cname varchar(25), 
cyear int,
semester varchar(6),
CONSTRAINT calssPK PRIMARY KEY (cid)
);

CREATE TABLE teaches
(
sID varchar(10) NOT NULL, 
cid char(5),
CONSTRAINT teachesPK PRIMARY KEY (cid),
CONSTRAINT teachesFK FOREIGN KEY (sID) REFERENCES student(sID),
CONSTRAINT teachesFK2 FOREIGN KEY (cid) REFERENCES class(cid)
);

CREATE TABLE ta
(
sID varchar(10) NOT NULL, 
cid char(5),
CONSTRAINT taPK PRIMARY KEY (sid, cid),
CONSTRAINT taFK FOREIGN KEY (sID) REFERENCES student(sID),
CONSTRAINT taFK2 FOREIGN KEY (cid) REFERENCES class(cid)
);

CREATE TABLE takes
(
sID varchar(10) NOT NULL, 
cid char(5),
final_grade varchar(2),
CONSTRAINT takesPK PRIMARY KEY (sID, cid),
CONSTRAINT takeFK FOREIGN KEY (sID) REFERENCES student(sID),
CONSTRAINT takesFK2 FOREIGN KEY (cid) REFERENCES class(cid)
);

CREATE TABLE assignment
(
aname varchar(15) NOT NULL, 
due_date datetime,
adescription text,
points int,
cid char(5),
CONSTRAINT assPK PRIMARY KEY (aname, cid),
CONSTRAINT assFK FOREIGN KEY (cid) REFERENCES class(cid)
);

CREATE TABLE ass_grade
(
sID varchar(10) NOT NULL, 
aname varchar(15) NOT NULL, 
cid char(5),
numGrade int,
CONSTRAINT agPK PRIMARY KEY (sID, aname, cid),
CONSTRAINT agFK2 FOREIGN KEY (sID) REFERENCES student(sID)
);

CREATE TABLE qa
(
pID char(4) NOT NULL,
title varchar(20),
sID varchar(10) NOT NULL, 
ptext text,
pdate datetime,
cid char(5),
CONSTRAINT qaPK PRIMARY KEY (pID),
CONSTRAINT qaFK FOREIGN KEY (sID) REFERENCES student(sID),
CONSTRAINT qaFK2 FOREIGN KEY (cid) REFERENCES class(cid)
);

CREATE TABLE post_tag
(
pID char(4) NOT NULL,
tag varchar(20),
blank_col char,
CONSTRAINT ptPK PRIMARY KEY (pID, tag),
CONSTRAINT ptUK UNIQUE (pID)
);

CREATE TABLE threads
(
pID char(4) NOT NULL,
sID varchar(10),
rtime datetime,
rtext text,
CONSTRAINT threadPK PRIMARY KEY (pID, sID, rtime),
CONSTRAINT threadFK FOREIGN KEY (pID) REFERENCES qa(pID),
CONSTRAINT threadFK2 FOREIGN KEY (sID) REFERENCES student(sID)
);

use canvas;









