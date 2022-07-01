db.auth('root', 'a')

db = db.getSiblingDB('test-database')

db.createUser({
  user: "theabnermatheus",
  pwd: "teste",
  roles: [{role: "readWrite", db: "rubrica"}]
});