-- Lisää CREATE TABLE lauseet tähän tiedostoon

CREATE TABLE Person(
  id SERIAL PRIMARY KEY, -- SERIAL tyyppinen pääavain pitää huolen, että tauluun lisätyllä rivillä on aina uniikki pääavain. Kätevää!
  name 		varchar(50) NOT NULL, -- Muista erottaa sarakkeiden määrittelyt pilkulla!
  password 	varchar(50) NOT NULL
);

CREATE TABLE Priority (
  id SERIAL PRIMARY KEY,
  title 	VARCHAR(20) NOT NULL UNIQUE,
  level 	INTEGER     NOT NULL UNIQUE
);

CREATE TABLE Task_status (
  id    	PRIMARY KEY,
  title	 	VARCHAR(20) NOT NULL UNIQUE,
  level 	INTEGER     NOT NULL UNIQUE
);

CREATE TABLE Category (
  id SERIAL PRIMARY KEY,
  title    	VARCHAR(20) NOT NULL,
);

CREATE TABLE Task(
  id SERIAL  	PRIMARY KEY,
  person_id 	INTEGER REFERENCES Person(id), -- Viiteavain person-tauluun
  name 			varchar(50) NOT NULL,
  done 			boolean DEFAULT FALSE,
  description 	varchar(400),
  deadline  	TIMESTAMP,
  added 		TIMESTAMP DEFAULT CURRENT_TIMESTAMP(0),
  priority_id 	INTEGER REFERENCES Priority (id),
  status_id 	INTEGER REFERENCES Task_status (id)
);

CREATE TABLE Task_category (
  id          SERIAL PRIMARY KEY,
  task_id     INTEGER REFERENCES Task (id),
  category_id INTEGER REFERENCES Category (id)
);

