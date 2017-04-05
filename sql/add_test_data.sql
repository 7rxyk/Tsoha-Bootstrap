-- Lisää INSERT INTO lauseet tähän tiedostoon

-- Person-taulun testidata

INSERT INTO Person (name, password) VALUES ('Noora', 'noora'); -- Koska id-sarakkeen tietotyyppi on SERIAL, se asetetaan automaattisesti
INSERT INTO Person(name, password) VALUES ('user', 'user');
-- Task taulun testidata

INSERT INTO Task (name, description, deadline, added, status_id, priority_id) VALUES ('Do the dishes', 'Use the ECO washprogram to save water!', '2017-04-24', NOW(), '2', '2');

-- priority taulun testidata
INSERT INTO priority (title, level) VALUES ('High', 1);
INSERT INTO priority (title, level) VALUES ('Medium', 2);
INSERT INTO priority (title, level) VALUES ('Low', 3);


-- task_status taulun testidata
INSERT INTO task_status (title, level) VALUES ('Not Started', 1);
INSERT INTO task_status (title, level) VALUES ('In Progress', 2);
INSERT INTO task_status (title, level) VALUES ('Completed', 3);