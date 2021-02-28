# Media provider solution #

## Prerequisites

* [Docker](https://docs.docker.com/install/) ^18.09.2
* [Docker Compose](https://docs.docker.com/compose/install/) ^1.23.2

## Getting started

1. Make sure that `start.sh` file has the permission to execute:
    ```
     chmod +x start.sh
    ```
2. Start the `start.sh` script:
    ```
    ./start.sh
    ```
3. That's it!
  
All migrations and database seeder will run automatically.

The application runs as an HTTP server at port 80

    | Endpoint                 | Method     |   Notes                |
    | -------------------------| ---------- | -----------------------|
    | api/v1/upload/providers  | GET        |                        |
    | api/v1/upload/video      | POST       |                        |
    | api/v1/upload/image      | POST       |                        |

Here is the Postman collection, can be imported in to Postman:
https://drive.google.com/file/d/1nJ_c7wfhuvp_QCtcJv3Z6SyYHouMCvBk/view?usp=sharing
