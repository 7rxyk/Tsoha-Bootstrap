-- Lisää CREATE TABLE lauseet tähän tiedostoon

CREATE TABLE person(
  id SERIAL PRIMARY KEY, -- SERIAL tyyppinen pääavain pitää huolen, että tauluun lisätyllä rivillä on aina uniikki pääavain. Kätevää!
  name 		varchar(50) NOT NULL, -- Muista erottaa sarakkeiden määrittelyt pilkulla!
  password 	varchar(50) NOT NULL
);

CREATE TABLE priority (
  id SERIAL PRIMARY KEY,
  title 	VARCHAR(20) NOT NULL UNIQUE,
  level 	INTEGER     NOT NULL UNIQUE
);

CREATE TABLE task_status (
  id SERIAL  	PRIMARY KEY,
  title	 	VARCHAR(20) NOT NULL UNIQUE,
  level 	INTEGER     NOT NULL UNIQUE
);

CREATE TABLE category (
  id SERIAL PRIMARY KEY,
  title    	VARCHAR(20) NOT NULL
);

CREATE TABLE task(
  id SERIAL  	PRIMARY KEY,
  person_id 	INTEGER REFERENCES person(id), -- Viiteavain person-tauluun
  name 		varchar(50) NOT NULL,
  description 	varchar(400),
  deadline  	TIMESTAMP,
  added 	TIMESTAMP DEFAULT CURRENT_TIMESTAMP(0),
  priority_id INTEGER REFERENCES priority (id),
  status_id 	INTEGER REFERENCES task_status (id)
);

CREATE TABLE Task_category (
  id          SERIAL PRIMARY KEY,
  task_id     INTEGER REFERENCES task (id),
  category_id INTEGER REFERENCES category (id)
);



