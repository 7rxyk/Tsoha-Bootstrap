-- Lisää INSERT INTO lauseet tähän tiedostoon

-- Person-taulun testidata
INSERT INTO person (username, password) VALUES ('Noora', 'noora'); -- Koska id-sarakkeen tietotyyppi on SERIAL, se asetetaan automaattisesti
INSERT INTO person (username, password) VALUES ('user', 'user');

-- Task taulun testidata
INSERT INTO task (taskname, person_id, description, deadline, added, status, priority_v) VALUES ('Do the dishes', '2', 'Use the ECO washprogram to save water!', '2017-04-24', NOW(), 'In Progress', 'Low');

-- priority taulun testidata
INSERT INTO priority (title, vlue) VALUES ('High', '1');
INSERT INTO priority (title, vlue) VALUES ('Medium', '2');
INSERT INTO priority (title, vlue) VALUES ('Low', '3');


-- task_status taulun testidata
INSERT INTO task_status (title, numb) VALUES ('Not Started', '1');
INSERT INTO task_status (title, numb) VALUES ('In Progress', '2');
INSERT INTO task_status (title, numb) VALUES ('Completed', '3');