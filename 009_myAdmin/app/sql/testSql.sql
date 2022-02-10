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





INSERT INTO InfoClient () VALUES () WHERE userID = ;





INSERT INTO InfoClient
  (info, userID, clientID)
VALUES
  (:info, :userID, :clientID)
ON DUPLICATE KEY UPDATE
  info     = VALUES(:info),
  userID = VALUES(:userID),
  clientID = VALUES(:clientID);



