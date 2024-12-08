# Article Management with Redis Caching

## Project Overview

This project is focused on high-performance data retrieval of articles using **Redis** for caching. The system is built with Symfony and containerized using Docker and Docker Compose, providing an efficient infrastructure for modern web applications.

The project allows fetching articles via an API route, with data being cached to reduce database load and improve response times.

---

## Key Features

1. **Redis Integration**
   - Redis is used to cache frequently accessed data for faster retrieval.
   - Implements caching for database queries by ID, significantly reducing load on the database.

2. **Dockerized Environment**
   - Simplifies development and deployment using Docker Compose.

---

### Setup and Run

The system utilizes Docker to simplify setup and deployment. To build and start the project, run the following command:

```bash
make build
```

This command performs the following actions:

- Builds and starts all containers.
- Installs dependencies via composer install.
- Configures the database and loads sample data (article fixtures) for demonstration.

## Admin Panel for Article and Category Management
EasyAdmin provides a user-friendly interface for managing entities:

- CRUD for Articles — add, edit, delete, and view articles.
- CRUD for Categories — manage article categories.
- Article Search via Elasticsearch — integrates search functionality with ElasticsearchFacade to enable article searches within Elasticsearch.

Additionally, an API route is available for asynchronous article searches using Elasticsearch at /api/search_article.