sudo docker-compose down
echo "Eliminació imatges"
sudo docker image rm -f $(sudo docker image ls -q)
echo "Eliminació contenidors"
sudo docker rm -f $(sudo docker ps -a -q)
echo "Eliminació volums"
sudo docker volume rm $(sudo docker volume ls -q)
