# Recommendation system 

## Description

This project is a movie recommendation system - backend part

With recommendation filters:
- return 3 random movies
- return movies that start with “W” and have an even number of characters
- return all movies with more than one word in the title

## Installation

To install and run this project you need to have PHP, composer installed on your machine and installed
and enabled extension mbstring

To run you need to have PHP extensions installed on your system:
- mbstring
- xdebug

## Usage

To run The tests, you can use the following command: ``` composer tests ```


## Docker
This project using docker to build and test 

### Docker build    
To build and run test in docker environment you need to have Docker installed on your system


#### Build image
To build image run command:

``` docker compose -f docker/docker-compose.yml build```

#### Run Image and create container
If you first execute command bellow docker should automatic build before created container

To run container run command:

``` docker compose -f docker/docker-compose.yml up```