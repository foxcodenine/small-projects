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
SET @userID = (SELECT id FROM User WHERE email = 'Y2hyaXMxMmF1Z0B5YWhvby5jb20=');
INSERT INTO Locality (lName, userID) VALUES ('Attard', @userID), ('Zurrieq', @userID), ('Valletta', @userID), ('Victoia', @userID), ("St Paul's Bay", @userID);
INSERT INTO Country (cName, userID) VALUES ('Malta', @userID), ('Gozo', @userID), ('UK', @userID);

INSERT INTO Client (title, firstname, lastname, idCard, company, email, phone, mobile, strAddr, postcode, localityName, countryName, userID)
VALUES 
('Mr', 'James', 'Zuggo', '0544714M', 'Developer', 'jamesmiddi@ldtto.com', NULL,     '0356 78451241', '71 Cherry Court',        'ATD0002', 'Attard',  'Malta', @userID),
('Mrs','Sarah', 'Mizzi', '0024571M',  Null,       'sm1784@gmail.com',     21454514, '0356 99665552', '83 Howard Street',       'ZQR0051', 'Zurrieq', 'Malta', @userID),
('Mr', 'Luke',  'Vella', '7825412G', 'Manager',   'luke@vellagroup.com',  21568956, NULL,            'San Lawrenz Triq ir-Rokon',  NULL,  'Victoia', 'Gozo', @userID),
('Mrs','Dorothy', 'Cassar', '124451M',  Null,     'bluehorse@gmail.com',   Null,    '78457812',      '6 St.Francis Square',    'VAL0225', 'Valletta','Malta', @userID);



use project_009_myAdmin;
SET @userID = (SELECT id FROM User WHERE email = 'Y2hyaXMxMmF1Z0B5YWhvby5jb20=');

INSERT INTO Project (projectname, strAddr, projectNo, paNo,  projectDate, cover,  hosted, localityName, stageName, categoryName, clientId, userID) 
VALUES 
('T12 Office Building', 'Tigne Point, Victoria, Gozo', '1245', 'PA 1245/14',  '2014-4-4', NULL, NULL, 'Victoia', NULL, NULL, NULL, @userID),
('Sirens Swimming Pool', "Aquatic centre in St. Paul's Bay", '7811', 'PA 5155/17', '2020-2-2', NULL, NULL, "St Paul's Bay", NULL, NULL, NULL, @userID);





use project_009_myAdmin;
SET @userID = (SELECT id FROM User WHERE email = 'chris12aug@yahoo.com');

INSERT INTO ImageProject (urlPath, position, userID, projectID)
VALUES
('/009/app/static/images/samples/project-3/0001.jpg', 1, @userID, 3),
('/009/app/static/images/samples/project-3/0002.jpg', 1, @userID, 3),
('/009/app/static/images/samples/project-3/0003.jpg', 1, @userID, 3),
('/009/app/static/images/samples/project-3/0004.jpg', 1, @userID, 3),
('/009/app/static/images/samples/project-3/0005.jpg', 1, @userID, 3),
('/009/app/static/images/samples/project-3/0006.jpg', 1, @userID, 3),
('/009/app/static/images/samples/project-3/0007.jpg', 1, @userID, 3),
('/009/app/static/images/samples/project-3/0008.jpg', 1, @userID, 3),
('/009/app/static/images/samples/project-3/0009.jpg', 1, @userID, 3);
