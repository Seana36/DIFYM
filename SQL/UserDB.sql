CREATE TABLE User_info (
		userID		INTEGER PRIMARY KEY AUTO_INCREMENT, 
		userName	VARCHAR(20),
		password	VARCHAR(20),
		fName		VARCHAR(20),
		lName		VARCHAR(20),
		securityQ	VARCHAR(40),
		securityA	VARCHAR(40)
	);

INSERT INTO User_info(userName, 
	password, fName, lName, securityQ, securityA) VALUES 
	('SeanUserName', 'password1', 'Sean', 'Test', 
		'What is SCSUs Mascot?', 'Owls, Hoot Hoot!');
INSERT INTO User_info(userName, 
	password, fName, lName, securityQ, securityA) VALUES 
	('User', 'password2', 'Sean2', 'Test2', 
		'What is SCSUs Mascot?', 'Owls, Hoot Hoot!');


CREATE TABLE User_body(
	userID		INTEGER NOT NULL,
	height 		INTEGER,
	current_weight	INTEGER,
	goal_weight		INTEGER,
	goals		VARCHAR(50), 
	age			INTEGER, 
	FOREIGN KEY (userID) REFERENCES User_info(userID)
);

INSERT INTO User_body(userID, height, current_weight, goal_weight, age)
	VALUES (1, 72, 200, 175, 21);
INSERT INTO User_body(userID, height, current_weight, goal_weight, age)
	VALUES (2, 72, 150, 135, 30);


CREATE TABLE User_Pref (
	userID 		INTEGER NOT NULL,
	Keto		VARCHAR(1),
	Vegetarian	VARCHAR(1),
	Allergies	VARCHAR(30),
	Other		VARCHAR(30),
	FOREIGN KEY (userID) REFERENCES User_info(userID)
);
INSERT INTO User_Pref(userID, Keto, Vegetarian, Allergies, Other) VALUES
	(1, 'N', 'Y', 'None', 'None');