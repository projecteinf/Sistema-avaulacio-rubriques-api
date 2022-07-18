db.auth('root', 'a')

// Creació usuaris de sistema per a la base de dades rubrica

db = db.getSiblingDB('rubrica');



db.createUser({
   user: "root",
   pwd: "a",
   roles:  [ "readWrite", "dbAdmin" ]
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

db = db.getSiblingDB('rubrica') 
db.createCollection('usuaris')




db.usuaris.insert({
  user: "acalvo",
  pwd: "a"
});

