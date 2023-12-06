# To run the DB
```docker build -t pw02-db .```

```docker run -d --name pw02 -p 3306:3306 -e MYSQL_ROOT_PASSWORD=pass pw02-db```