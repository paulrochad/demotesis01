FROM mysql:latest

ENV MYSQL_USER=Administrador
ENV MYSQL_PASSWORD=tecsup123
ENV MYSQL_DATABASE=credenciales_db

COPY credenciales_db.sql /docker-entrypoint-initdb.d/

RUN chown mysql:mysql /docker-entrypoint-initdb.d/credenciales_db.sql

EXPOSE 3306

CMD ["--default-authentication-plugin=mysql_native_password"]
