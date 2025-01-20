# Round Robin Load Balancing - Go and Laravel Application

This project sets up a Round Robin load balancing system using Docker, Nginx, Go, and Laravel.

## Problems Faced & Solutions

### 1. Go Image Building
- Faced challenges in properly configuring the Go Docker image.
- Solution: Tweaked the Dockerfile to optimize the build process and dependencies.

### 2. Nginx Configuration for Round Robin
- Faced difficulties in setting up Nginx to distribute requests evenly between Go and Laravel instances.
- Solution: Configured Nginx with appropriate upstream blocks and load balancing settings.

### 3. Laravel Storage Folder Permission Issues
- Encountered permission issues while trying to write to the Laravel `storage` folder.
- Solution: Manually granted permissions to the `www-data` user.

  ```bash
  sudo chown -R www-data:www-data storage/
  sudo chmod -R 775 storage/
  ```

## Prerequisites
- Docker and Docker Compose installed.
- Basic knowledge of Docker, Nginx, and Laravel.

## Setup Instructions

### 1. Build the Docker Images

Use the following command to build the Docker images:

```bash
docker compose -f docker-compose.dev.yml -p dockerproject build
```

### 2. Start the Containers

Run the following command to start all the services:

```bash
docker compose -f docker-compose.dev.yml -p dockerproject up
```

### 3. Access the Application
- Laravel Application: `http://localhost`
- Go Application: `http://localhost:8080`

## Nginx Configuration (Example)

Below is an example Nginx configuration for Round Robin load balancing:

```nginx
upstream backend {
    server app1:8000;
    server app2:8000;
}

server {
    listen 80;
    server_name localhost;

    location / {
        proxy_pass http://backend;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
    }
}
```

## Useful Commands

- Stop running containers:
  ```bash
  docker compose down
  ```
- Check running containers:
  ```bash
  docker ps
  ```
- View logs:
  ```bash
  docker compose logs -f
  ```

## Things to Learn More
- Docker multi-stage builds for Go.
- Advanced Nginx load balancing techniques.
- Automating Laravel permission handling in Docker setup.

## Credits
Thanks to Claude.AI for helping solve the challenges faced during setup.

---

Happy Coding!!

