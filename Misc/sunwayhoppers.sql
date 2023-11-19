CREATE TABLE IF NOT EXISTS account (
accountID int(11) NOT NULL AUTO_INCREMENT,
email varchar(50) NOT NULL,
password varchar(255) NOT NULL,
type varchar(20) NOT NULL DEFAULT "user",
PRIMARY KEY (accountID)
);

CREATE TABLE IF NOT EXISTS user (
userID int(11) NOT NULL AUTO_INCREMENT,
name varchar(50) NOT NULL,
phoneNo varchar(20) NOT NULL,
gender char(1) NOT NULL,
dob date NOT NULL,
bio varchar(255),
rewardPoints int(11) NOT NULL DEFAULT 0,
OTP int(11),
isDriver boolean NOT NULL DEFAULT 0,
rating float NOT NULL DEFAULT 0,
carRules varchar(255),
accountID int(11) NOT NULL,
PRIMARY KEY (userID)
);  

ALTER TABLE user
    ADD CONSTRAINT account_user_fk
    FOREIGN KEY (accountID)
    REFERENCES account(accountID);


