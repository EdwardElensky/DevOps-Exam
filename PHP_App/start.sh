#!/bin/bash
app="docker.hello2"
docker build -t ${app} .
docker run --rm -d -p 4000:4000 \
--name=${app} \
-v $PWD:/app ${app}



