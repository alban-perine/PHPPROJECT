CREATE TABLE IF NOT EXISTS statuses(
  id int NOT NULL AUTO_INCREMENT,
  username VARCHAR(30) NOT NULL,
  message VARCHAR(140) NOT NULL,
  date DATETIME,
  PRIMARY KEY (id)
);