-- Lisää INSERT INTO lauseet tähän tiedostoon

-- Person-taulun testidata
INSERT INTO person (username, passsword) VALUES ('Noora', 'noora'); -- Koska id-sarakkeen tietotyyppi on SERIAL, se asetetaan automaattisesti
INSERT INTO person (username, passsword) VALUES ('user', 'user');


-- category taulun testidata
INSERT INTO category (category_name) VALUES ('Home');
INSERT INTO category (category_name) VALUES ('Work');


-- priority taulun testidata
INSERT INTO task_priority (priority_name, priority_class) VALUES ('High', 1);
INSERT INTO task_priority (priority_name, priority_class) VALUES ('Medium', 2);
INSERT INTO task_priority (priority_name, priority_class) VALUES ('Low', 3);


-- task_status taulun testidata
INSERT INTO task_status (status_name, current_status) VALUES ('Not Started', 1);
INSERT INTO task_status (status_name, current_status) VALUES ('In Progress', 2);
INSERT INTO task_status (status_name, current_status) VALUES ('Completed', 3);

-- Task taulun testidata
INSERT INTO task (taskname, person_id, info, deadline, status_id, priority_id, added) 
VALUES ('Do the dishes', 2, 'Use the ECO washprogram to save water!', '2017-04-28', 2, 3, now());

-- task_category taulun testidata
INSERT INTO task_category (task_id, category_id) VALUES (1, 1);
INSERT INTO task_category (task_id, category_id) VALUES (1, 2);