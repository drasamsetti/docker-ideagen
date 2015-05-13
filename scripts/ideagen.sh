#!/bin/bash
sudo docker run -d -p 80:80 -p 443:443 -p 3306:3306 -v `pwd`/../db:/tmp --name ideagen drasamsetti/ideagen