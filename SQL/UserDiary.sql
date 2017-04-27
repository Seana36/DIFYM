CREATE TABLE UserDiary (
	userID 		INTEGER NOT NULL,
	meal		VARCHAR(10) NOT NULL,
	NDB_NO		INTEGER NOT NULL, 
	date		date NOT NULL,
	servings	INTEGER  NOT NULL, 
	FOREIGN KEY (NDB_NO) REFERENCES mytable (NDB_NO)
);

INSERT INTO UserDiary(userID, meal, NDB_NO, date, servings) VALUES (1, "breakfast", 02001, '2017-10-05', 1);
INSERT INTO UserDiary(userID, meal, NDB_NO, date, servings) VALUES (1, "breakfast", 02002, '2017-10-05', 1);
INSERT INTO UserDiary(userID, meal, NDB_NO, date, servings) VALUES (1, "breakfast", 02003, '2017-10-05', 1);
INSERT INTO UserDiary(userID, meal, NDB_NO, date, servings) VALUES (1, "lunch", 02004, '2017-10-05', 1);
INSERT INTO UserDiary(userID, meal, NDB_NO, date, servings) VALUES (1, "lunch", 02005, '2017-10-05', 1);
INSERT INTO UserDiary(userID, meal, NDB_NO, date, servings) VALUES (1, "lunch", 02006, '2017-10-05', 1);
INSERT INTO UserDiary(userID, meal, NDB_NO, date, servings) VALUES (1, "dinner", 02007, '2017-10-05', 1);
INSERT INTO UserDiary(userID, meal, NDB_NO, date, servings) VALUES (1, "dinner", 02008, '2017-10-05', 1);
INSERT INTO UserDiary(userID, meal, NDB_NO, date, servings) VALUES (1, "dinner", 02009, '2017-10-05', 1);
