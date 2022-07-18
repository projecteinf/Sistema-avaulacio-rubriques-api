db.auth('root', 'a')

db = db.getSiblingDB('rubrica') 
db.createCollection('usuaris')


db.usuaris.insert({
  user: "professor",
  pwd: "p",
  roles: [{role: "readWrite", db: "rubrica"}]
});

db.usuaris.insert({
    user: "alumne",
    pwd: "a",
    roles: [{role: "read", db: "rubrica"}]
});