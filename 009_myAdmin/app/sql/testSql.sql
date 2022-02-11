USE project_009_myAdmin;

CREATE TABLE IF NOT EXISTS InfoClient (
    id INT PRIMARY KEY AUTO_INCREMENT,
    info TEXT,

    userID INT NOT NULL ,
    CONSTRAINT User_InfoClient
            FOREIGN KEY (userID) REFERENCES User (id)
            ON DELETE CASCADE,

    clientID INT NOT NULL ,
    CONSTRAINT User_ClientID
            FOREIGN KEY (clientID) REFERENCES Client (id)
            ON DELETE CASCADE
)ENGINE=InnoDB;







use project_009_myAdmin;
SET @userID = (SELECT id FROM User WHERE email = 'chis12aug@yahoo.com');
INSERT INTO Locality (lName, userID) VALUES ('Attard', @userID), ('Zurrieq', @userID), ('Valletta', @userID);
INSERT INTO Country (cName, userID) VALUES ('Malta', @userID), ('Gozo', @userID), ('UK', @userID);

INSERT INTO Client (title, firstname, lastname, idCard, company, email, phone, mobile, strAddr, postcode, localityName, countryName, userID)
VALUES 
('Mr', 'James', 'Mizzi', '45871285M', NULL, 'james@hilton.com', NULL, '0356 78451241', '42 St Andrew street', 'ATD002','Attard', 'Malta', @userID),
('Miss', 'Joelle', 'Meli', '01458945M', NULL, 'nicegirl@hotmail.com', '0356 12457889', '0356 89452378', '32 Triq il Qotton','VAL2231', 'Valletta', 'Malta', @userID),
('Ms', 'Erika', 'Abdilla', '00124578M', 'PDO', NULL,  '78451256', NULL, '12 Tiq il Harruba', 'ZQR1245','Zurrieq',  'Malta', @userID);


