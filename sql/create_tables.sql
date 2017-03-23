-- Lisää CREATE TABLE lauseet tähän tiedostoon

CREATE TABLE Person(
  id SERIAL PRIMARY KEY, -- SERIAL tyyppinen pääavain pitää huolen, että tauluun lisätyllä rivillä on aina uniikki pääavain. Kätevää!
  name varchar(50) NOT NULL, -- Muista erottaa sarakkeiden määrittelyt pilkulla!
  password varchar(50) NOT NULL
);

CREATE TABLE Task(
  id SERIAL PRIMARY KEY,
  person_id INTEGER REFERENCES Person(id), -- Viiteavain Player-tauluun
  name varchar(50) NOT NULL,
  done boolean DEFAULT FALSE,
  description varchar(400),
  deadline DATE,
  added DATE
);



