db.auth('root', 'a')

db = db.getSiblingDB('rubrica')

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