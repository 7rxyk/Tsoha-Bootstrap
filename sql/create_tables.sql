-- Lisää CREATE TABLE lauseet tähän tiedostoon

CREATE TABLE person(
  id        SERIAL PRIMARY KEY, -- SERIAL tyyppinen pääavain pitää huolen, että tauluun lisätyllä rivillä on aina uniikki pääavain. Kätevää!
  username  VARCHAR(50) NOT NULL UNIQUE, -- Muista erottaa sarakkeiden määrittelyt pilkulla!
  passsword VARCHAR(50) NOT NULL
);

CREATE TABLE task_priority(
  id              SERIAL PRIMARY KEY,
  priority_name   VARCHAR(20) NOT NULL UNIQUE,
  priority_class  INTEGER NOT NULL UNIQUE
);

CREATE TABLE task_status(
  id              SERIAL PRIMARY KEY,
  status_name     VARCHAR(20) NOT NULL UNIQUE,
  current_status  INTEGER NOT NULL UNIQUE
);

CREATE TABLE category(
  id              SERIAL PRIMARY KEY,
  category_name   VARCHAR(20) NOT NULL,
  person_id       INTEGER REFERENCES person(id)
);

CREATE TABLE task(
  id          SERIAL PRIMARY KEY,
  person_id   INTEGER REFERENCES person(id), -- Viiteavain person-tauluun
  taskname    VARCHAR(50) NOT NULL,
  info        VARCHAR(400),
  deadline    VARCHAR(10),
  added       TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  priority_id INTEGER REFERENCES task_priority (id),
  status_id   INTEGER REFERENCES task_status (id)
);

CREATE TABLE task_category(
  id            SERIAL PRIMARY KEY,
  task_id       INTEGER REFERENCES task (id),
  category_id   INTEGER REFERENCES category (id)
);