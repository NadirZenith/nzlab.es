# MAINTAINER
- Name: nz
- Email: 2cb.md2@gmail.com

# RECOMMENDED VM SYSTEM REQUIREMENTS
- 1 vCPU
- 2,7 GB RAM
- 30 GB SSD persistent disk (30 Mbps Read / 60 Mbps Write IOPS)
- HTTP/HTTPS traffic enabled
- OS recommended: Debian Stretch 9
- Docker CE installed <https://docs.docker.com/install/linux/docker-ce/debian/>
- Docker Compose installed <https://docs.docker.com/compose/install/>


# INSTALLATION PROCESS

### Clone git project to current directory
```
git clone <url-to-git-project>
```

### Change directory to project filepath
```
cd <to-project-directory>
```

### Generate docker-compose.override.yml and .env file from .dist
```
cp docker-compose.override.yml.dist docker-compose.override.yml
cp .env.dist .env
```

### Customize credentials & volume paths if necessary
```
vim .env
```

### Start up infrastructure building all containers images
```
docker-compose up -d --build
```


# POST-INSTALLATION PROCESS
 @todo
 
## Maintenance commands

### Check infrastructure configuration
```
docker-compose config
```

### Shut down all infrastructure (data is persisted and saved)
```
docker-compose down
```

##notes
 - using context in docker-compose.yml for nginx and php services to allow 
 ADD command in nginx service Dockerfile reference php folder srv/. 
 This is only useful in production if we dont want to use volumes.