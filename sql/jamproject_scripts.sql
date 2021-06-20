-- ------------------------------------------------------------------
-- modif manuelles de 'usr_act'
-- ------------------------------------------------------------------

SELECT * FROM jamproject.usr_act;

-- ajouter manuellement des activities aux users 

-- usr 1 - 3 act
insert into usr_act (usr_id, act_id) values (1, 1); 
insert into usr_act (usr_id, act_id) values (1, 2); 
insert into usr_act (usr_id, act_id) values (1, 3); 

-- usr 2 - 2 act 
insert into usr_act (usr_id, act_id) values (2, 1); 
insert into usr_act (usr_id, act_id) values (2, 2); 

-- usr 3 - 1 act 
insert into usr_act (usr_id, act_id) values (3, 1); 

-- afficher toutes les infos reliant un usr et ses act 
select *
from act a 
join usr_act ua on a.id = ua.act_id 
join usr u on u.id = ua.usr_id
where u.id = 1;


-- ------------------------------------------------------------------
-- modif manuelles de 'act'
-- ------------------------------------------------------------------

-- ajout manuel des activités 
insert into act (name, description, price, content) 
values ('test_1', 'description 1', 1, 'let testP;testP = document.createElement("p");testP.textContent = "* * * * * test #1 * * * * *";document.getElementById("test-div").appendChild(testP');

insert into act (name, description, price, content) 
values ('test_2', 'description 2', 2, 'let testP;testP = document.createElement("p");testP.textContent = "* * * * * test #2 * * * * *";document.getElementById("test-div").appendChild(testP');

insert into act (name, description, price, content) 
values ('test_3', 'description 3', 3, 'let testP;testP = document.createElement("p");testP.textContent = "* * * * * test #3 * * * * *";document.getElementById("test-div").appendChild(testP');
