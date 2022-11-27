/* db.auth('root', 'a');

db = db.getSiblingDB('rubrica');
db.createCollection('usuaris');
db.usuaris.insert({
  user: "acalvo",
  password: "a"
});

db = db.getSiblingDB('admin');

db.createUser(
  {
   user: "admin",
   pwd: "password",
   roles: [ { role: "root", db: "admin" } ]
  }
);



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
 */


