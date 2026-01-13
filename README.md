# Levantar entorno de desarrollo – PHP + Oracle

## Requisitos

- Docker
- Docker Compose

---

## Clonar el repositorio

```bash
git clone git@github.com:jorgeingresa/prueba_tecnica_dev2.git
```

## Levantar Entorno

```bash
docker compose up --build
```

- El servidor se despliega en localhost:8080

## Uso de cliente cloudbeaver

Acceder a :

```bash
localhost:8978
```

### Inicializar el cliente con datos por defecto : 

- user: cbadmin
- password (recomendada): Ingresa01 

### Crear conexión

- Driver : Oracle 
- Configuration : URL 
- JDBC URL : jdbc:oracle:thin:@//oracle:1521/XEPDB1
- USER : PRUEBA
- PASS : PRUEBA
