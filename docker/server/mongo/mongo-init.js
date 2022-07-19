db.auth('root', 'a')

db.createUser(
  {
    user: "admindb",
    pwd: "a",
    roles: [ { role: "readWrite", db: "rubrica" } ]
  }
);

db.createUser(
  {
   user: "admin",
   pwd: "password",
   roles: [ { role: "root", db: "admin" } ]
  }
);

// Creació usuaris de sistema per a la base de dades rubrica
db.auth('admindb','a');
db = db.getSiblingDB('rubrica');



db.createUser({
   user: "rootapp",
   pwd: "a",
   roles:  [ "readWrite" ]
 });




db.createUser({
  user: "professor",
  pwd: "p",
  roles: [{role: "readWrite", db: "rubrica"}]
});

db.createUser({
  user: "alumne",
  pwd: "a",
  roles: [{role: "read", db: "rubrica"}]
});


db.createCollection('usuaris')




db.usuaris.insert({
  user: "acalvo",
  pwd: "a"
});

