docker run --name colocolo-mysql \
    -p 3306:3306 \
    -e MYSQL_ROOT_PASSWORD=root \
    -e MYSQL_DATABASE=colocolo \
    -e MYSQL_USER=admin \
    -e MYSQL_PASSWORD=admin \
    -d mysql:5.7

docker stop colocolo-mysql
docker rm colocolo-mysql
